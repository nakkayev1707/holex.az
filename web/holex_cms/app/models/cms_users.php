<?php

namespace app\models;

use abeautifulsite\simple_image\SimpleImage;
use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\security;
use profit_az\profit_cms\helpers\utils;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}

class cms_users {
	public static $curr_pg = 1;
	public static $pp = 10;
	public static $pages_amount = 0;
	public static $items_amount = 0;

	public static $users_tbl = 'cms_users';
	public static $allowed_avatar_ext = ['jpg', 'jpeg', 'jpe', 'png'];
	public static $avatar_size = ['width' => 256, 'height' => 256];

	const AVATAR_UPL_DIR = 'avatars/cms_users/';

	public static function getUsersList() {
		$list = [];

		$where = [];
		if (!empty($_GET['q'])) {
			$where[] = "name LIKE '%".utils::makeSearchable($_GET['q'])."%'";
		}
		if (in_array(@$_GET['filter']['role'], array_keys(CMS::$roles))) {
			$where[] = "role=".CMS::$db->escape($_GET['filter']['role']);
		}
		if (in_array(@$_GET['filter']['is_blocked'], ['0', '1'])) {
			$where[] = "is_blocked=".CMS::$db->escape($_GET['filter']['is_blocked']);
		}

		$c = CMS::$db->select('COUNT(id)', self::$users_tbl, $where);
		self::$items_amount = $c;
		//print "<pre>RESULT:\n{$c}\n\nQUERIES:\n".var_export(CMS::$db->queries, 1)."\n\nERRORS:\n".var_export(CMS::$db->errors, 1)."\n</pre>";
		$pages_amount = ceil($c/self::$pp);

		if ($pages_amount>0) {
			self::$pages_amount = $pages_amount;
			self::$curr_pg = ((self::$curr_pg>self::$pages_amount)? self::$pages_amount: self::$curr_pg);
			$start_from = (self::$curr_pg-1)*self::$pp;

			$list = CMS::$db->selectAll('*', self::$users_tbl, $where, 'login', $start_from, self::$pp);
			//print "<pre>RESULT:\n".var_export($list, 1)."\n\nQUERIES:\n".var_export(CMS::$db->queries, 1)."\n\nERRORS:\n".var_export(CMS::$db->errors, 1)."\n</pre>";
		}

		return $list;
	}

	public static function addUserValidate() { // 2016-09-13
		$response = ['success' => false, 'message' => 'undefined', 'errors' => []];

		$user = [];

		if (empty($_POST['login'])) {
			$response['errors'][] = 'cms_user_empty_login_err';
		} else if (!utils::validEmail($_POST['login'])) {
			$response['errors'][] = 'cms_user_edit_login_invalid_err';
		} else if (self::isDuplicateLogin($_POST['login'])) {
			$response['errors'][] = 'cms_user_duplicate_login_err';
		} else {
			$user['login'] = $_POST['login'];
		}

		if (!utils::checkPass($_POST['pwd'])) {
			$response['errors'][] = 'cms_user_pwd_err';
		} else {
			$user['password'] = security::generatePasswordHash($_POST['pwd'], CMS::$salt);
		}

		if (!in_array(@$_POST['role'], array_keys(CMS::$roles))) {
			$response['errors'][] = 'cms_user_role_err';
		} else {
			$user['role'] = $_POST['role'];
		}

		$name = trim(@(string)$_POST['name']);
		if (empty($name)) {
			$response['errors'][] = 'cms_user_name_err';
		} else {
			$user['name'] = $name;
		}

		$allowed_langs = CMS::$db->getList("SELECT `language_dir` FROM `cms_languages`");
		if (!in_array(@$_POST['lang'], $allowed_langs)) {
			$response['errors'][] = 'cms_user_lang_err';
		} else {
			$user['lang'] = $_POST['lang'];
		}

		if (!empty($_FILES['avatar']['name'])) {
			if (empty($_FILES['avatar']['error'])) {
				$user['avatar'] = utils::upload($_FILES['avatar']['name'], $_FILES['avatar']['tmp_name'], UPLOADS_DIR.self::AVATAR_UPL_DIR, self::$allowed_avatar_ext);
				if (empty($user['avatar'])) {
					$response['errors'][] = 'upl_invalid_image_extension_err';
				} else {
					$img = new SimpleImage(UPLOADS_DIR.self::AVATAR_UPL_DIR.$user['avatar']);
					$img->thumbnail(self::$avatar_size['width'], self::$avatar_size['height'])->save();
				}
			} else {
				$response['errors'][] = CMS::$upload_err[$_FILES['img']['error']];
			}
		}

		if (empty($response['errors'])) {
			$_SESSION['approvable_new_user'] = $user;
			$response['success'] = true;
			$response['message'] = 'validation_successful';
		}

		return $response;
	}

	public static function addUserApprove() { // 2016-09-13
		$response = ['success' => false, 'message' => 'insert_err', 'errors' => []];

		if (empty($_SESSION['approvable_new_user'])) {
			$response['message'] = 'cms_user_edit_approvable_data_lost_err';
			return $response;
		} else {
			$user = $_SESSION['approvable_new_user'];
			unset($_SESSION['approvable_new_user']);
		}

		if (empty($response['errors'])) {
			$user['reg_by'] = $_SESSION[CMS::$sess_hash]['ses_adm_id'];
			$user['reg_date'] = date('Y-m-d H:i:s');

			$user_id = CMS::$db->add(self::$users_tbl, $user);

			if ($user_id) {
				CMS::log([
					'subj_table' => self::$users_tbl,
					'subj_id' => $user_id,
					'action' => 'add',
					'descr' => 'User '.$user['name'].' added by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO,
				]);

				$response['success'] = true;
				$response['message'] = 'insert_suc';
			}
		}

		return $response;
	}

	public static function getUser($id) {
		return CMS::$db->selectRow('*', self::$users_tbl, ("id='".intval($id)."'"), '', '', 1);
	}

	public static function getUserByLogin($login) { // 2016-08-14
		return CMS::$db->getRow("SELECT * FROM `".self::$users_tbl."` WHERE login=:login LIMIT 1", [':login' => $login]);
	}

	public static function validateUserData($id) { // 2017-01-28
		$response = ['success' => false, 'message' => 'update_err'];

		$user = self::getUser($id);
		if (empty($user['id'])) {
			$response['message'] = 'cms_user_edit_err_not_found';
			return $response;
		}

		$upd = [];
		$dangerous_action = false;

		if (!in_array(@$_POST['role'], array_keys(CMS::$roles))) {
			$response['errors'][] = 'cms_user_role_err';
		} else {
			$upd['role'] = $_POST['role'];

			if ($upd['role']!=$user['role']) {
				$dangerous_action = true;
			}
		}

		$name = trim(@(string)$_POST['name']);
		if (empty($name)) {
			$response['errors'][] = 'cms_user_name_err';
		} else {
			$upd['name'] = $name;
		}

		$allowed_langs = CMS::$db->getList("SELECT `language_dir` FROM `cms_languages`");
		if (!in_array(@$_POST['lang'], $allowed_langs)) {
			$response['errors'][] = 'cms_user_lang_err';
		} else {
			$upd['lang'] = $_POST['lang'];
		}

		if (!empty($_POST['pwd'])) {
			$dangerous_action = true;

			if (!utils::checkPass($_POST['pwd'])) {
				$response['errors'][] = 'cms_user_pwd_err';
			} else {
				$upd['password'] = security::generatePasswordHash($_POST['pwd'], CMS::$salt);
			}
		}

		if (!empty($_FILES['avatar']['name'])) {
			if (empty($_FILES['avatar']['error'])) {
				$upd['avatar'] = utils::upload($_FILES['avatar']['name'], $_FILES['avatar']['tmp_name'], UPLOADS_DIR.self::AVATAR_UPL_DIR, self::$allowed_avatar_ext);
				if (empty($upd['avatar'])) {
					$response['errors'][] = 'upl_invalid_image_extension_err';
				} else {
					$img = new SimpleImage(UPLOADS_DIR.self::AVATAR_UPL_DIR.$upd['avatar']);
					$img->thumbnail(self::$avatar_size['width'], self::$avatar_size['height'])->save();
				}
			} else {
				$response['errors'][] = CMS::$upload_err[$_FILES['img']['error']];
			}
		}

		if (empty($response['errors'])) {
			/*if ($dangerous_action) {
				$_SESSION['approvable_user_modifications'] = $upd;
			}*/
			$response['success'] = true;
			$response['message'] = 'validation_successful';
			$response['data']['validated'] = $upd;
			$response['data']['is_approve_required'] = $dangerous_action;
		}

		return $response;
	}

	public static function saveUserData($id, $data) { // 2016-11-15
		$response = ['success' => false, 'message' => 'update_err'];

		if (empty($data)) {
			$response['message'] = 'cms_user_edit_approvable_data_lost_err';
			return $response;
		}

		if (empty($response['errors'])) {
			$updated = CMS::$db->mod(self::$users_tbl.'#'.$id, $data);

			if ($id) {
				CMS::log([
					'subj_table' => self::$users_tbl,
					'subj_id' => $id,
					'action' => 'edit',
					'descr' => 'User '.$data['name'].' modified by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO,
				]);

				$response['success'] = true;
				$response['message'] = 'update_suc';

				if (($data['lang']!=$_SESSION[CMS::$sess_hash]['ses_adm_lang']) && ($_SESSION[CMS::$sess_hash]['ses_adm_id']==$id)) {
					CMS::$lang = include LANG_DIR.$data['lang'].'.php';
					$_SESSION[CMS::$sess_hash]['ses_adm_lang'] = $data['lang'];
				}
			}
		}

		return $response;
	}

	public static function editUser($id) { // 2016-05-24 // deprecated, denied for using, to be deleted
		$response = [
			'success' => false,
			'message' => '',
			'data' => [],
			'errors' => []
		];

		$user = self::getUser($id);

		if (empty($user['id'])) {
			$message = 'cms_user_not_found';
			return $response;
		}

		$response['data'] = $user;
		unset($response['data']['password']);

		if (isset($_POST['save']) || isset($_POST['apply'])) {
			$upd = [
				'name' => $user['name'],
				'lang' => $user['lang'],
				'is_blocked' => $user['is_blocked']
			];

			$name = trim(@$_POST['name'.$_SESSION[CMS::$sess_hash]['autofill_fix']]);
			if (preg_match('/^[a-zа-яА-ЯA-ZüöğıəçşёÜÖĞİƏÇŞЁ\-\`\\\'\s]{2,255}$/u', $name)) {
				$upd['name'] = $name;
			} else {
				$response['errors']['name'] = 'cms_user_name_err';
			}
			$response['data']['name'] = utils::strClear(@$_POST['name'.$_SESSION[CMS::$sess_hash]['autofill_fix']], 1);

			if (in_array(@$_POST['lang'.$_SESSION[CMS::$sess_hash]['autofill_fix']], ['az', 'ru'])) {
				$upd['lang'] = $_POST['lang'.$_SESSION[CMS::$sess_hash]['autofill_fix']];
			} else {
				$response['errors']['lang'] = 'cms_user_lang_err';
			}
			$response['data']['lang'] = utils::strClear($_POST['lang'.$_SESSION[CMS::$sess_hash]['autofill_fix']], 1);

			if (!empty($_POST['pwd'.$_SESSION[CMS::$sess_hash]['autofill_fix']])) {
				if (!utils::checkPass($_POST['pwd'.$_SESSION[CMS::$sess_hash]['autofill_fix']])) {
					$response['errors'][] = 'cms_user_pwd_err';
				} else if ($_POST['pwd'.$_SESSION[CMS::$sess_hash]['autofill_fix']]!=$_POST['pwd_repeat'.$_SESSION[CMS::$sess_hash]['autofill_fix']]) {
					$response['errors'][] = 'cms_user_pwd_not_equal_err';
				} else {
					$admin_pwd = CMS::$db->get("SELECT password FROM ".self::$users_tbl." WHERE login=".CMS::$db->escape($_SESSION[CMS::$sess_hash]['ses_adm_login'])." LIMIT 1");
					if (!security::validatePassword($admin_pwd, $_POST['pwd_approve'.$_SESSION[CMS::$sess_hash]['autofill_fix']], CMS::$salt)) {
						$_SESSION[CMS::$sess_hash]['security_violation_attempts'] = (empty($_SESSION[CMS::$sess_hash]['security_violation_attempts'])? 1: ($_SESSION[CMS::$sess_hash]['security_violation_attempts']+1));
						if ($_SESSION[CMS::$sess_hash]['security_violation_attempts']>=3) {
							utils::redirect('?page=close&direct_output=1');
						}
						$response['errors'][] = sprintf(CMS::t('cms_user_pwd_approve_err'), (3-$_SESSION[CMS::$sess_hash]['security_violation_attempts']));
					} else {
						$upd['password'] = security::generatePasswordHash($_POST['pwd'.$_SESSION[CMS::$sess_hash]['autofill_fix']], CMS::$salt);
					}
				}
			}

			if ($user['id']=='1') {
				$upd['role'] = 'admin';
			} else {
				if (!in_array(@$_POST['role'], array_keys(CMS::$roles))) {
					$response['errors'][] = 'cms_user_role_err';
				} else {
					$upd['role'] = $_POST['role'];
				}
				// Security note! Checking of user password if upgrading user role must be implemented!
			}

			//$upd['is_blocked'] = (empty($_POST['is_blocked'])? '0': '1');
			//$response['data']['is_blocked'] = $upd['is_blocked'];

			if (empty($response['errors'])) {
				$updated = CMS::$db->mod(self::$users_tbl.'#'.$user['id'], $upd);

				if ($updated) {
					CMS::log([
						'subj_table' => self::$users_tbl,
						'subj_id' => $user['id'],
						'action' => 'edit',
						'descr' => 'User '.$user['name'].' modified by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO,
					]);
				}

				$response['success'] = true;
				$response['message'] = 'update_suc';

				if ($upd['lang']!=$_SESSION[CMS::$sess_hash]['ses_adm_lang']) {
					CMS::$lang = include LANG_DIR.$upd['lang'].'.php';
					$_SESSION[CMS::$sess_hash]['ses_adm_lang'] = $upd['lang'];
				}
			}
		}

		return $response;
	}

	private static function isDuplicateLogin($login) {
		return CMS::$db->getRow('SELECT `id` FROM '.self::$users_tbl.' WHERE `login`='.CMS::$db->quote($login));
	}

	public static function setUserStatus($id, $status) { // 2016-11-16
		$updated = CMS::$db->mod(self::$users_tbl.'#'.(int)$id, [
			'is_blocked' => (($status=='on')? '0': '1')
		]);

		if ($updated) {
			CMS::log([
				'subj_table' => self::$users_tbl,
				'subj_id' => (int)$id,
				'action' => 'edit',
				'descr' => 'User '.(($status=='on')? 'un': '').'blocked by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO,
			]);
		}

		return $updated;
	}

	public static function deleteUser($id) {
		if ($id==1) {return false;}

		$deleted = CMS::$db->exec('DELETE FROM `cms_users` WHERE `id`=:id', [':id' => $id]);

		if ($deleted) {
			CMS::$db->exec('DELETE FROM `cms_users_menu_sections_rel` WHERE `cms_user_id`=:id', [':id' => $id]);

			CMS::log([
				'subj_table' => self::$users_tbl,
				'subj_id' => (int)$id,
				'action' => 'erase',
				'descr' => 'User erased by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO,
			]);
		}

		return $deleted;
	}

	public static function getAllowedSections($user_id) { // 2016-05-25
		$sql = "SELECT menu_section_id FROM cms_users_menu_sections_rel WHERE cms_user_id=:user_id";
		$params = [
			':user_id' => $user_id
		];
		return CMS::$db->getList($sql, $params);
	}

	public static function saveAllowedSections($user_id, $sections) { // 2016-05-25
		$response = ['success' => false, 'message' => 'update_err'];

		$old_sections = self::getAllowedSections($user_id);
		if (!$old_sections) {$old_sections = [];}
		if (empty($sections) || !is_array($sections)) {$sections = [];}

		$del = array_diff($old_sections, $sections);
		$ins = array_diff($sections, $old_sections);

		foreach ($del as $s) {
			CMS::$db->run("DELETE FROM cms_users_menu_sections_rel WHERE cms_user_id=:user_id AND menu_section_id=:section_id", [
				':user_id' => $user_id,
				':section_id' => $s
			]);
		}
		foreach ($ins as $s) {
			CMS::$db->add('cms_users_menu_sections_rel', [
				'cms_user_id' => $user_id,
				'menu_section_id' => $s,
			]);
		}

		if ($del || $ins) {
			CMS::log([
				'subj_table' => self::$users_tbl,
				'subj_id' => $user_id,
				'action' => 'sections_reassign',
				'descr' => 'User`s allowed sections reassigned by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO,
			]);
		}

		$response['success'] = true;
		$response['message'] = 'update_suc';

		return $response;
	}

	public static function saveUserPrivilegies($user_id, $privilegies) {
		$response = ['success' => false, 'message' => 'update_err'];

		//print "<pre>".var_export($privilegies, 1)."</pre>";
		/*array (
			'articles' => '2',
			'add_article' => '2',
			'edit_article' => '2',
			'list_gallery_folder' => '1',
			'add_gallery_folder' => '2',
			'edit_gallery_folder' => '0',
			'list_gallery' => '1',
			'add_gallery' => '1',
			'edit_gallery_photo' => '1',
		)*/
		if (empty($privilegies)) {return $response;}

		$user = self::getUser($user_id);
		if (empty($user['id'])) {return $response;}

		if (!in_array('0', $privilegies) && !in_array('1', $privilegies)) {
			// no restrictions, clear this user's records
			CMS::$db->run("DELETE FROM cms_users_privilegies WHERE cms_user_id=:uid", [':uid' => $user_id]);
			$response = ['success' => true, 'message' => 'update_suc'];
		} else {
			foreach ($privilegies as $page=>$level) {
				if ($level=='0') {
					CMS::$db->run("DELETE FROM cms_users_privilegies WHERE cms_user_id=:uid AND page=:page", [
						':uid' => $user_id,
						':page' => $page
					]);
				} else {
					$rec_id = CMS::$db->get("SELECT id FROM cms_users_privilegies WHERE cms_user_id=:uid AND page=:page LIMIT 1", [
						':uid' => $user_id,
						':page' => $page
					]);
					if (empty($rec_id)) {
						CMS::$db->add('cms_users_privilegies', [
							'cms_user_id' => $user_id,
							'page' => $page,
							'readonly' => (($level<2)? '1': '0')
						]);
					} else {
						CMS::$db->mod('cms_users_privilegies#'.$rec_id, [
							'readonly' => (($level<2)? '1': '0')
						]);
					}
				}
			}
			$response = ['success' => true, 'message' => 'update_suc'];
		}

		return $response;
	}

	public static function countUsers() { // 2016-01-04
		return CMS::$db->get("SELECT COUNT(id) FROM `".self::$users_tbl."`");
	}
}

?>