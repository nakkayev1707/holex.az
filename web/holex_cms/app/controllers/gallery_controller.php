<?php

namespace app\controllers;

use app\helpers\app;
use app\models\gallery;
use app\models\nav;
use profit_az\profit_cms\CMS;
use profit_az\profit_cms\base\controller;
use profit_az\profit_cms\helpers\tr;
use profit_az\profit_cms\helpers\utils;
use profit_az\profit_cms\helpers\view;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}

class gallery_controller extends controller {

	private static $runtime = [];

	public static function action_list() { // 2017-01-17
		self::$layout = 'common_layout';
		view::$title = CMS::t('menu_item_gallery_list');

		$params = [];

		$page = intval(@$_GET['page']);
		gallery::$curr_pg = (empty($page)? 1: $page);

		$params['galleries'] = gallery::getGalleriesList();

		$params['count'] = gallery::$items_amount;
		$params['total'] = gallery::$pages_amount;
		$params['current'] = gallery::$curr_pg;

		$params['canWrite'] = CMS::hasAccessTo('gallery/list', 'write');
		$params['link_sc'] = utils::trueLink(['controller', 'action', 'q', 'filter']);
		$params['link_return'] = urlencode(SITE.CMS_DIR.utils::trueLink(['controller', 'action', 'q', 'filter', 'page']));

		$params['authors'] = gallery::getAuthors();

		return self::render('gallery_list', $params);
	}

	public static function action_ajax_set_status() { // 2017-01-18
		header('Content-type: application/json; charset=utf-8');

		$response = ['success' => false, 'message' => 'ajax_invalid_request'];

		if (!CMS::hasAccessTo('gallery/ajax_set_status', 'write')) {
			$response['code'] = '403';
			$response['message'] = 'ajax_request_not_allowed_to_write';
		} else if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest') {
			$id = @(int)$_POST['id'];
			$status = @(string)$_POST['turn'];
			$updated = gallery::setGalleryStatus($id, $status);
			if ($updated) {
				$response['success'] = true;
				$response['message'] = 'update_suc';
				$response['data']['action'] = $status;
			}
		}

		return json_encode($response);
	}

	public static function action_delete() { // 2017-01-18
		self::$layout = 'common_layout';
		view::$title = CMS::t('delete');

		$params = [];

		$params['canWrite'] = CMS::hasAccessTo('gallery/delete', 'write');
		$params['link_back'] = (empty($_GET['return'])? '?controller=gallery&action=list': $_GET['return']);

		$deleted = false;
		if ($params['canWrite']) {
			$deleted = gallery::moveGalleryToBin(@$_POST['delete']);
		}
		$params['op']['success'] = $deleted;
		$params['op']['message'] = 'del_'.($deleted? 'suc': 'err');

		return self::render('cms_user_delete', $params);
	}

	public static function action_add() { // 2017-01-20
		self::$layout = 'common_layout';
		view::$title = CMS::t('menu_item_gallery_add');

		$params = [];

		$params['canWrite'] = CMS::hasAccessTo('gallery/add', 'write');
		$params['link_back'] = (empty($_GET['return'])? '?controller=gallery&action=list': $_GET['return']);

		$params['langs'] = CMS::$site_langs;

		if (isset($_POST['add'])) {
			$params['op'] = gallery::addGallery();
			if ($params['op']['success']) {
				utils::delayedRedirect($params['link_back']);
			}
		}

		return self::render('gallery_add', $params);
	}

	public static function action_edit() { // 2017-01-21
		self::$layout = 'common_layout';
		view::$title = CMS::t('menu_item_gallery_edit');

		$params = [];

		$params['canWrite'] = CMS::hasAccessTo('gallery/edit', 'write');
		$params['link_back'] = (empty($_GET['return'])? '?controller=gallery&action=list': $_GET['return']);

		$id = @(int)$_GET['id'];
		$params['gallery'] = gallery::getGalleryInfo($id);
		if (empty($params['gallery']['id'])) {
			return CMS::resolve('base/404');
		}

		$params['langs'] = CMS::$site_langs;


		if (isset($_POST['save']) || isset($_POST['apply'])) {
			if (!$params['canWrite']) {CMS::logout();}

			$params['op'] = gallery::editGallery($id);
			$params['gallery'] = gallery::getGalleryInfo($id);
			//print "<pre>\n".var_export($params['op'], 1)."\n\nQUERIES:\n".var_export(CMS::$db->queries, 1)."\n\nERRORS:\n".var_export(CMS::$db->errors, 1)."\n</pre>";
			if ($params['op']['success'] && isset($_POST['save'])) {
				utils::delayedRedirect($params['link_back']);
			}
		}


		return self::render('gallery_edit', $params);
	}

	public static function action_ajax_get_autocomplete() { // 2016-12-05
		header('Content-type: application/json; charset=utf-8');

		$response = ['success' => false, 'message' => 'ajax_invalid_request'];

		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest') {
			if (isset($_GET['q'])) {
				$opts = gallery::getAutocomplete($_GET['q'], @$_GET['page']);

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

	public static function action_photos() { // 2017-01-23
		self::$layout = 'common_layout';
		view::$title = CMS::t('menu_item_gallery_list');

		$params = [];

		$params['canWrite'] = CMS::hasAccessTo('gallery/photos', 'write');
		$params['link_sc'] = utils::trueLink(['controller', 'action', 'gallery_id', 'q', 'filter']);
		$params['link_return'] = urlencode(SITE.CMS_DIR.utils::trueLink(['controller', 'action', 'gallery_id', 'q', 'filter', 'page', 'no_pagination']));
		$params['link_back'] = (empty($_GET['return'])? '?controller=gallery&action=list': $_GET['return']);

		$page = intval(@$_GET['page']);
		gallery::$curr_pg = (empty($page)? 1: $page);

		$gallery_id = @(int)$_GET['gallery_id'];
		$params['gallery'] = gallery::getGalleryInfo($gallery_id);
		if (empty($params['gallery']['id'])) {
			return CMS::resolve('base/404');
		}
		$params['gallery_dir'] = gallery::$dir;

		$params['photos'] = gallery::getGalleryPhotos($gallery_id);

		$params['count'] = gallery::$items_amount;
		$params['total'] = gallery::$pages_amount;
		$params['current'] = gallery::$curr_pg;

		$params['authors'] = gallery::getAuthors();

		return self::render('gallery_photos', $params);
	}

	public static function action_add_photo() { // 2017-02-01
		self::$layout = 'common_layout';
		view::$title = CMS::t('menu_item_gallery_add_photo');

		$params = [];

		$params['canWrite'] = CMS::hasAccessTo('gallery/add_photo', 'write');
		$params['link_back'] = (empty($_GET['return'])? '?controller=gallery&action=photos': $_GET['return']);

		$gallery_id = @(int)$_GET['gallery_id'];
		$params['gallery'] = gallery::getGalleryInfo($gallery_id);
		if (empty($params['gallery']['id'])) {
			return CMS::resolve('base/404');
		}

		if (utils::isPostOverflow()) {
			$params['op'] = ['success' => false, 'message' => 'upl_ini_size_err'];
		}
		if (isset($_POST['add'])) {
			$params['op'] = gallery::addPhotos($gallery_id);
			if ($params['op']['success']) {
				utils::delayedRedirect($params['link_back']);
			}
		}

		$params['langs'] = CMS::$site_langs;

		return self::render('gallery_add_photo', $params);
	}

	public static function action_edit_photo() { // 2017-02-01
		self::$layout = 'common_layout';
		view::$title = CMS::t('menu_item_gallery_edit_photo');

		$params = [];

		$params['canWrite'] = CMS::hasAccessTo('gallery/edit_photo', 'write');
		$params['link_back'] = (empty($_GET['return'])? '?controller=gallery&action=photos': $_GET['return']);

		$photo_id = @(int)$_GET['id'];
		$params['photo'] = gallery::getPhoto($photo_id);
		if (empty($params['photo']['id'])) {
			return CMS::resolve('base/404');
		}
		$params['gallery'] = gallery::getGalleryInfo($params['photo']['gallery_id']);
		if (empty($params['gallery']['id'])) {
			return CMS::resolve('base/404');
		}
		$params['gallery_dir'] = gallery::$dir;

		if (utils::isPostOverflow()) {
			$params['op'] = ['success' => false, 'message' => 'upl_ini_size_err'];
		}
		if (isset($_POST['save']) || isset($_POST['apply'])) {
			if (!$params['canWrite']) {CMS::logout();}
			$params['op'] = gallery::editPhoto($params['photo']['id']);
			$params['photo'] = gallery::getPhoto($photo_id);
			//print "<pre>\n".var_export($params['op'], 1)."\n\nQUERIES:\n".var_export(CMS::$db->queries, 1)."\n\nERRORS:\n".var_export(CMS::$db->errors, 1)."\n</pre>";
			if ($params['op']['success'] && isset($_POST['save'])) {
				utils::delayedRedirect($params['link_back']);
			}
		}

		$params['langs'] = CMS::$site_langs;

		return self::render('gallery_edit_photo', $params);
	}

	public static function action_delete_photo() { // 2017-02-01
		self::$layout = 'common_layout';
		view::$title = CMS::t('delete');

		$params = [];

		$params['canWrite'] = CMS::hasAccessTo('gallery/delete_photo', 'write');
		$params['link_back'] = (empty($_GET['return'])? '?controller=gallery&action=list': $_GET['return']);

		$deleted = false;
		if ($params['canWrite']) {
			$deleted = gallery::deletePhoto($_GET['delete_id']);
		}
		$params['op']['success'] = $deleted;
		$params['op']['message'] = 'del_'.($deleted? 'suc': 'err');

		return self::render('cms_user_delete', $params);
	}

	public static function action_ajax_photos_sort() { // 2017-01-30
		header('Content-type: application/json; charset=utf-8');

		$response = ['success' => false, 'message' => 'ajax_invalid_request'];

		if (!CMS::hasAccessTo('gallery/ajax_photos_sort', 'write')) {
			$response['code'] = '403';
			$response['message'] = 'ajax_request_not_allowed_to_write';
		} else if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest') {
			$gallery_id = intval(@$_GET['gallery_id']);
			if ($gallery_id) {
				$gallery = gallery::getGalleryInfo($gallery_id);
				if (empty($gallery['id'])) {
					$response['message'] = 'gallery_photos_sort_gallery_not_found';
				} else {
					$sorted = gallery::saveGalleryPhotosOrdering($gallery['id'], @$_POST['photo']);
					if ($sorted) {
						$response['success'] = true;
						$response['message'] = 'ajax_request_performed_successfully';
					}
				}
			} else {
				$response['message'] = 'gallery_photos_sort_gallery_not_found';
			}
		}

		return json_encode($response);
	}
}

?>