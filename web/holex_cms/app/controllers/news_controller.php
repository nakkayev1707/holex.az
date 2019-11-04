<?php


namespace app\controllers;

use app\models\articles;
use app\models\nav;
use app\models\news;
use profit_az\profit_cms\base\controller;
use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}

class news_controller extends controller {

    public static function action_list(){
        self::$layout = 'common_layout';
        view::$title = CMS::t('menu_item_news_list');

        $params = [];
        $page = intval(@$_GET['page']);

        $newsModel = new news();
        $newsModel->curr_page = (empty($page) ? 1 : $page);

        $params['news'] = $newsModel->getNewsList();
        $params['count'] = $newsModel->items_amount;
        $params['total'] = $newsModel->pages_amount;
        $params['current'] = $newsModel->curr_page;
        $params['canWrite'] = CMS::hasAccessTo('news/list', 'write');
        $params['link_sc'] = utils::trueLink(['controller', 'action', 'q', 'filter']);
        $params['link_return'] = urlencode(SITE.CMS_DIR.utils::trueLink(['controller', 'action', 'q', 'filter', 'page']));
        $params['cats'] = nav::getCats();

        return self::render('news_list', $params);
    }

    public static function action_add() {
        self::$layout = 'common_layout';
        view::$title = CMS::t('menu_item_news_add');
        $news = new news();
        $params = [];
        $params['canWrite'] = CMS::hasAccessTo('news/add', 'write');
        $params['link_back'] = (empty($_GET['return'])? '?controller=news&action=list': $_GET['return']);

        if (ADMIN_TYPE!='admin') {
            $allowed_cats = nav::getEditorAllowedCats(ADMIN_ID);
        }
        if (isset($_POST['add'])) {
            $params['op'] = $news->addNews();
            if ($params['op']['success']) {
                utils::delayedRedirect($params['link_back']);
            }
        }
        $params['langs'] = CMS::$site_langs;
        $params['allowed_cats'] = @$allowed_cats;
        $params['cats'] = nav::getCats();
        $params['allowed_thumb_ext'] = $news->allowed_thumb_ext;

        return self::render('news_add', $params);
    }

}