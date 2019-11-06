<?php


namespace app\controllers;

use app\models\articles;
use app\models\gallery;
use app\models\images;
use app\models\nav;
use app\models\news;
use profit_az\profit_cms\base\controller;
use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined("_VALID_PHP")) {
    die('Direct access to this location is not allowed.');
}

class news_controller extends controller
{

    public static function action_list()
    {
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
        $params['link_return'] = urlencode(SITE . CMS_DIR . utils::trueLink(['controller', 'action', 'q', 'filter', 'page']));
        $params['cats'] = nav::getCats();

        return self::render('news_list', $params);
    }

    public static function action_add()
    {
        self::$layout = 'common_layout';
        view::$title = CMS::t('menu_item_news_add');
        $news = new news();
        $params = [];
        $params['canWrite'] = CMS::hasAccessTo('news/add', 'write');
        $params['link_back'] = (empty($_GET['return']) ? '?controller=news&action=list' : $_GET['return']);

        if (ADMIN_TYPE != 'admin') {
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
        $params['allowed_thumb_ext'] = images::$allowed_ext;

        return self::render('news_add', $params);
    }

    public static function action_images()
    {
        self::$layout = 'common_layout';
        view::$title = CMS::t('menu_item_news_images');
        $images = new images('news_images', [], '');
        $params = [];
        $params['canWrite'] = CMS::hasAccessTo('news/add', 'write');
        $params['link_back'] = (empty($_GET['return']) ? '?controller=news&action=list' : $_GET['return']);
        $params['langs'] = CMS::$site_langs;
        $params['images'] = $images->getImagesById(@$_GET['id'], 'news_id');
        return self::render('images', $params);
    }

    public static function action_delete_image()
    {
        self::$layout = 'common_layout';
        view::$title = CMS::t('delete');
        $params = [];
        $params['canWrite'] = CMS::hasAccessTo('news/delete', 'write');
        $images = new images('news', '', 'news');
        $deleted = false;
        if ($params['canWrite']) {
            $deleted = $images->deleteImageById(@$_POST);
        }
        $params['op']['success'] = $deleted;
        $params['op']['message'] = 'del_'.($deleted? 'suc': 'err');
        return self::render('cms_user_delete', $params);
    }

    public static function action_ajax_set_status()
    {
        header('Content-type: application/json; charset=utf-8');
        $response = ['success' => false, 'message' => 'ajax_invalid_request'];

        if (!CMS::hasAccessTo('news/ajax_set_status', 'write')) {
            $response['code'] = '403';
            $response['message'] = 'ajax_request_not_allowed_to_write';
        } else if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $id = @(int)$_POST['id'];
            $status = @(string)$_POST['turn'];
            $news = new news();
            $is_hidden = ($status == 'on') ? '0' : '1';
            $updated = $news->setIsHidden($id, $is_hidden);
            if ($updated) {
                $response['success'] = true;
                $response['message'] = 'update_suc';
                $response['data']['action'] = $status;
            } else {
                $response['success'] = false;
                $response['message'] = 'update_error';
            }
        }

        return json_encode($response);
    }

}