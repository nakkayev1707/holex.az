<?php


namespace app\controllers;


use app\models\images;
use app\models\nav;
use app\models\publications;
use app\models\services;
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
        $servicesModel->curr_page = (empty($page) ? 1 : $page);

        $params['services'] = $servicesModel->getServicesList();
        $params['count'] = $servicesModel->items_amount;
        $params['total'] = $servicesModel->pages_amount;
        $params['current'] = $servicesModel->curr_page;
        $params['canWrite'] = CMS::hasAccessTo('publications/list', 'write');
        $params['link_sc'] = utils::trueLink(['controller', 'action', 'q', 'filter']);
        $params['link_return'] = urlencode(SITE . CMS_DIR . utils::trueLink(['controller', 'action', 'q', 'filter', 'page']));
        $params['servicesTypes'] = $servicesModel->getServicesTypes();

        return self::render('services_list', $params);
    }

    public static function action_add()
    {
        self::$layout = 'common_layout';
        view::$title = CMS::t('menu_item_service_add');
        $services = new services();
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
        $params['allowed_cats'] = @$allowed_cats;
        $params['cats'] = nav::getCats();
        $params['allowed_thumb_ext'] = images::$allowed_ext;
        $params['servicesTypes'] = $services->getServicesTypes();

        return self::render('service_add', $params);
    }

}