<?php

namespace app\models;

use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\tr;
use profit_az\profit_cms\helpers\utils;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}

class nav {
	public static $tr_fields = ['name', 'is_published_lang'];
	public static $types = ['category', 'article', 'spec', 'url'];


	/* private functions */

	private static function checkSef(&$response, &$item, $item_id=0) { // 2016-05-11
		$sef = utils::makeSef(@$_POST['sef']);

		if (empty($sef)) {
			$sef = utils::makeSef(@$_POST['name'][CMS::$default_site_lang]);
		}

		if (empty($sef)) {
			$response['errors'][] = 'nav_menu_add_item_err_sef_invalid';
			return;
		}

		self::clearDeletedSef($sef);
		if (self::isSefExists($sef, $item_id)) {
			$response['errors'][] = 'nav_menu_add_item_err_sef_exists';
			return;
		}

		$item['sef'] = $sef;
	}

	private static function checkArticleId(&$response, &$item, $item_id=0) { // 2016-05-12
		$item['ref_table'] = 'articles';
		$article_id = (int)@$_POST['ref_id'];
		if (empty($article_id)) {
			$response['errors'][] = 'nav_menu_add_item_err_article_id_empty';
		} else if (!CMS::$db->get("SELECT id FROM articles WHERE id=:article_id LIMIT 1", [':article_id' => $article_id])) {
			$response['errors'][] = 'nav_menu_add_item_err_article_id_not_exists';
		} else if (self::isArticleNavItemExists($article_id, $item_id)) {
			$response['errors'][] = 'nav_menu_add_item_err_article_id_item_exists';
		} else {
			$item['ref_id'] = $article_id;
		}
	}

	private static function checkUrl(&$response, &$item, $item_id=0) { // 2016-05-11
		$url = trim((string)@$_POST['url']);
		if (empty($url)) {
			$response['errors'][] = 'nav_menu_add_item_err_url_empty';
		} else {
			$item['url'] = $url;
		}
	}

	private static function processNavItemTranslates(&$response, &$translates) { // 2016-05-11
		foreach (CMS::$site_langs as $lng) {
			foreach (self::$tr_fields as $f) {
				if (in_array($f, ['name'])) {
					$translates[$lng['language_dir']][$f] = trim(@$_POST[$f][$lng['language_dir']]);

					if (($lng['language_dir']==CMS::$default_site_lang) || !empty($_POST['is_published_lang'][$lng['language_dir']])) {
						if (empty($translates[$lng['language_dir']][$f]) && in_array($f, ['name'])) {
							$response['errors'][] = 'nav_menu_add_item_err_'.$f.'_empty';
						}
					}
				} else if (in_array($f, ['is_published_lang'])) {
					$translates[$lng['language_dir']][$f] = (empty($_POST[$f][$lng['language_dir']])? '0': '1');
				}
			}
		}
	}

	private static function processNavItemPositions(&$response, &$positions) { // 2016-05-11
		if (empty($_POST['position']) || !is_array($_POST['position'])) {
			$response['errors'][] = 'nav_menu_add_item_err_position_empty';
		} else {
			$exists = CMS::$db->getPairs("SELECT position, id FROM nav_positions");
			foreach ($_POST['position'] as $pos=>$value) {
				if (isset($exists[$pos])) {
					$positions[] = $exists[$pos];
				}
			}
		}
	}

	/* public functions */

	public static function getPositions() { // 2016-05-10
		$l = (($_SESSION[CMS::$sess_hash]['ses_adm_lang']=='az')? 'az': 'ru');
		$sql = "SELECT id, position, name_{$l} AS name
			FROM nav_positions";
		return CMS::$db->getAll($sql);
	}

	public static function getMenu($parent=false) { // 2016-05-11
		$menu = [];

		$sql = "SELECT n.*, tr.text AS name
			FROM menu n
				LEFT JOIN translates tr ON tr.ref_table='menu' AND tr.ref_id=n.id AND tr.lang=:default_site_lang AND tr.fieldname='name'
			WHERE is_deleted='0'".(empty($parent)? " AND parent_id='0'": (" AND parent_id='".(int)$parent."'"))."
			ORDER BY ordering ASC";
		$menu = CMS::$db->getAll($sql, [
			':default_site_lang' => CMS::$default_site_lang
		]);

		if (!empty($menu) && is_array($menu)) foreach ($menu as $i=>$item) {
			$children = self::getMenu($item['id']);
			if (!empty($children) && is_array($children)) {
				$menu[$i]['children'] = $children;
			}
		}

		return $menu;
	}

	public static function getNavItem($id) { // 2016-05-11
		$sql = "SELECT n.*, cu.name AS author_name, mcu.name AS editor_name
			FROM menu n
				JOIN cms_users cu ON cu.id=n.add_by
				LEFT JOIN cms_users mcu ON mcu.id=n.mod_by
			WHERE n.id=:item_id AND n.is_deleted='0'
			LIMIT 1";
		$item = CMS::$db->getRow($sql, [
			':item_id' => $id
		]);

		if (!empty($item['id'])) {
			$item['translates'] = tr::get('menu', $id);
		}

		if (empty($item['parent_id'])) {
			$item['positions'] = CMS::$db->getList("SELECT p.position
				FROM menu_navpos_rel mpr
					JOIN nav_positions p ON p.id=navpos_id
				WHERE mpr.item_id=:item_id", [
					':item_id' => $id
				]);
		}

		return $item;
	}

	public static function addNavItem() { // 2016-05-25
		$response = ['success' => false, 'message' => 'insert_err'];

		$item = [];
		$translates = [];
		$positions = [];

		$item['parent_id'] = (int)@$_GET['item'];

		if (in_array(@$_POST['type'], self::$types)) {
			$item['type'] = $_POST['type'];

			switch ($item['type']) {
				case 'article':
					self::checkArticleId($response, $item);
				case 'category':
				case 'spec':
					self::checkSef($response, $item);
				break;
				case 'url':
					self::checkUrl($response, $item);
				break;
			}
		} else {
			$response['errors'][] = 'nav_menu_add_item_err_type_invalid';
		}

		self::processNavItemTranslates($response, $translates);

		if (empty($item['parent_id'])) {
			self::processNavItemPositions($response, $positions);
		}

		if (empty($response['errors'])) {
			$item['ordering'] = CMS::$db->get("SELECT MAX(ordering) FROM menu WHERE parent_id=:parent_id", [
				':parent_id' => $item['parent_id']
			])+1;
			$item['is_published'] = (empty($_POST['is_published'])? '0': '1');
			$item['is_section'] = (empty($_POST['is_section'])? '0': '1');
			$item['add_by'] = $_SESSION[CMS::$sess_hash]['ses_adm_id'];
			$item['add_datetime'] = date('Y-m-d H:i:s');

			$item_id = CMS::$db->add('menu', $item);

			if ($item_id) {
				$response['success'] = true;
				$response['message'] = 'insert_suc';
				$response['data']['item_id'] = $item_id;

				// saving translates
				foreach ($translates as $lang=>$tr_data) {
					foreach ($tr_data as $fieldname=>$text) {
						tr::store([
							'ref_table' => 'menu',
							'ref_id' => $item_id,
							'lang' => $lang,
							'fieldname' => $fieldname,
							'text' => $text,
						]);
					}
				}

				// saving positions
				foreach ($positions as $navpos_id) {
					CMS::$db->add('menu_navpos_rel', [
						'item_id' => $item_id,
						'navpos_id' => $navpos_id
					]);
				}

				// log event
				CMS::log([
					'subj_table' => 'menu',
					'subj_id' => $item_id,
					'action' => 'add',
					'descr' => 'Menu item added by admin '.ADMIN_INFO,
				]);
			}
		}

		return $response;
	}

	public static function editNavItem($id) { // 2016-05-11
		$response = ['success' => false, 'message' => 'update_err'];

		$old_data = self::getNavItem($id);
		if (empty($old_data['id'])) {
			$response['message'] = 'nav_menu_edit_item_err_not_found';
			return $response;
		}

		$item = [];
		$translates = [];
		$positions = [];

		// validation
		if (in_array(@$_POST['type'], self::$types)) {
			$item['type'] = $_POST['type'];

			switch ($item['type']) {
				case 'article':
					self::checkArticleId($response, $item, $id);
				case 'category':
				case 'spec':
					self::checkSef($response, $item, $id);
				break;
				case 'url':
					self::checkUrl($response, $item, $id);
				break;
			}
		} else {
			$response['errors'][] = 'nav_menu_add_item_err_type_invalid';
		}

		self::processNavItemTranslates($response, $translates);

		if (empty($old_data['parent_id'])) {
			self::processNavItemPositions($response, $positions);
		}
		// EOF validation

		if (empty($response['errors'])) {
			$item['is_published'] = (empty($_POST['is_published'])? '0': '1');
			$item['is_section'] = (empty($_POST['is_section'])? '0': '1');
			$item['mod_by'] = $_SESSION[CMS::$sess_hash]['ses_adm_id'];
			$item['mod_datetime'] = date('Y-m-d H:i:s');

			$updated = CMS::$db->mod('menu#'.(int)$id, $item);

			// saving translates
			foreach ($translates as $lang=>$tr_data) {
				foreach ($tr_data as $fieldname=>$text) {
					tr::store([
						'ref_table' => 'menu',
						'ref_id' => $id,
						'lang' => $lang,
						'fieldname' => $fieldname,
						'text' => $text,
					]);
				}
			}

			// saving positions
			if (empty($old_data['parent_id'])) {
				$old_positions = CMS::$db->getList("SELECT id FROM nav_positions WHERE position IN ('".implode("', '", $old_data['positions'])."')");
				if (empty($old_positions)) {$old_positions = [];}
				$del = array_diff($old_positions, $positions);
				$ins = array_diff($positions, $old_positions);
				foreach ($del as $navpos_id) {
					CMS::$db->run("DELETE FROM menu_navpos_rel WHERE item_id=:item_id AND navpos_id=:navpos_id", [
						':item_id' => $id,
						':navpos_id' => $navpos_id
					]);
				}
				foreach ($ins as $navpos_id) {
					CMS::$db->add('menu_navpos_rel', [
						'item_id' => $id,
						'navpos_id' => $navpos_id
					]);
				}
			}

			// log event
			CMS::log([
				'subj_table' => 'menu',
				'subj_id' => $id,
				'action' => 'edit',
				'descr' => 'Menu item modified by admin '.ADMIN_INFO,
			]);

			$response['success'] = true;
			$response['message'] = 'update_suc';
		}

		return $response;
	}

	public static function isSefExists($sef, $exclude=0) { // 2016-05-11
		$sef = (string)$sef;
		if (empty($sef)) {return false;}

		$sql = "SELECT id FROM menu WHERE sef=:sef".(empty($exclude)? '': " AND id!=:exclude")." LIMIT 1";
		$params = [
			':sef' => $sef
		];
		if (!empty($exclude)) {
			$params[':exclude'] = $exclude;
		}

		return CMS::$db->get($sql, $params);
	}

	public static function clearDeletedSef($sef) { // 2017-10-08
		$sef = (string)$sef;
		if (empty($sef)) {return false;}

		$sql = "DELETE FROM menu WHERE sef=:sef AND is_deleted='1'";
		$params = [
			':sef' => $sef
		];

		return CMS::$db->exec($sql, $params);
	}

	public static function isArticleNavItemExists($article_id, $exclude=0) { // 2016-05-12
		$article_id = (int)$article_id;
		$exclude = (int)$exclude;

		$sql = "SELECT id FROM menu WHERE ref_table=:ref_table AND ref_id=:ref_id".(empty($exclude)? '': " AND id!=:exclude")." LIMIT 1";

		$params = [
			':ref_table' => 'articles',
			':ref_id' => $article_id
		];
		if (!empty($exclude)) {
			$params[':exclude'] = $exclude;
		}

		return CMS::$db->get($sql, $params);
	}

	public static function deleteNavItem($id) { // 2016-05-11
		$deleted = CMS::$db->mod('menu#'.(int)$id, [
			'is_deleted' => '1',
		]);

		if ($deleted) {
			CMS::log([
				'subj_table' => 'menu',
				'subj_id' => $id,
				'action' => 'delete',
				'descr' => 'Menu item moved to recycle bin by admin '.ADMIN_INFO,
			]);
		}

		return $deleted;
	}

	public static function setNavItemPosition($id, $position) { // 2016-05-12
		$position = (int)$position;
		$parent_id = CMS::$db->get("SELECT parent_id FROM menu WHERE id=:item_id LIMIT 1", [
			':item_id' => $id,
		]);
		if ($parent_id===false) {return false;}
		$neigbors = CMS::$db->getList("SELECT id FROM menu WHERE id!=:item_id AND parent_id=:parent_id ORDER BY ordering ASC", [
			':item_id' => $id,
			':parent_id' => $parent_id,
		]);
		if (empty($neigbors)) {$neigbors = [];}
		array_splice($neigbors, $position, 0, $id);
		foreach ($neigbors as $ordering=>$item_id) {
			CMS::$db->mod('menu#'.$item_id, [
				'ordering' => $ordering
			]);
		}
		return true;
	}

	public static function setNavItemParent($id, $parent) { // 2016-05-12
		$parent = (int)$parent;
		return CMS::$db->mod('menu#'.$id, [
			'parent_id' => $parent
		]);
	}

	public static function getCats($parent=false) { // 2016-05-13
		$cats = [];

		$sql = "SELECT n.*, tr.text AS name
			FROM menu n
				LEFT JOIN translates tr ON tr.ref_table='menu' AND tr.ref_id=n.id AND tr.lang=:default_site_lang AND tr.fieldname='name'
			WHERE is_deleted='0'".(empty($parent)? " AND parent_id='0'": (" AND parent_id='".(int)$parent."'"))."
			ORDER BY ordering ASC";
		$menu = CMS::$db->getAll($sql, [
			':default_site_lang' => CMS::$default_site_lang
		]);

		if (!empty($menu) && is_array($menu)) foreach ($menu as $i=>$item) {
			if ($item['type']=='category') {$cats[] = $item;}
			$subcats = self::getCats($item['id']);
			if (!empty($subcats) && is_array($subcats)) {
				//$cats = array_merge($cats, $subcats);
				foreach ($subcats as $j=>$sub) {
					$sub['parent'] = $item;
					$cats[] = $sub;
				}
			}
		}

		if ($parent==false) {
			$cats = utils::arraySortByCol($cats, 'name');
		}

		return $cats;
	}

	/*public static function getCats() { // 2016-05-13
		$sql = "SELECT n.*, tr.text AS name
			FROM menu n
				LEFT JOIN translates tr ON tr.ref_table='menu' AND tr.ref_id=n.id AND tr.lang=:default_site_lang AND tr.fieldname='name'
			WHERE n.type='category' AND n.is_deleted='0'
			ORDER BY tr.text ASC";
		$params = [
			':default_site_lang' => CMS::$default_site_lang
		];
		return CMS::$db->getAll($sql, $params);
	}*/

	public static function getEditorAllowedCats($editor_id) { // 2016-05-26
		$sql = "SELECT m.id
			FROM cms_users_menu_sections_rel uml
				JOIN menu m ON m.id=uml.menu_section_id
			WHERE uml.cms_user_id=:id AND m.type='category'";
		$params = [
			':id' => $editor_id
		];
		return CMS::$db->getList($sql, $params);
	}

	public static function getSections() { // 2016-05-25
		$sql = "SELECT n.*, tr.text AS name
			FROM menu n
				LEFT JOIN translates tr ON tr.ref_table='menu' AND tr.ref_id=n.id AND tr.lang=:default_site_lang AND tr.fieldname='name'
			WHERE n.type IN ('category', 'spec') AND is_section='1' AND n.is_deleted='0'
			ORDER BY tr.text ASC";
		$params = [
			':default_site_lang' => CMS::$default_site_lang
		];
		return CMS::$db->getAll($sql, $params);
	}
}

?>