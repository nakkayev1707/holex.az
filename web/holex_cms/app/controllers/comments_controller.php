<?php

namespace app\controllers;

use app\helpers\app;
use app\models\comments;
use app\models\site_users;
use profit_az\profit_cms\CMS;
use profit_az\profit_cms\base\controller;
use profit_az\profit_cms\helpers\tr;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}

class comments_controller extends controller {

	private static $runtime = [];

	public static function action_list() { // 2016-11-17
		self::$layout = 'common_layout';
		view::$title = CMS::t('menu_item_comments_list');

		$params = [];

		$page = intval(@$_GET['page']);
		comments::$curr_pg = (empty($page)? 1: $page);

		$params['comments'] = comments::getCommentsList();
		$params['count'] = comments::$items_amount;
		$params['total'] = comments::$pages_amount;
		$params['current'] = comments::$curr_pg;

		$params['canWrite'] = CMS::hasAccessTo('comments/list', 'write');
		$params['link_sc'] = utils::trueLink(['controller', 'action', 'q', 'filter']);
		$params['link_return'] = urlencode(SITE.CMS_DIR.utils::trueLink(['controller', 'action', 'q', 'filter', 'page']));

		if (!empty($_GET['filter']['user_id'])) {
			$params['user'] = site_users::getUser($_GET['filter']['user_id']);
		}
		if (!empty($_GET['filter']['ref_table']) && !empty($_GET['filter']['ref_id'])) {
			$params['content'] = tr::findContent($_GET['filter']['ref_table'], $_GET['filter']['ref_id']);
			// print "<pre>RESULT:\n".var_export($content, 1)."\n\nQUERIES:\n".var_export(CMS::$db->queries, 1)."\n\nERRORS:\n".var_export(CMS::$db->errors, 1)."\n</pre>";
		}

		return self::render('comments_list', $params);
	}

	public static function action_delete() { // 2016-11-17
		self::$layout = 'common_layout';
		view::$title = CMS::t('delete');

		$params = [];

		$params['canWrite'] = CMS::hasAccessTo('comments/delete', 'write');
		$params['link_back'] = (empty($_GET['return'])? '?controller=comments&action=list': $_GET['return']);

		$deleted = false;
		if ($params['canWrite']) {
			$deleted = comments::deleteComment(@$_POST['delete']);
		}
		$params['op']['success'] = $deleted;
		$params['op']['message'] = 'del_'.($deleted? 'suc': 'err');

		return self::render('cms_user_delete', $params);
	}

	public static function action_edit() { // 2016-12-04
		self::$layout = 'common_layout';
		view::$title = CMS::t('menu_item_comments_edit');

		$params = [];

		$params['canWrite'] = CMS::hasAccessTo('comments/edit', 'write');
		$params['link_back'] = (empty($_GET['return'])? '?controller=comments&action=list': $_GET['return']);

		$id = @(int)$_GET['id'];
		$params['comment'] = comments::getComment($id);
		if (empty($params['comment']['id'])) {
			return CMS::resolve('base/404');
		}

		$params['user'] = site_users::getUser($params['comment']['user_id']);
		if (empty($params['user']['id'])) {
			return CMS::resolve('base/404');
		}

		$params['content'] = tr::findContent($params['comment']['ref_table'], $params['comment']['ref_id']);

		if ($params['canWrite'] && ($params['comment']['is_inspected']=='0')) {
			comments::touchComment($id);
		}

		// $params['langs'] = CMS::getCMSLangsRegistered();


		if (isset($_POST['save']) || isset($_POST['apply']) || isset($_POST['is_published'])) {
			if (!$params['canWrite']) {CMS::logout();}
			$params['op'] = comments::editComment($id);
			$params['comment'] = comments::getComment($id);
			//print "<pre>\n".var_export($params['op'], 1)."\n\nQUERIES:\n".var_export(CMS::$db->queries, 1)."\n\nERRORS:\n".var_export(CMS::$db->errors, 1)."\n</pre>";
			if ($params['op']['success'] && isset($_POST['save'])) {
				utils::delayedRedirect($params['link_back']);
			}
		}


		return self::render('comments_edit', $params);
	}

	public static function action_ajax_set_status() { // 2016-12-04
		header('Content-type: application/json; charset=utf-8');

		$response = ['success' => false, 'message' => 'ajax_invalid_request'];

		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest') {
			$id = @(int)$_POST['comment_id'];
			$status = @(string)$_POST['turn'];
			$updated = comments::setCommentStatus($id, $status);
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