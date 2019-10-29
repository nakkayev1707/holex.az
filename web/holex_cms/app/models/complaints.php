<?php

namespace app\models;

use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}

class complaints {
	public static $curr_pg = 1;
	public static $pp = 50;
	public static $pages_amount = 0;
	public static $items_amount = 0;
	public static $allowed_ext = ['jpg', 'png', 'doc', 'docx', 'xls', 'xlsx', 'pdf'];

	public static function hasUserComplains($user_id) {
		if (empty($user_id)) {return false;} else {$user_id = intval($user_id);}

		return CMS::$db->get("SELECT id FROM complaints WHERE user_id='{$user_id}' LIMIT 1");
	}

	public static function getComplaints() {
		$list = [];

		$fields = "u.id AS `uid`, u.last_name AS surname, u.first_name AS name, '' AS patronymic, c.id, (ISNULL(c.admin_id) AND c.is_read=1) AS unread, c.user_id, c.admin_id, c.message, `c`.`date`, c.is_read";
		$joins = [];
		$joins['u'] = "JOIN site_users u ON u.id=c.user_id";
		$where = [];
		$where[] = "`c`.`date`=(SELECT MAX(`date`) FROM `complaints` c2 WHERE `c2`.`user_id`=`c`.`user_id` LIMIT 1)";
		$having = [];
		if (!empty($_GET['search_query'])) {
			$q = utils::makeSearchable((string)$_GET['search_query']);
			$qXploded = explode(' ', $q);
			$byName = '';
			if (is_array($qXploded) && count($qXploded)) foreach ($qXploded as $w) {
				$w = CMS::$db->quote('%'.$w.'%');
				$byName.=(empty($byName)? '': ' AND ')."(
					u.first_name LIKE {$w} OR
					u.last_name LIKE {$w}
				)";
			}
			$q = CMS::$db->quote('%'.$q.'%');
			$where[] = "(
				c.message LIKE {$q} OR
				u.email LIKE {$q}".(empty($byName)? '': (' OR
				'.$byName))."
			)";
		}
		if (in_array(@$_GET['filter']['status'], ['not_answered', 'answered'])) {
			$where[] = 'c.admin_id IS '.(($_GET['filter']['status']=='answered')? 'NOT ': '').'NULL';
		}
		$where = (empty($where)? '': ('WHERE '.implode(' AND ', $where)));
		$having = (empty($having)? '': ('HAVING '.implode(' AND ', $having)));

		$st = CMS::$db->run("SELECT {$fields}
			FROM complaints c
				".implode("\n", $joins)."
			{$where}
			GROUP BY c.user_id
			{$having}");
		$c = ($st? $st->rowCount(): 0);
		unset($st);
		// print "<pre>QUERIES:\n".var_export(CMS::$db->queries, 1)."\n\nERRORS:\n".var_export(CMS::$db->errors, 1)."\n\nRESULT:\n{$c}\n</pre>";
		self::$items_amount = $c;
		$pages_amount = ceil($c/self::$pp);

		if ($pages_amount>0) {
			self::$pages_amount = $pages_amount;
			self::$curr_pg = ((self::$curr_pg>self::$pages_amount)? self::$pages_amount: self::$curr_pg);
			$start_from = (self::$curr_pg-1)*self::$pp;

			$list = CMS::$db->getAll("SELECT {$fields}
				FROM complaints c
					".implode("\n", $joins)."
				{$where}
				GROUP BY c.user_id
				{$having}
				ORDER BY unread DESC, `c`.`date` DESC
				LIMIT ".(($start_from>0)? ($start_from.', '): '').self::$pp);
			// print "<pre>QUERIES:\n".var_export(CMS::$db->queries, 1)."\n\nERRORS:\n".var_export(CMS::$db->errors, 1)."\n\nRESULT:\n".var_export($list, 1)."\n</pre>";
		}

		return $list;
	}

	public static function getUserChat($user_id) {
		$s = '';
		if (!empty($_GET['search_query'])) {
			$q = utils::makeSearchable((string)$_GET['search_query']);
			$q = CMS::$db->quote('%'.$q.'%');
			$s = " AND (c.message LIKE {$q} OR c.filename LIKE {$q})";
		}
		$sql = "SELECT c.*, u.name
			FROM complaints c
				LEFT JOIN cms_users u ON u.id=c.admin_id
			WHERE c.user_id='".(int)$user_id."'{$s}
            ORDER BY c.id DESC";
		return CMS::$db->getAll($sql);
	}

	public static function answerUserComplaint($user_id) {
		$response = ['success' => false, 'message' => 'Unknown error', 'errors' => []];

		if (empty($user_id)) {
			$response['message'] = 'Empty user id';
			return $response;
		}
		$user_id = intval($user_id);
		$user = CMS::$db->getRow("SELECT * FROM `site_users` WHERE id='{$user_id}' LIMIT 1");
		if (empty($user['id'])) {
			$response['message'] = 'User data not found';
			return $response;
		}
		$last = self::getLastIncomingComplaintByUser($user_id);

		$answer = [];

		$answer['message'] = trim((string)@$_POST['message']);
		if (empty($answer['message'])) {
			$response['errors']['file'] = 'complaints_message_err';
		}

		if (empty($response['errors']) && !empty($_FILES['file']['size']) && empty($_FILES['file']['error'])) {
			$fname = utils::getuniqid().'.'.utils::getFileExt($_FILES['file']['name']);
			$fname = strtolower($fname);
			$fname = utils::upload($fname, $_FILES['file']['tmp_name'], UPLOADS_DIR.'complaints/', self::$allowed_ext);
			if ($fname) {
				$answer['tmp_name'] = $fname;
				$answer['filename'] = $_FILES['file']['name'];
			} else {
				$response['errors']['file'] = 'complaints_file_err';
			}
		}

		if (empty($response['errors'])) {
			$answer['user_id'] = $user_id;
			$answer['admin_id'] = $_SESSION[CMS::$sess_hash]['ses_adm_id'];
			$answer['date'] = date('Y-m-d H:i:s');

			$answer_id = CMS::$db->add('complaints', $answer);

			if ($answer_id) {
				$username = $user['last_name'].' '.$user['first_name'];

				// register log event
				CMS::log([
					'subj_table' => 'complaints',
					'subj_id' => $last['id'],
					'action' => 'answered_complaint',
					'descr' => 'User`s #'.$user_id.' '.$username.' complaint is answered by admin '.ADMIN_INFO
				]);

				/*if (!empty($user['email'])) {
					$recipient = [
						'username' => $username,
						'email' => $user['email']
					];

					$msg = CMS::t('complaints_answer_notification_email');
					$msg = strtr($msg, [
						'{username}' => $username,
						'{answer}' => $answer['message'],
						'{complaint}' => $last['message']
					]);

					$sended = CMS::sendEmail($recipient, [
						'subject' => CMS::t('complaints_answer_notification_subj'),
						'message' => $msg
					]);
				}*/

				/*if (!empty($user['phone'])) {
					$sended = CMS::sendSMS(CMS::t('complaints_answer_notification_sms'), $user['phone']);
				}*/

				$response['success'] = 'true';
				$response['message'] = 'insert_suc';
			} else {
				$response['message'] = 'insert_err';
			}
		}

		return $response;
	}

	public static function getLastIncomingComplaintByUser($user_id) {
		$sql = "SELECT * FROM complaints WHERE user_id='".(int)$user_id."' AND admin_id IS NULL ORDER BY date DESC LIMIT 1";
		return CMS::$db->getRow($sql);
	}

	public static function downloadComplaintFile($complaint_id) {
		if (!empty($complaint_id)) {
			$complaint_id = intval($complaint_id);
			$complaint = CMS::$db->getRow("SELECT * FROM complaints WHERE id='{$complaint_id}' LIMIT 1");
			if (!empty($complaint['tmp_name'])) {
				$filename = UPLOADS_DIR.'complaints/'.$complaint['tmp_name'];
				$ext = utils::getFileExt($filename);
				if (is_file($filename)) {
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename="'.$complaint['filename'].'"');
					header('Content-Length: '.filesize($filename));
					header('Content-Transfer-Encoding: binary');

					readfile($filename);
					die();
				}
			}
		}
		header('HTTP/1.1 404 Not Found');
		die();
	}

	public static function touchComplaintsByUser($user_id) {
		return CMS::$db->mod('complaints', ['is_read' => '1'], "user_id='".(int)$user_id."' AND admin_id IS NULL AND is_read='0'");
	}

	public static function countNewComplaints() {
		return CMS::$db->get("SELECT COUNT(t.id) AS `unread_conversation`
			FROM (
					SELECT c1.`id`, (ISNULL(c1.admin_id) AND c1.is_read=1) AS `unread`
						FROM `complaints` c1
							JOIN `site_users` ON `c1`.`user_id` = `site_users`.`id`
						WHERE `c1`.`date`=(
								SELECT MAX(`date`)
									FROM `complaints` c2
									WHERE `c2`.`user_id`=`c1`.`user_id`
									LIMIT 1
							) AND c1.admin_id IS NULL AND `is_read`='0'
						GROUP BY `c1`.`user_id`
						ORDER BY unread DESC, `c1`.`date` DESC
				) AS `t`");
	}
}

?>