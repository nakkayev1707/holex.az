<?php


namespace app\controllers;

use app\models\images;
use app\models\nav;
use app\models\publications;
use profit_az\profit_cms\base\controller;
use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined("_VALID_PHP")) {
    die('Direct access to this location is not allowed.');
}

class publications_controller extends controller
{

    public static function action_list()
    {
        self::$layout = 'common_layout';
        view::$title = CMS::t('menu_item_publications_list');

        $params = [];
        $page = intval(@$_GET['page']);

        $publicationsModel = new publications();
        $publicationsModel->curr_page = (empty($page) ? 1 : $page);

        $params['publications'] = $publicationsModel->getPublicationsList();
        $params['count'] = $publicationsModel->items_amount;
        $params['total'] = $publicationsModel->pages_amount;
        $params['current'] = $publicationsModel->curr_page;
        $params['canWrite'] = CMS::hasAccessTo('publications/list', 'write');
        $params['link_sc'] = utils::trueLink(['controller', 'action', 'q', 'filter']);
        $params['link_return'] = urlencode(SITE . CMS_DIR . utils::trueLink(['controller', 'action', 'q', 'filter', 'page']));
        $params['cats'] = nav::getCats();
        $params['publicationTypes'] = $publicationsModel->publicationTypes;

        return self::render('publications_list', $params);
    }

    public static function action_add()
    {
        self::$layout = 'common_layout';
        view::$title = CMS::t('menu_item_publication_add');
        $publications = new publications();
        $params = [];
        $params['canWrite'] = CMS::hasAccessTo('publications/add', 'write');
        $params['link_back'] = (empty($_GET['return']) ? '?controller=publications&action=list' : $_GET['return']);

        if (ADMIN_TYPE != 'admin') {
            $allowed_cats = nav::getEditorAllowedCats(ADMIN_ID);
        }
        if (isset($_POST['add'])) {
            $params['op'] = $publications->addPublication();
            if ($params['op']['success']) {
                utils::delayedRedirect($params['link_back']);
            }
        }
        $params['langs'] = CMS::$site_langs;
        $params['allowed_cats'] = @$allowed_cats;
        $params['cats'] = nav::getCats();
        $params['allowed_thumb_ext'] = images::$allowed_ext;
        $params['publicationTypes'] = $publications->publicationTypes;

        return self::render('publication_add', $params);
    }

    public static function action_edit() {
        self::$layout = 'common_layout';
        view::$title = CMS::t('menu_item_publication_edit');

        $publications = new publications();
        $images = new images('publications_images', [], 'publications');

        $params = [];
        $params['canWrite'] = CMS::hasAccessTo('publications/edit', 'write');
        $params['link_back'] = (empty($_GET['return'])? '?controller=publications&action=list': $_GET['return']);

        $id = @(int)$_GET['id'];
        $params['publication'] = $publications->getPublicationById($id);
        $params['images'] = $images->getImagesById($id, 'publication_id');
        $params['publicationTypes'] = $publications->publicationTypes;
        if (empty($params['publication']['id'])) {
            return CMS::resolve('base/404');
        }
        $params['langs'] = CMS::$site_langs;
        $params['allowed_thumb_ext'] = images::$allowed_ext;

        if (isset($_POST['save']) || isset($_POST['apply']) || isset($_POST['is_published'])) {
            if (!$params['canWrite']) {CMS::logout();}
            $params['op'] = $publications->editPublication($id);
            $params['publication'] = $publications->getPublicationById($id);
            if ($params['op']['success'] && isset($_POST['save'])) {
                utils::delayedRedirect($params['link_back']);
            }
        }
        return self::render('publication_edit', $params);
    }

    public static function action_delete() {
        self::$layout = 'common_layout';
        view::$title = CMS::t('delete');
        $publications = new publications();
        $params = [];
        $params['canWrite'] = CMS::hasAccessTo('publications/delete', 'write');
        $params['link_back'] =  (empty($_GET['return'])? '?controller=publications&action=list': $_GET['return']);
        $deleted = false;
        if ($params['canWrite']) {
            $deleted = $publications->deletePublication(@$_POST['delete']);
        }
        $params['op']['success'] = $deleted;
        $params['op']['message'] = 'del_'.($deleted ? 'suc' : 'err');
        return self::render('cms_user_delete', $params);
    }

    public static function action_images()
    {
        self::$layout = 'common_layout';
        view::$title = CMS::t('menu_item_publications_images');
        $images = new images('publications_images', [], '');
        $params = [];
        $params['canWrite'] = CMS::hasAccessTo('publications/add', 'write');
        $params['link_back'] = (empty($_GET['return']) ? '?controller=publications&action=list' : $_GET['return']);
        $params['langs'] = CMS::$site_langs;
        $params['images'] = $images->getImagesById(@$_GET['id'], 'publication_id');
        return self::render('images', $params);
    }

    public static function action_delete_image()
    {
        self::$layout = 'common_layout';
        view::$title = CMS::t('delete');
        $params = [];
        $params['canWrite'] = CMS::hasAccessTo('publications/delete', 'write');
        $params['link_back'] = (empty($_GET['return']) ? '?controller=publications&action=list' : $_GET['return']);
        $images = new images('publications_images', '', 'publications');
        $deleted = false;
        if ($params['canWrite']) {
            $deleted = $images->deleteImageById(@$_POST['image_id'], 'publication_id');
        }
        $params['op']['success'] = $deleted;
        $params['op']['message'] = 'del_'.($deleted? 'suc': 'err');
        return self::render('cms_user_delete', $params);
    }

    public static function action_ajax_set_status()
    {
        header('Content-type: application/json; charset=utf-8');
        $response = ['success' => false, 'message' => 'ajax_invalid_request'];

        if (!CMS::hasAccessTo('publications/ajax_set_status', 'write')) {
            $response['code'] = '403';
            $response['message'] = 'ajax_request_not_allowed_to_write';
        } else if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $id = @(int)$_POST['id'];
            $status = @(string)$_POST['turn'];
            $publications = new publications();
            $is_hidden = ($status == 'on') ? '0' : '1';
            $updated = $publications->setIsHidden($id, $is_hidden);
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