<?php

namespace app\controllers;

use app\helpers\app;
use app\models\articles;
use app\models\gallery;
use app\models\nav;
use profit_az\profit_cms\CMS;
use profit_az\profit_cms\base\controller;
use profit_az\profit_cms\helpers\tr;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}

class articles_controller extends controller {

	private static $runtime = [];

	public static function action_list() { // 2016-12-04
		self::$layout = 'common_layout';
		view::$title = CMS::t('menu_item_articles_list');

		$params = [];

		$page = intval(@$_GET['page']);
		articles::$curr_pg = (empty($page)? 1: $page);

		if (ADMIN_TYPE!='admin') {
			$allowed_cats = nav::getEditorAllowedCats(ADMIN_ID);
		}

		articles::prefiltrateRestrictedCategories(@$allowed_cats);
		$params['articles'] = articles::getArticlesList();
		articles::restoreCategoriesFilter(@$allowed_cats);

		$params['count'] = articles::$items_amount;
		$params['total'] = articles::$pages_amount;
		$params['current'] = articles::$curr_pg;

		$params['canWrite'] = CMS::hasAccessTo('articles/list', 'write');
		$params['link_sc'] = utils::trueLink(['controller', 'action', 'q', 'filter']);
		$params['link_return'] = urlencode(SITE.CMS_DIR.utils::trueLink(['controller', 'action', 'q', 'filter', 'page']));

		$params['authors'] = articles::getAuthors();
		$params['allowed_cats'] = @$allowed_cats;
		$params['cats'] = nav::getCats();

		return self::render('articles_list', $params);
	}

	public static function action_add() { // 2016-12-05
		self::$layout = 'common_layout';
		view::$title = CMS::t('menu_item_articles_add');

		$params = [];

		$params['canWrite'] = CMS::hasAccessTo('articles/add', 'write');
		$params['link_back'] = (empty($_GET['return'])? '?controller=articles&action=list': $_GET['return']);

		if (ADMIN_TYPE!='admin') {
			$allowed_cats = nav::getEditorAllowedCats(ADMIN_ID);
		}

		if (isset($_POST['add'])) {
			$params['op'] = articles::addArticle();
			if ($params['op']['success']) {
				utils::delayedRedirect($params['link_back']);
			} else {
				if (!empty($_POST['gallery_id'])) {
					$params['gallery'] = gallery::getGalleryInfo($_POST['gallery_id']);
				}
			}
		}

		$params['langs'] = CMS::$site_langs;
		$params['allowed_cats'] = @$allowed_cats;
		$params['cats'] = nav::getCats();
		$params['allowed_thumb_ext'] = articles::$allowed_thumb_ext;

		return self::render('articles_add', $params);
	}

	public static function action_edit() { // 2016-01-15
		self::$layout = 'common_layout';
		view::$title = CMS::t('menu_item_articles_edit');

		$params = [];

		$params['canWrite'] = CMS::hasAccessTo('articles/edit', 'write');
		$params['link_back'] = (empty($_GET['return'])? '?controller=articles&action=list': $_GET['return']);

		if (ADMIN_TYPE!='admin') {
			$allowed_cats = nav::getEditorAllowedCats(ADMIN_ID);
		}

		$id = @(int)$_GET['id'];
		$params['article'] = articles::getArticle($id);
		if (empty($params['article']['id'])) {
			return CMS::resolve('base/404');
		}

		$params['langs'] = CMS::$site_langs;
		$params['cats'] = nav::getCats();
		$params['art_cats'] = articles::getArtCats($id);
		$params['comments_num'] = articles::countArticleComments($id);
		$params['allowed_thumb_ext'] = articles::$allowed_thumb_ext;

		if (isset($_POST['save']) || isset($_POST['apply']) || isset($_POST['is_published'])) {
			if (!$params['canWrite']) {CMS::logout();}
			$params['op'] = articles::editArticle($id);
			$params['article'] = articles::getArticle($id);
			//print "<pre>\n".var_export($params['op'], 1)."\n\nQUERIES:\n".var_export(CMS::$db->queries, 1)."\n\nERRORS:\n".var_export(CMS::$db->errors, 1)."\n</pre>";
			if ($params['op']['success'] && isset($_POST['save'])) {
				utils::delayedRedirect($params['link_back']);
			}
		}

		if (!empty($_POST['gallery_id'])) {
			$params['gallery'] = gallery::getGalleryInfo($_POST['gallery_id']);
		} else if (!empty($params['article']['gallery_id'])) {
			$params['gallery'] = gallery::getGalleryInfo($params['article']['gallery_id']);
		}


		return self::render('articles_edit', $params);
	}

	public static function action_delete() { // 2016-11-17
		self::$layout = 'common_layout';
		view::$title = CMS::t('delete');

		$params = [];

		$params['canWrite'] = CMS::hasAccessTo('articles/delete', 'write');
		$params['link_back'] = (empty($_GET['return'])? '?controller=articles&action=list': $_GET['return']);

		$deleted = false;
		if ($params['canWrite']) {
			$deleted = articles::deleteArticle(@$_POST['delete']);
		}
		$params['op']['success'] = $deleted;
		$params['op']['message'] = 'del_'.($deleted? 'suc': 'err');

		return self::render('cms_user_delete', $params);
	}

	public static function action_ajax_set_status() { // 2016-12-04
		header('Content-type: application/json; charset=utf-8');

		$response = ['success' => false, 'message' => 'ajax_invalid_request'];

		if (!CMS::hasAccessTo('articles/ajax_set_status', 'write')) {
			$response['code'] = '403';
			$response['message'] = 'ajax_request_not_allowed_to_write';
		} else if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest') {
			$id = @(int)$_POST['id'];
			$status = @(string)$_POST['turn'];
			$updated = articles::setArticleStatus($id, $status);
			if ($updated) {
				$response['success'] = true;
				$response['message'] = 'update_suc';
				$response['data']['action'] = $status;
			}
		}

		return json_encode($response);
	}

	public static function action_ajax_sort() { // 2016-12-05
		header('Content-type: application/json; charset=utf-8');

		$response = ['success' => false, 'message' => 'ajax_invalid_request'];

		if (!CMS::hasAccessTo('articles/ajax_sort', 'write')) {
			$response['code'] = '403';
			$response['message'] = 'ajax_request_not_allowed_to_write';
		} else if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest') {
			if (!empty($_POST['start_id']) && !empty($_POST['end_id'])) {
				$sorted = articles::sortArticles($_POST['start_id'], $_POST['end_id']);

				if ($sorted) {
					$response['success'] = true;
					$response['message'] = 'ajax_request_performed_successfully';
				}
			}
		}

		return json_encode($response);
	}

	public static function action_ajax_paged_sort() { // 2016-12-05
		header('Content-type: application/json; charset=utf-8');

		$response = ['success' => false, 'message' => 'ajax_invalid_request'];

		if (!CMS::hasAccessTo('articles/ajax_paged_sort', 'write')) {
			$response['code'] = '403';
			$response['message'] = 'ajax_request_not_allowed_to_write';
		} else if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest') {
			if (!empty($_POST['item_id']) && !empty($_POST['target_page'])) {
				$sorted = articles::sortArticlesPaged($_POST['item_id'], $_POST['target_page']);

				if ($sorted) {
					$response['success'] = true;
					$response['message'] = 'ajax_request_performed_successfully';
				}
			}
		}

		return json_encode($response);
	}

	public static function action_ajax_get_autocomplete() { // 2016-12-05
		header('Content-type: application/json; charset=utf-8');

		$response = ['success' => false, 'message' => 'ajax_invalid_request'];

		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest') {
			if (isset($_GET['q'])) {
				$opts = articles::getArticlesAutocomplete($_GET['q'], @$_GET['page']);

				$response['success'] = true;
				$response['message'] = 'ajax_request_performed_successfully';
				if ($opts) {
					$response['data'] = $opts;
				}
			} else {
				$response['message'] = 'ajax_request_search_query_is_not_specified';
			}
		}

		return json_encode($response);
	}

	public static function action_ajax_delete_image() { // 2016-12-05
		header('Content-type: application/json; charset=utf-8');

		$response = ['success' => false, 'message' => 'ajax_invalid_request'];

		if (!CMS::hasAccessTo('articles/ajax_delete_image', 'write')) {
			$response['code'] = '403';
			$response['message'] = 'ajax_request_not_allowed_to_write';
		} else if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest') {
			if (!empty($_POST['article_id'])) {
				$deleted = articles::deleteArticleImages($_POST['article_id']);

				if ($deleted) {
					$response['success'] = true;
					$response['message'] = 'Performed successfully';
				}
			}
		}

		return json_encode($response);
	}
}

?>