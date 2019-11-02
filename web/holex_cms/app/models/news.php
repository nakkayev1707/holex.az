<?php


namespace app\models;


use profit_az\profit_cms\helpers\utils;

class news {
    public $curr_page = 1;
    public $per_page = 20;
    public $pages_amount = 0;
    public $items_amount = 0;
    public $table = 'news';
    public $allowed_thumb_ext = ['jpg', 'jpeg', 'png', 'bmp', 'gif'];

    public function getNewsList(){
        $news_list = [];
        $joins = [];
        $filter = [];
        $filter[] = "n.is_deleted = '0'";

        // search //
        if (!empty($_GET['q'])) {
            $filter[] = "n.text LIKE '%" .utils::makeSearchable($_GET['q']) . "%'";
        }
        // filter //

        return [];

    }

}