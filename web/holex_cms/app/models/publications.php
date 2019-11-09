<?php


namespace app\models;


use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\tr;
use profit_az\profit_cms\helpers\utils;

class publications
{
    public $curr_page = 1;
    public $per_page = 20;
    public $pages_amount = 0;
    public $items_amount = 0;
    public $table = 'publications';
    public $tr_fields = ['title', 'full'];
    public $publicationTypes = [
        [
            'id' => 1,
            'type' => 'news',
            'translate_key' => 'publication_news'
        ],
        [
            'id' => 2,
            'type' => 'blog',
            'translate_key' => 'publication_blog'
        ],
        [
            'id' => 3,
            'type' => 'event',
            'translate_key' => 'publication_event'
        ],
    ];

    public function getPublicationsList()
    {
        $publications_list = [];
        $joins = [];
        $joins['tr'] = "LEFT JOIN translates tr ON tr.ref_table='" . $this->table . "' AND tr.ref_id=p.id AND tr.lang=:default_site_lang AND tr.fieldname='title'";
        $filter = [];

        // search //
        if (!empty($_GET['q'])) {
            $filter[] = "tr.text LIKE '%" . utils::makeSearchable($_GET['q']) . "%'";
        }
        // start filter //
        if (!empty($_GET['filter']['type'])) {
            $filter[] = " p.type=" . CMS::$db->escape($_GET['filter']['type'] . "");
        }
        if (!empty($_GET['filter']['visibility'])) {
            $selectedVisibility = $_GET['filter']['visibility'];
            if ($selectedVisibility == "visible" || $selectedVisibility == "hidden") {
                $is_hidden = $selectedVisibility == "visible" ? 0 : 1;
                $filter[] = " p.is_hidden='" . $is_hidden . "' ";
            }
        }
        if (!empty($_GET['filter']['publish_date'])) {
            $selectedDate = $_GET['filter']['publish_date'];
            var_dump($selectedDate);die;
        }
        // end filter //
        $where = (empty($filter) ? '' : (' WHERE ' . implode(" AND ", $filter)));
        $sqlCount = "SELECT COUNT(p.id) FROM `" . $this->table . "` p " . implode("\n", $joins) . "{$where}";
        $c = CMS::$db->get($sqlCount, [
            ':default_site_lang' => CMS::$default_site_lang
        ]);
        $this->items_amount = $c;
        $pages_amount = ceil($c / $this->per_page);
        if ($pages_amount > 0) {
            $this->pages_amount = $pages_amount;
            $this->curr_page = (($this->curr_page > $this->pages_amount) ? $this->pages_amount : $this->curr_page);
            $start_from = ($this->curr_page - 1) * $this->per_page;

            $sqlGetPublication = "SELECT p.*, tr.text AS title FROM `" . $this->table . "` p " . implode("\n", $joins) . "
				{$where} ORDER BY id DESC
				LIMIT " . (($start_from > 0) ? ($start_from . ', ') : '') . $this->per_page;
            $publications_list = CMS::$db->getAll($sqlGetPublication, [
                ':default_site_lang' => CMS::$default_site_lang
            ]);

            $publications_list = $this->replacePublicationTypeWithTranslationKey($publications_list);
        }
        return $publications_list;
    }

    public function addPublication()
    {
        $response = ['success' => false, 'message' => 'insert_err'];
        $publications = [
            'is_hidden' => '1', // hide till save all relations //
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $translates = [];
        // processing translates
        foreach (CMS::$site_langs as $lng) {
            foreach ($this->tr_fields as $f) {
                if (in_array($f, ['title', 'full'])) {
                    $translates[$lng['language_dir']][$f] = trim(@$_POST[$f][$lng['language_dir']]);
                }
            }
        }
        $publication_id = CMS::$db->add($this->table, $publications);
        if ($publication_id) {
            // saving images
            if (!empty($_FILES['img']['name']) && !($_FILES['img']['size'][0] == 0)) {
                $publicationImages = new images('publications_images', [0 => 'id', 1 => 'publication_id', 2 => 'image'], 'publications');
                $images = $_FILES['img'];
                if (count($_FILES['img']['name']) > 5) {
                    $response['message'] = 'image_count_overflow';
                    return $response;
                }
                $added = $publicationImages->addImages($images, $publication_id);
                if (!$added) {
                    return $response;
                }
            }
            // saving translates
            foreach ($translates as $lang => $tr_data) {
                foreach ($tr_data as $fieldname => $text) {
                    tr::store([
                        'ref_table' => $this->table,
                        'ref_id' => $publication_id,
                        'lang' => $lang,
                        'fieldname' => $fieldname,
                        'text' => $text,
                    ]);
                }
            }
            // everything is OK, lets set publication visible
            if ($this->enablePublication($publication_id)) {
                $response['success'] = true;
                $response['message'] = 'insert_suc';
                return $response;
            }
        }
        return $response;
    }


    public function setIsHidden($id, $is_hidden)
    {
        $upd = [
            'is_hidden' => $is_hidden
        ];
        return CMS::$db->mod($this->table . '#' . (int)$id, $upd);
    }

    private function enablePublication($publicationId)
    {
        $upd = [
            'is_hidden' => '0'
        ];
        return CMS::$db->mod($this->table . '#' . (int)$publicationId, $upd);
    }

    private function replacePublicationTypeWithTranslationKey($publications_list){
        foreach ($publications_list as &$publication) {
            foreach ($this->publicationTypes as $type) {
                if ($publication['type'] == $type['type']) {
                    $publication['type'] = $type['translate_key'];
                }
            }
        }
        return $publications_list;
    }
}