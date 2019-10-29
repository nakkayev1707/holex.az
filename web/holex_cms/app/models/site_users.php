<?php

namespace app\models;

use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}

class site_users {
	public static $curr_pg = 1;
	public static $pp = 20;
	public static $pages_amount = 0;
	public static $items_amount = 0;

	public static $users_tbl = 'site_users';

	public static function getUsersList() { // 2016-06-09
		$list = [];

		$where = [];
		if (!empty($_GET['q'])) {
			//$where[] = "first_name LIKE '%".utils::makeSearchable($_GET['q'])."%' OR last_name LIKE '%".utils::makeSearchable($_GET['q'])."%'";
			$q = utils::makeSearchable((string)$_GET['q']);
			$qXploded = explode(' ', $q);
			$byName = '';
			if (is_array($qXploded) && count($qXploded)) foreach ($qXploded as $w) {
				$w = CMS::$db->quote('%'.$w.'%');
				$byName.=(empty($byName)? '': ' AND ')."(
					first_name LIKE {$w} OR
					last_name LIKE {$w}
				)";
			}
			$q = CMS::$db->quote('%'.$q.'%');
			$where[] = "(
				email LIKE {$q}".(empty($byName)? '': (' OR '.$byName))."
			)";
		}
		if (in_array(@$_GET['filter']['is_blocked'], ['0', '1'])) {
			$where[] = "is_blocked=".CMS::$db->escape($_GET['filter']['is_blocked']);
		}
		if (!empty($_GET['filter']['provider'])) {
			if ($_GET['filter']['provider']=='none') {
				$where[] = "provider IS NULL";
			} else {
				$where[] = "provider=".CMS::$db->escape($_GET['filter']['provider']);
			}
		}
		if (utils::valid_date(@(string)@$_GET['filter']['reg_since'])) {
			$where[] = "registration_datetime>=".CMS::$db->escape(utils::changeDateFormat('d.m.Y', 'Y-m-d', $_GET['filter']['reg_since']));
		}
		if (utils::valid_date(@(string)@$_GET['filter']['reg_till'])) {
			$where[] = "DATE(registration_datetime)<=".CMS::$db->escape(utils::changeDateFormat('d.m.Y', 'Y-m-d', $_GET['filter']['reg_till']));
		}

		$c = CMS::$db->select('COUNT(id)', self::$users_tbl, $where);
		self::$items_amount = $c;
		// print "<pre>RESULT:\n{$c}\n\nQUERIES:\n".var_export(CMS::$db->queries, 1)."\n\nERRORS:\n".var_export(CMS::$db->errors, 1)."\n</pre>";
		$pages_amount = ceil($c/self::$pp);

		if ($pages_amount>0) {
			self::$pages_amount = $pages_amount;
			self::$curr_pg = ((self::$curr_pg>self::$pages_amount)? self::$pages_amount: self::$curr_pg);
			$start_from = (self::$curr_pg-1)*self::$pp;

			$list = CMS::$db->selectAll('*', self::$users_tbl, $where, 'id DESC', $start_from, self::$pp);
			//print "<pre>RESULT:\n".var_export($list, 1)."\n\nQUERIES:\n".var_export(CMS::$db->queries, 1)."\n\nERRORS:\n".var_export(CMS::$db->errors, 1)."\n</pre>";
		}

		return $list;
	}

	public static function getLastRegistered() { // 2016-08-21
		$list = [];

		$sql = "SELECT * FROM `".self::$users_tbl."` ORDER BY id DESC LIMIT 8";
		$list = CMS::$db->getAll($sql);

		return $list;
	}

	public static function countUsers() { // 2016-12-04
		return CMS::$db->get("SELECT COUNT(id) FROM `".self::$users_tbl."`");
	}

	public static function getCountNewComers() { // 2016-08-21
		return CMS::$db->get("SELECT COUNT(id) FROM `".self::$users_tbl."` WHERE registration_datetime>='".date('Y-m-d', mktime(0, 0, 0, date('n')-1))."'");
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
				'descr' => 'Site user '.(($status=='on')? 'un': '').'blocked by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO,
			]);
		}

		return $updated;
	}
	
	public static function deleteUser($user_id) { // 2016-06-09
		$user_id = (int)$user_id;

		$deleted = CMS::$db->exec('DELETE FROM `'.self::$users_tbl.'` WHERE `id`=:id', [':id' => $user_id]);

		if ($deleted) {
			CMS::$db->exec('DELETE FROM `comments` WHERE `user_id`=:id', [':id' => $user_id]);
			CMS::$db->exec('OPTIMIZE TABLE `'.self::$users_tbl.'`, `comments`');

			CMS::log([
				'subj_table' => self::$users_tbl,
				'subj_id' => $user_id,
				'action' => 'erase',
				'descr' => 'Site user erased by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO,
			]);
		}

		return $deleted;
	}

	public static function getProvidersAvailable() { // 2016-06-10
		return CMS::$db->getList('SELECT DISTINCT provider FROM `'.self::$users_tbl.'` ORDER BY provider');
	}

	public static function getUser($user_id) { // 2016-06-10
		return CMS::$db->getRow('SELECT * FROM `'.self::$users_tbl.'` WHERE id=:id LIMIT 1', [':id' => $user_id]);
	}

	public static function countUserComments($user_id) { // 2016-06-13
		return CMS::$db->get('SELECT COUNT(id) FROM comments WHERE user_id=:id', [':id' => $user_id]);
	}
}

?>