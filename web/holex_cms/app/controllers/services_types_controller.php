<?php


namespace app\controllers;


use app\models\images;
use app\models\publications;
use app\models\services;
use app\models\services_types;
use profit_az\profit_cms\base\controller;
use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

class services_types_controller extends controller
{
    public static function action_list() {
        self::$layout = 'common_layout';
        view::$title = CMS::t('menu_item_services_types_list');

        $params = [];
        $page = intval(@$_GET['page']);

        $servicesTypesModel = new services_types();
        $params['servicesTypes'] = $servicesTypesModel->getTypesList();
        $servicesTypesModel->curr_page = (empty($page) ? 1 : $page);
        $params['count'] = $servicesTypesModel->items_amount;
        $params['total'] = $servicesTypesModel->pages_amount;
        $params['current'] = $servicesTypesModel->curr_page;
        $params['canWrite'] = CMS::hasAccessTo('services_types/list', 'write');
        $params['link_sc'] = utils::trueLink(['controller', 'action', 'q', 'filter']);
        $params['link_return'] = urlencode(SITE . CMS_DIR . utils::trueLink(['controller', 'action', 'q', 'filter', 'page']));
        return self::render('services_types_list', $params);
    }

    public static function action_add(){
        self::$layout = 'common_layout';
        view::$title = CMS::t('service_type_add');
        $servicesTypesModel = new services_types();
        $params = [];
        $params['canWrite'] = CMS::hasAccessTo('services_types/add', 'write');
        $params['link_back'] = (empty($_GET['return']) ? '?controller=services_types&action=list' : $_GET['return']);

        if (isset($_POST['add'])) {
            $params['op'] = $servicesTypesModel->addType();
            if ($params['op']['success']) {
                utils::delayedRedirect($params['link_back']);
            }
        }
        $params['langs'] = CMS::$site_langs;
        $params['servicesTypes'] = $servicesTypesModel->getTypesList();
        return self::render('service_type_add', $params);
    }

    public static function action_edit(){
        self::$layout = 'common_layout';
        view::$title = CMS::t('menu_item_service_type_edit');

        $serviceTypeModel = new services_types();

        $params = [];
        $params['canWrite'] = CMS::hasAccessTo('publications/edit', 'write');
        $params['link_back'] = (empty($_GET['return'])? '?controller=publications&action=list': $_GET['return']);

        $id = @(int)$_GET['id'];
        $params['publication'] = $serviceTypeModel->getTypeById($id);

        if (empty($params['publication']['id'])) {
            return CMS::resolve('base/404');
        }
        $params['langs'] = CMS::$site_langs;

        if (isset($_POST['save']) || isset($_POST['apply']) || isset($_POST['is_published'])) {
            if (!$params['canWrite']) {CMS::logout();}
            $params['op'] = $serviceTypeModel->editType($id);
            $params['serviceTypes'] = $serviceTypeModel->getTypeById($id);
            if ($params['op']['success'] && isset($_POST['save'])) {
                utils::delayedRedirect($params['link_back']);
            }
        }
        return self::render('service_type_edit', $params);
    }

    public static function action_delete(){
        self::$layout = 'common_layout';
        view::$title = CMS::t('delete');
        $serviceTypeModel = new services_types();
        $params = [];
        $params['canWrite'] = CMS::hasAccessTo('services_types/delete', 'write');
        $params['link_back'] =  (empty($_GET['return'])? '?controller=services_types&action=list': $_GET['return']);
        $deleted = false;
        if ($params['canWrite']) {
            $deleted = $serviceTypeModel->deleteType(@$_POST['delete']);
        }
        $params['op']['success'] = $deleted;
        $params['op']['message'] = 'del_'.($deleted ? 'suc' : 'err');
        return self::render('cms_user_delete', $params);
    }

}