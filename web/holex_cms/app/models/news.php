<?php


namespace app\models;


use phpDocumentor\Reflection\Types\This;
use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\tr;
use profit_az\profit_cms\helpers\utils;

class news
{
    public $curr_page = 1;
    public $per_page = 20;
    public $pages_amount = 0;
    public $items_amount = 0;
    public $table = 'news';
    public $tr_fields = ['title', 'full'];


    public function getNewsList()
    {
        $news_list = [];
        $joins = [];
        $joins['tr'] = "LEFT JOIN translates tr ON tr.ref_table='".$this->table."' AND tr.ref_id=n.id AND tr.lang=:default_site_lang AND tr.fieldname='title'";
        $filter = [];

        // search //
        if (!empty($_GET['q'])) {
            $filter[] = "tr.text LIKE '%" . utils::makeSearchable($_GET['q']) . "%'";
        }
        $where = (empty($filter)? '': (' WHERE '.implode(" AND ", $filter)));
        $sqlCount = "SELECT COUNT(n.id) FROM `".$this->table."` n ".implode("\n", $joins)."{$where}";
        $c = CMS::$db->get($sqlCount, [
            ':default_site_lang' => CMS::$default_site_lang
        ]);
        $this->items_amount = $c;
        $pages_amount = ceil($c/$this->per_page);
        if ($pages_amount > 0) {
            $this->pages_amount = $pages_amount;
            $this->curr_page = (($this->curr_page>$this->pages_amount)? $this->pages_amount: $this->curr_page);
            $start_from = ($this->curr_page-1)*$this->per_page;

            $sqlGetNews = "SELECT n.*, tr.text AS title FROM `".$this->table."` n ".implode("\n", $joins)."
				{$where} ORDER BY id DESC
				LIMIT ".(($start_from>0)? ($start_from.', '): '').$this->per_page;
            $news_list = CMS::$db->getAll($sqlGetNews, [
                ':default_site_lang' => CMS::$default_site_lang
            ]);
        }
        return $news_list;
    }

    public function addNews()
    {
        $response = ['success' => false, 'message' => 'insert_err'];
        $news = [
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
        $news_id = CMS::$db->add($this->table, $news);
        if ($news_id) {
            // saving images
            if (!empty($_FILES['img']['name']) && !($_FILES['img']['size'][0] == 0)) {
                $newsImages = new images('news_images', [0 => 'id', 1 => 'news_id', 2 => 'image'], 'news');
                $images = $_FILES['img'];
                if (count($_FILES['img']['name']) > 5) {
                    $response['message'] = 'image_count_overflow';
                    return $response;
                }
                $added = $newsImages->addImages($images, $news_id);
                if (!$added) {
                    return $response;
                }
            }
            // saving translates
            foreach ($translates as $lang => $tr_data) {
                foreach ($tr_data as $fieldname => $text) {
                    tr::store([
                        'ref_table' => $this->table,
                        'ref_id' => $news_id,
                        'lang' => $lang,
                        'fieldname' => $fieldname,
                        'text' => $text,
                    ]);
                }
            }
            // everything is OK, lets set news visible
            if ($this->enableNews($news_id)) {
                $response['success'] = true;
                $response['message'] = 'insert_suc';
                return $response;
            }
        }
        return $response;
    }


    public function setIsHidden($id, $is_hidden){
        $upd = [
            'is_hidden' => $is_hidden
        ];
        return CMS::$db->mod($this->table . '#' . (int)$id, $upd);
    }

    private function enableNews($newsId)
    {
        $upd = [
            'is_hidden' => '0'
        ];
        return CMS::$db->mod($this->table . '#' . (int)$newsId, $upd);
    }


}