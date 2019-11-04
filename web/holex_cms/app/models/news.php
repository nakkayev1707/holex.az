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
    public $allowed_thumb_ext = ['jpg', 'jpeg', 'png', 'bmp', 'gif'];
    public $tr_fields = ['title', 'full'];


    public function getNewsList()
    {
        $news_list = [];
        $joins = [];
        $filter = [];
        $filter[] = "n.is_deleted = '0'";

        // search //
        if (!empty($_GET['q'])) {
            $filter[] = "n.text LIKE '%" . utils::makeSearchable($_GET['q']) . "%'";
        }
        // filter //

        return [];
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
        if (empty($response['errors'])) {
            $news_id = CMS::$db->add($this->table, $news);
            if ($news_id) {
                // saving images
                if (!empty($_FILES['img']['name'])) {
                    $newsImages = new images('news_images');
                    if (empty($_FILES['img']['error'])) {
                        $images = $_FILES['img']['name'];
                        $added = $newsImages->addImages($images, $news_id);
                        if ($added) {
                            $response['success'] = true;
                            $response['message'] = 'insert_suc';
                        } else {
                            return $response;
                        }
                    }
                } else {
                    $response['success'] = true;
                    $response['message'] = 'insert_suc';
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
            }
        }
        return $response;
    }


    private function enableNews($newsId) {
        $upd = [
            'is_hidden' => '0'
        ];
        return CMS::$db->mod($this->table.'#'.(int)$newsId, $upd);
    }


}