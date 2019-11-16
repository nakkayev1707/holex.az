<?php


namespace app\controllers;


use app\models\nav;
use app\models\site_users;
use app\models\users;
use profit_az\profit_cms\base\controller;
use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

class users_controller extends controller
{
    public static function action_list(){
        self::$layout = 'common_layout';
        view::$title = CMS::t('menu_item_users_list');

        $params = [];
        $page = intval(@$_GET['page']);

        $usersModel = new users();
        $usersModel->curr_page = (empty($page) ? 1 : $page);
        $params['users'] = $usersModel->getUsersList();
        $params['count'] = $usersModel->items_amount;
        $params['total'] = $usersModel->pages_amount;
        $params['current'] = $usersModel->curr_page;
        $params['canWrite'] = CMS::hasAccessTo('users/list', 'write');
        $params['link_sc'] = utils::trueLink(['controller', 'action', 'q', 'filter']);
        $params['link_return'] = urlencode(SITE . CMS_DIR . utils::trueLink(['controller', 'action', 'q', 'filter', 'page']));
        $params['cats'] = nav::getCats();

        return self::render('site_users_list', $params);
    }

    public static function action_delete() {
        self::$layout = 'common_layout';
        view::$title = CMS::t('delete');
        $users = new users();
        $params = [];

        $params['canWrite'] = CMS::hasAccessTo('users/delete', 'write');
        $params['link_back'] = (empty($_GET['return'])? '?controller=users&action=list': $_GET['return']);

        $deleted = false;
        if ($params['canWrite']) {
            $deleted = $users->deleteUser(@$_POST['delete']);
        }
        $params['op']['success'] = $deleted;
        $params['op']['message'] = 'del_'.($deleted? 'suc': 'err');

        return self::render('cms_user_delete', $params);
    }

    public static function action_view_info() {
        self::$layout = 'common_layout';
        view::$title = CMS::t('menu_item_site_users_view_info');
        $users = new users();
        $params = [];

        $params['canWrite'] = CMS::hasAccessTo('users/view_info', 'write');
        $params['link_back'] = (empty($_GET['return'])? '?controller=users&action=list': $_GET['return']);

        $id = @(int)$_GET['id'];
        $params['user'] = $users->getUser($id);

        if (empty($params['user']['id'])) {
            return CMS::resolve('base/404');
        }
        return self::render('site_user_info', $params);
    }

    public static function action_ajax_set_ban() {
        header('Content-type: application/json; charset=utf-8');
        $response = ['success' => false, 'message' => 'ajax_invalid_request'];
        $users = new users();

        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest') {
            $id = @(int)$_POST['user_id'];
            $status = @(string)$_POST['turn'];
            $updated = $users->setUserStatus($id, $status);
            if ($updated) {
                $response['success'] = true;
                $response['message'] = 'update_suc';
                $response['data']['action'] = $status;
            }
        }
        return json_encode($response);
    }

}