<?php

namespace app\controllers;

use app\helpers\app;
use app\models\articles;
use app\models\nav;
use profit_az\profit_cms\CMS;
use profit_az\profit_cms\base\controller;
use profit_az\profit_cms\helpers\tr;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}

class nav_controller extends controller {

	private static $runtime = [];

	public static function action_list() { // 2017-04-16
		self::$layout = 'common_layout';
		view::$title = CMS::t('menu_block_nav');

		$params = [];

		$params['canWrite'] = CMS::hasAccessTo('nav/list', 'write');
		$params['link_sc'] = utils::trueLink(['controller', 'action', 'item']);
		$params['link_return'] = urlencode(SITE.CMS_DIR.utils::trueLink(['controller', 'action', 'item']));

		$params['menu'] = nav::getMenu();
		$params['langs'] = CMS::getLangsRegistered();
		$params['positions'] = nav::getPositions();
		$params['nav_types'] = nav::$types;

		return self::render('nav', $params);
	}

	public static function action_edit() { // 2017-04-20
		self::$layout = 'common_layout';
		view::$title = CMS::t('menu_block_nav');

		$params = [];

		$params['canWrite'] = CMS::hasAccessTo('nav/list', 'write');
		$params['link_sc'] = utils::trueLink(['controller', 'action', 'item']);
		$params['link_return'] = urlencode(SITE.CMS_DIR.utils::trueLink(['controller', 'action', 'item']));

		if (isset($_POST['save']) || isset($_POST['apply'])) {
			$params['op'] = nav::editNavItem(@$_GET['item']);
			//print "<pre>\n".var_export($params['op'], 1)."\n\nQUERIES:\n".var_export(CMS::$db->queries, 1)."\n\nERRORS:\n".var_export(CMS::$db->errors, 1)."\n</pre>";

			if ($params['op']['success']) {
				if (isset($_POST['save'])) {
					utils::delayedRedirect($params['link_sc']);
				}
			}
		}

		$params['menu'] = nav::getMenu();
		$params['langs'] = CMS::getLangsRegistered();
		$params['positions'] = nav::getPositions();
		$params['nav_types'] = nav::$types;
		$params['item'] = nav::getNavItem($_GET['item']);
		if (!empty($params['item'])) {
			$params['article'] = articles::getArticle($params['item']['ref_id']);
		}
		// print "<pre>RESULT:\n".var_export($params['item'], 1)."\n\nQUERIES:\n".var_export(CMS::$db->queries, 1)."\n\nERRORS:\n".var_export(CMS::$db->errors, 1)."\n</pre>";

		if (empty($params['item']['id'])) {
			return CMS::resolve('base/404');
		}

		return self::render('nav', $params);
	}

	public static function action_add() { // 2017-04-29
		self::$layout = 'common_layout';
		view::$title = CMS::t('menu_block_nav');

		$params = [];

		$params['canWrite'] = CMS::hasAccessTo('nav/list', 'write');
		$params['link_sc'] = utils::trueLink(['controller', 'action', 'item']);
		$params['link_return'] = urlencode(SITE.CMS_DIR.utils::trueLink(['controller', 'action', 'item']));
		$params['link_back'] = (empty($_GET['return'])? '?controller=nav&action=list': $_GET['return']);

		if (!empty($_GET['item'])) {
			$params['item'] = nav::getNavItem($_GET['item']);
			if (empty($params['item']['id'])) {
				return CMS::resolve('base/404');
			}
		}

		if (isset($_POST['add'])) {
			$params['op'] = nav::addNavItem();

			if ($params['op']['success']) {
				utils::delayedRedirect('?controller=nav&action=edit&item='.$params['op']['data']['item_id']);
			} else {
				if (!empty($_POST['ref_id'])) {
					$params['article'] = articles::getArticle($_POST['ref_id']);
				}
			}
		}

		$params['menu'] = nav::getMenu();
		$params['langs'] = CMS::getLangsRegistered();
		$params['positions'] = nav::getPositions();
		$params['nav_types'] = nav::$types;

		return self::render('nav', $params);
	}

	public static function action_delete() { // 2017-04-22
		self::$layout = 'common_layout';
		view::$title = CMS::t('delete');

		$params = [];

		$params['canWrite'] = CMS::hasAccessTo('nav/delete', 'write');
		$params['link_back'] = (empty($_GET['return'])? '?controller=nav&action=list': $_GET['return']);
		$params['link_sc'] = utils::trueLink(['controller', 'action', 'item']);

		$deleted = false;
		if ($params['canWrite']) {
			$item = nav::getNavItem($_POST['delete']);
			if (!empty($item['id'])) {
				$deleted = nav::deleteNavItem($item['id']);
			}
			if (empty($deleted)) {
				utils::delayedRedirect($params['link_sc']);
			} else {
				utils::delayedRedirect('?controller='.$_GET['controller'].'&action='.(empty($item['parent_id'])? 'list': ('edit&item='.$item['parent_id'])));
			}
		}

		$params['op']['success'] = $deleted;
		$params['op']['message'] = 'del_'.($deleted? 'suc': 'err');

		return self::render('cms_user_delete', $params);
	}

	public static function action_ajax_set_parent() { // 2017-05-08
		header('Content-type: application/json; charset=utf-8');

		$response = ['success' => false, 'message' => 'ajax_invalid_request'];

		if (!CMS::hasAccessTo('nav/ajax_set_parent', 'write')) {
			$response['code'] = '403';
			$response['message'] = 'ajax_request_not_allowed_to_write';
		} else if (utils::isAjax()) {
			if (!empty($_POST['id'])) {
				$nested = nav::setNavItemParent($_POST['id'], $_POST['parent']);
				if ($nested) {
					$sorted = nav::setNavItemPosition($_POST['id'], $_POST['pos']);

					if ($sorted) {
						$response['success'] = true;
						$response['message'] = 'ajax_request_performed_successfully';
					}
				}
			}
		}

		return json_encode($response);
	}

	public static function action_ajax_set_position() { // 2017-05-08
		header('Content-type: application/json; charset=utf-8');

		$response = ['success' => false, 'message' => 'ajax_invalid_request'];

		if (!CMS::hasAccessTo('nav/ajax_set_position', 'write')) {
			$response['code'] = '403';
			$response['message'] = 'ajax_request_not_allowed_to_write';
		} else if (utils::isAjax()) {
			if (!empty($_POST['id'])) {
				$sorted = nav::setNavItemPosition($_POST['id'], $_POST['pos']);

				if ($sorted) {
					$response['success'] = true;
					$response['message'] = 'Performed successfully';
				}
			}
		}

		return json_encode($response);
	}
}

?>