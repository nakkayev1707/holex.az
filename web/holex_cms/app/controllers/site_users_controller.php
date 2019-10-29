<?php

namespace app\controllers;

use app\helpers\app;
use app\models\site_users;
use profit_az\profit_cms\CMS;
use profit_az\profit_cms\base\controller;
//use profit_az\profit_cms\helpers\security;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}

class site_users_controller extends controller {

	private static $runtime = [];

	public static function action_list() { // 2016-11-17
		self::$layout = 'common_layout';
		view::$title = CMS::t('menu_item_site_users_list');

		$params = [];

		$page = intval(@$_GET['page']);
		site_users::$curr_pg = (empty($page)? 1: $page);

		$params['users'] = site_users::getUsersList();
		$params['count'] = site_users::$items_amount;
		$params['total'] = site_users::$pages_amount;
		$params['current'] = site_users::$curr_pg;

		$params['canWrite'] = CMS::hasAccessTo('site_users/list', 'write');
		$params['link_sc'] = utils::trueLink(['controller', 'action', 'q']);
		$params['link_return'] = urlencode(SITE.CMS_DIR.utils::trueLink(['controller', 'action', 'q', 'page']));

		$params['providers'] = site_users::getProvidersAvailable();

		return self::render('site_users_list', $params);
	}

	public static function action_delete() { // 2016-11-17
		self::$layout = 'common_layout';
		view::$title = CMS::t('delete');

		$params = [];

		$params['canWrite'] = CMS::hasAccessTo('site_users/delete', 'write');
		$params['link_back'] = (empty($_GET['return'])? '?controller=site_users&action=list': $_GET['return']);

		$deleted = false;
		if ($params['canWrite']) {
			$deleted = site_users::deleteUser(@$_POST['delete']);
		}
		$params['op']['success'] = $deleted;
		$params['op']['message'] = 'del_'.($deleted? 'suc': 'err');

		return self::render('cms_user_delete', $params);
	}

	public static function action_view_info() { // 2016-11-17
		self::$layout = 'common_layout';
		view::$title = CMS::t('menu_item_site_users_view_info');

		$params = [];

		$params['canWrite'] = CMS::hasAccessTo('site_users/view_info', 'write');
		$params['link_back'] = (empty($_GET['return'])? '?controller=site_users&action=list': $_GET['return']);

		$id = @(int)$_GET['id'];
		$params['user'] = site_users::getUser($id);

		if (empty($params['user']['id'])) {
			return CMS::resolve('base/404');
		}

		// $params['langs'] = CMS::getCMSLangsRegistered();
		$params['comments_num'] = site_users::countUserComments($params['user']['id']);

		return self::render('site_user_info', $params);
	}

	public static function action_ajax_set_ban() { // 2016-11-16
		header('Content-type: application/json; charset=utf-8');

		$response = ['success' => false, 'message' => 'ajax_invalid_request'];

		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest') {
			$id = @(int)$_POST['user_id'];
			$status = @(string)$_POST['turn'];
			$updated = site_users::setUserStatus($id, $status);
			if ($updated) {
				$response['success'] = true;
				$response['message'] = 'update_suc';
				$response['data']['action'] = $status;
			}
		}

		return json_encode($response);
	}
}

?>