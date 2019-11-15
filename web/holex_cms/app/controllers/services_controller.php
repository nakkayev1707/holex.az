<?php


namespace app\controllers;


use app\models\images;
use app\models\nav;
use app\models\publications;
use app\models\services;
use app\models\services_types;
use profit_az\profit_cms\base\controller;
use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

class services_controller extends controller
{
    public static function action_list() {
        self::$layout = 'common_layout';
        view::$title = CMS::t('menu_item_services_list');

        $params = [];
        $page = intval(@$_GET['page']);

        $servicesModel = new services();
        $servicesTypesModel = new services_types();
        $servicesModel->curr_page = (empty($page) ? 1 : $page);

        $params['services'] = $servicesModel->getServicesList();
        $params['count'] = $servicesModel->items_amount;
        $params['total'] = $servicesModel->pages_amount;
        $params['current'] = $servicesModel->curr_page;
        $params['canWrite'] = CMS::hasAccessTo('services/list', 'write');
        $params['link_sc'] = utils::trueLink(['controller', 'action', 'q', 'filter']);
        $params['link_return'] = urlencode(SITE . CMS_DIR . utils::trueLink(['controller', 'action', 'q', 'filter', 'page']));
        $params['servicesTypes'] = $servicesTypesModel->getTypesList();

        return self::render('services_list', $params);
    }

    public static function action_add()
    {
        self::$layout = 'common_layout';
        view::$title = CMS::t('menu_item_service_add');
        $services = new services();
        $servicesTypesModel = new services_types();
        $params = [];
        $params['canWrite'] = CMS::hasAccessTo('services/add', 'write');
        $params['link_back'] = (empty($_GET['return']) ? '?controller=services&action=list' : $_GET['return']);

        if (isset($_POST['add'])) {
            $params['op'] = $services->addService();
            if ($params['op']['success']) {
                utils::delayedRedirect($params['link_back']);
            }
        }
        $params['langs'] = CMS::$site_langs;
        $params['allowed_thumb_ext'] = images::$allowed_ext;
        $params['servicesTypes'] = $servicesTypesModel->getTypesList();

        return self::render('service_add', $params);
    }

    public static function action_edit(){
        self::$layout = 'common_layout';
        view::$title = CMS::t('menu_item_service_edit');

        $serviceModel = new services();
        $serviceTypesModel = new services_types();

        $params = [];
        $params['canWrite'] = CMS::hasAccessTo('publications/edit', 'write');
        $params['link_back'] = (empty($_GET['return'])? '?controller=service&action=list': $_GET['return']);

        $id = @(int)$_GET['id'];
        $params['service'] = $serviceModel->getServiceById($id);
        $params['serviceTypes'] = $serviceTypesModel->getTypesList();
        if (empty($params['service']['id'])) {
            return CMS::resolve('base/404');
        }
        $params['langs'] = CMS::$site_langs;
        $params['allowed_thumb_ext'] = images::$allowed_ext;

        if (isset($_POST['save']) || isset($_POST['apply']) || isset($_POST['is_published'])) {
            if (!$params['canWrite']) {CMS::logout();}
            $params['op'] = $serviceModel->editService($id);
            $params['publication'] = $serviceModel->getServiceById($id);
            if ($params['op']['success'] && isset($_POST['save'])) {
                utils::delayedRedirect($params['link_back']);
            }
        }


        return self::render('services_edit', $params);
    }

    public static function action_delete(){
        self::$layout = 'common_layout';
        view::$title = CMS::t('delete');
        $serviceModel = new services();
        $params = [];
        $params['canWrite'] = CMS::hasAccessTo('services/delete', 'write');
        $params['link_back'] =  (empty($_GET['return'])? '?controller=services&action=list': $_GET['return']);
        $deleted = false;
        if ($params['canWrite']) {
            $deleted = $serviceModel->deleteService(@$_POST['delete']);
        }
        $params['op']['success'] = $deleted;
        $params['op']['message'] = 'del_'.($deleted ? 'suc' : 'err');
        return self::render('cms_user_delete', $params);
    }


}