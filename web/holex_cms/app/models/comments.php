<?php

namespace app\models;

use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}

class comments {
	public static $curr_pg = 1;
	public static $pp = 20;
	public static $pages_amount = 0;
	public static $items_amount = 0;

	public static $tbl = 'comments';

	public static function getCommentsList() { // 2016-12-04
		$list = [];

		$joins = [];
		$joins['u'] = "JOIN site_users u ON u.id=c.user_id";
		$filter = [];
		$filter[] = "c.is_deleted='0'";
		if (!empty($_GET['q'])) {
			$filter[] = "c.text LIKE '%".utils::makeSearchable($_GET['q'])."%'";
		}
		if (in_array(@$_GET['filter']['is_published'], ['0', '1'])) {
			$filter[] = "c.is_published=".CMS::$db->escape($_GET['filter']['is_published']);
		}
		if (in_array(@$_GET['filter']['is_inspected'], ['0', '1'])) {
			$filter[] = "c.is_inspected=".CMS::$db->escape($_GET['filter']['is_inspected']);
		}
		if (!empty($_GET['filter']['user_id'])) {
			$filter[] = "c.user_id=".CMS::$db->escape($_GET['filter']['user_id']);
		}
		if (!empty($_GET['filter']['ref_table']) && !empty($_GET['filter']['ref_id'])) {
			$filter[] = "c.ref_table=".CMS::$db->escape($_GET['filter']['ref_table']);
			$filter[] = "c.ref_id=".CMS::$db->escape($_GET['filter']['ref_id']);
		}
		if (utils::valid_date(@(string)$_GET['filter']['add_since'])) {
			$filter[] = "c.add_datetime>=".CMS::$db->escape(utils::changeDateFormat('d.m.Y', 'Y-m-d', $_GET['filter']['add_since']));
		}
		if (utils::valid_date(@(string)$_GET['filter']['add_till'])) {
			$filter[] = "DATE(c.add_datetime)<=".CMS::$db->escape(utils::changeDateFormat('d.m.Y', 'Y-m-d', $_GET['filter']['add_till']));
		}
		$where = (empty($filter)? '': ('WHERE '.implode(" AND ", $filter)));

		$c = CMS::$db->get('SELECT COUNT(c.id)
			FROM '.self::$tbl.' c
				'.implode("\n", $joins).'
			'.$where);
		self::$items_amount = $c;
		// print "<pre>RESULT:\n{$c}\n\nQUERIES:\n".var_export(CMS::$db->queries, 1)."\n\nERRORS:\n".var_export(CMS::$db->errors, 1)."\n</pre>";
		$pages_amount = ceil($c/self::$pp);

		if ($pages_amount>0) {
			self::$pages_amount = $pages_amount;
			self::$curr_pg = ((self::$curr_pg>self::$pages_amount)? self::$pages_amount: self::$curr_pg);
			$start_from = (self::$curr_pg-1)*self::$pp;

			$list = CMS::$db->getAll('SELECT c.*, u.id AS user_id, u.first_name, u.last_name
			FROM '.self::$tbl.' c
				'.implode("\n", $joins).'
			'.$where.'
			ORDER BY c.is_inspected ASC, c.id DESC
			LIMIT '.(($start_from>0)? ($start_from.', '): '').self::$pp);
			//print "<pre>RESULT:\n".var_export($list, 1)."\n\nQUERIES:\n".var_export(CMS::$db->queries, 1)."\n\nERRORS:\n".var_export(CMS::$db->errors, 1)."\n</pre>";
		}

		return $list;
	}

	public static function setCommentStatus($id, $status) { // 2016-12-04
		$updated = CMS::$db->mod(self::$tbl.'#'.(int)$id, [
			'is_published' => (($status=='on')? '1': '0')
		]);

		if ($updated) {
			CMS::log([
				'subj_table' => self::$tbl,
				'subj_id' => (int)$id,
				'action' => 'edit',
				'descr' => 'Comment is '.(($status=='on')? '': 'un').'published by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO,
			]);
		}

		return $updated;
	}

	public static function deleteComment($comment_id) { // 2016-12-04
		$deleted = CMS::$db->mod(self::$tbl.'#'.(int)$comment_id, [
			'is_deleted' => '1',
		]);

		if ($deleted) {
			CMS::log([
				'subj_table' => self::$tbl,
				'subj_id' => $comment_id,
				'action' => 'delete',
				'descr' => 'Comment moved to recycle bin by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO,
			]);
		}

		return $deleted;
	}

	public static function eraseComment($comment_id) { // 2016-12-04
		$comment_id = (int)$comment_id;

		$deleted = CMS::$db->exec('DELETE FROM `'.self::$tbl.'` WHERE `id`=:id', [':id' => $comment_id]);

		if ($deleted) {
			CMS::$db->exec('OPTIMIZE TABLE `'.self::$tbl.'`');

			CMS::log([
				'subj_table' => self::$tbl,
				'subj_id' => $comment_id,
				'action' => 'erase',
				'descr' => 'Comment erased by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO,
			]);
		}

		return $deleted;
	}

	public static function getComment($comment_id) { // 2016-12-04
		return CMS::$db->getRow("SELECT * FROM `".self::$tbl."` WHERE id=:id AND is_deleted='0' LIMIT 1", [':id' => $comment_id]);
	}

	public static function editComment($comment_id) { // 2016-06-15
		$response = ['success' => false, 'message' => 'update_err'];

		$comment = self::getComment($comment_id);
		if (empty($comment['id'])) {
			$response['message'] = 'comments_err_not_found';
			return $response;
		}

		$upd = [];

		$upd['text'] = @(string)@$_POST['text'];
		if (isset($_POST['is_published'])) {
			$upd['is_published'] = ($_POST['is_published']? '1': '0');
		}

		if (empty($response['errors'])) {
			//$upd['mod_by'] = $_SESSION[CMS::$sess_hash]['ses_adm_id'];
			//$upd['mod_datetime'] = date('Y-m-d H:i:s');

			$updated = CMS::$db->mod(self::$tbl.'#'.(int)$comment_id, $upd);

			if ($updated) {
				CMS::log([
					'subj_table' => self::$tbl,
					'subj_id' => $comment_id,
					'action' => 'edit',
					'descr' => 'Comment modified by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO,
				]);
			}

			$response['success'] = true;
			$response['message'] = 'update_suc';
		}

		return $response;
	}

	public static function touchComment($comment_id) { // 2016-06-16
		$updated = CMS::$db->mod(self::$tbl.'#'.(int)$comment_id, ['is_inspected' => '1']);

		if ($updated) {
			CMS::log([
				'subj_table' => self::$tbl,
				'subj_id' => $comment_id,
				'action' => 'view',
				'descr' => 'Comment inspected by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO
			]);
		}

		return $updated;
	}

	public static function countComments() { // 2016-12-04
		return CMS::$db->get("SELECT COUNT(c.id)
			FROM `".self::$tbl."` c
				JOIN `site_users` u ON u.id=c.user_id
			WHERE c.is_deleted='0'");
	}

	public static function countUnreadComments() { // 2017-01-04
		return CMS::$db->get("SELECT COUNT(c.id)
			FROM `".self::$tbl."` c
				JOIN `site_users` u ON u.id=c.user_id
			WHERE c.is_inspected='0' AND c.is_deleted='0'");
	}
}

?>