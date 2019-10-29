<?php

namespace app\models;

use abeautifulsite\simple_image\SimpleImage;
use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\tr;
use profit_az\profit_cms\helpers\utils;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}

class articles {
	private static $runtime = [];

	public static $curr_pg = 1;
	public static $pp = 20;
	public static $pages_amount = 0;
	public static $items_amount = 0;
	public static $tbl = 'articles';
	public static $tr_fields = ['keywords', 'descr', 'title', 'short', 'full', 'is_published_lang'];
	public static $allowed_thumb_ext = ['jpg', 'jpeg', 'jpe', 'png', 'bmp', 'gif'];
	public static $dimensions = [
		'thumbs' => [
			'width' => 262,
			'height' => 169
		],
		'square' => [
			'width' => 60,
			'height' => 60
		],
		'larges' => [
			'width' => 800,
			'height' => 600
		],
		'block' => [
			'width' => 360,
			'height' => 190
		]
	];
	public static $stop_words = [
		'az' => ['azərbaycan', 'azərbaycanlı', 'azərbaycanı', 'azərbaycanda', 'respublika', 'respublikası', 'respublikasının', 'sinif', 'bunun', 'üçün', 'kimi', 'görə', 'ilə', 'ili', 'ildən', 'ildə', 'illərdə', 'üzrə', 'isə', 'kəsə', 'mən', 'mənim', 'əldə', 'çox', 'hər', 'the', 'digər', 'sonra', 'min', 'bir', 'nömrəli', 'ııı', 'nun', 'həmçinin', 'şəhəri', 'daxil', 'ölkələrinin', 'ölkədən', 'məqsədilə', 'ötən', 'keçən', 'keçirilmiş', 'çatıb', 'bildirib', 'olacaq', 'olunub', 'olunan', 'olunması', 'olan', 'olaq', 'olmaq', 'olaraq', 'olması', 'olmayacaq', 'olduqca', 'olmağım', 'olmayan', 'olursunuz', 'olum', 'olanda', 'olunmayacaq', 'olduğum', 'olanlara', 'olmaqla', 'etmək', 'etməkdir', 'edir', 'edib', 'edək', 'edən', 'ediblər', 'edəcək', 'edilib'],
		'ru' => ['азербайджан', 'азербайджанский', 'республика', 'класс', 'для', 'год', 'также', 'почти', 'когда', 'после', 'этих', 'потому', 'поэтому', 'очень', 'всех', 'когда', 'тогда', 'которые', 'того', 'лишь', 'если', 'надо', 'даже', 'есть', 'все', 'это', 'или', 'как', 'под', 'просто']
	];

	private static function checkGallery(&$response, &$article, $article_id=0) { // 2016-05-17
		$article['gallery_id'] = '0';
		if (!empty($_POST['gallery_id'])) {
			if (!CMS::$db->get("SELECT id FROM galleries WHERE id=:gallery_id AND is_deleted='0' LIMIT 1", [':gallery_id' => $_POST['gallery_id']])) {
				$response['errors'][] = 'article_add_err_gallery_not_exists';
			} else {
				$article['gallery_id'] = (int)$_POST['gallery_id'];
			}
		}
	}

	private static function checkSource(&$response, &$article, $article_id=0) { // 2016-05-24
		if (!empty($_POST['source_url']) || !empty($_POST['source_name'])) {
			$article['source_url'] = @$_POST['source_url'];
			$article['source_name'] = @$_POST['source_name'];
			if (!empty($article['source_url']) && !utils::validURL($article['source_url'])) {
				$response['errors'][] = 'article_add_err_source_url_invalid';
			}
		} else if ($article_id) {
			$article['source_url'] = null;
			$article['source_name'] = null;
		}
	}

	private static function genKeywords($s, $lang='az') { // 2016-05-24
		// cleanup
		$s = (string)$s;
		$s = trim($s);
		$s = strip_tags($s);
		$s = str_replace(["\t", "\r\n", "  "], ' ', $s);
		$s = str_replace(['"', '&nbsp;', '&amp;', '&quot;', "'", "`", "<", ">", "«", "»", "“", "”", "(", ")", "?", "!", "=", "  "], ' ', $s);
		$s = html_entity_decode($s);
		$s = preg_replace('/\s+/', ' ', $s);
		if ($lang=='az') {
			$s = str_replace('İ', 'i', $s);
			$s = str_replace('I', 'ı', $s);
		}
		$s = mb_convert_case($s, MB_CASE_LOWER, "UTF-8");

		// sort words by frequency
		$words = [];
		preg_match_all("/[0-9a-zA-Zа-яА-ЯüöğıəçşёÜÖĞİƏÇŞЁ\-]{3,}+/isu", $s, $words);
		$words = array_count_values($words[0]);
		asort($words, SORT_DESC);
		$words = array_reverse($words, 1);
		$words = array_keys($words);

		// clean from stop words
		$stop_words = @self::$stop_words[$lang];
		if (empty($stop_words)) {$stop_words = [];}
		$words = array_diff($words, $stop_words);
		$words = array_values($words);

		// reduce amount
		$tail = $words;
		$words = array_slice($words, 0, 10);
		$tail = array_slice($tail, 10, 20);
		if ($tail) {
			shuffle($tail);
			$tail = array_slice($tail, 0, 10);
			$words = array_merge($words, $tail);
		}

		return $words;
	}

	private static function genShorttext($s) { // 2016-05-17
		$s = (string)$s;
		$s = trim($s);
		$s = html_entity_decode($s);
		$s = strtr($s, [
			'</p>' => "</p>\n",
			'<br />' => "<br />\n",
		]);
		$s = strip_tags($s);
		$s = explode("\n", $s);
		$s = reset($s);

		return $s;
	}

	public static function getArticlesList() { // 2016-12-04
		$list = [];

		$joins = [];
		$joins['tr'] = "LEFT JOIN translates tr ON tr.ref_table='".self::$tbl."' AND tr.ref_id=a.id AND tr.lang=:default_site_lang AND tr.fieldname='title'";
		$joins['cu'] = "LEFT JOIN cms_users cu ON cu.id=a.add_by";
		$filter = [];
		$filter[] = "a.is_deleted='0'";
		if (!empty($_GET['q'])) {
			$filter[] = "tr.text LIKE '%".utils::makeSearchable($_GET['q'])."%'";
		}
		if (in_array(@$_GET['filter']['status'], ['0', '1'])) {
			$filter[] = "a.is_published=".CMS::$db->escape($_GET['filter']['status']);
		}
		if (!empty($_GET['filter']['author'])) {
			$filter[] = "a.add_by='".(int)$_GET['filter']['author']."'";
		}
		$assignment_fields = [
			'on_main_page' => ['show_on_main_page', '1'],
			'off_main_page' => ['show_on_main_page', '0'],
			'highlighted' => ['is_highlighted', '1']
		];
		if (in_array(@$_GET['filter']['assignment'], array_keys($assignment_fields))) {
			$filter[] = "a.".$assignment_fields[$_GET['filter']['assignment']][0]."=".CMS::$db->escape($assignment_fields[$_GET['filter']['assignment']][1]);
		}
		if (!empty($_GET['filter']['cats']) && is_array($_GET['filter']['cats'])) {
			$filter_cats = $_GET['filter']['cats'];
			$allow_cat_conds = [];
			if (isset($filter_cats['none'])) {
				$allow_cat_conds[] = "(SELECT id FROM articles_cats_rel WHERE articles_cats_rel.article_id=a.id LIMIT 1) IS NULL";
				unset($filter_cats['none']);
			}
			$allow_cats = [];
			foreach ($filter_cats as $c) {
				$allow_cats[] = (int)$c;
			}
			if (count($allow_cats)) {
				$allow_cat_conds[] = "(SELECT id FROM articles_cats_rel WHERE articles_cats_rel.article_id=a.id AND articles_cats_rel.category_id IN ('".implode("', '", $allow_cats)."') LIMIT 1) IS NOT NULL";
			}
			$allow_cat_conds_num = count($allow_cat_conds);
			if ($allow_cat_conds_num>1) {
				$filter[] = "(".implode(" OR ", $allow_cat_conds).")";
			} else if ($allow_cat_conds_num==1) {
				$filter[] = $allow_cat_conds[0];
			}
		}
		$where = (empty($filter)? '': ('WHERE '.implode(" AND ", $filter)));

		$c = CMS::$db->get("SELECT COUNT(a.id)
			FROM `".self::$tbl."` a
				".implode("\n", $joins)."
			{$where}", [
			':default_site_lang' => CMS::$default_site_lang
		]);
		self::$items_amount = $c;
		//print "<pre>RESULT:\n{$c}\n\nQUERIES:\n".var_export(CMS::$db->queries, 1)."\n\nERRORS:\n".var_export(CMS::$db->errors, 1)."\n</pre>";
		$pages_amount = ceil($c/self::$pp);

		if ($pages_amount>0) {
			self::$pages_amount = $pages_amount;
			self::$curr_pg = ((self::$curr_pg>self::$pages_amount)? self::$pages_amount: self::$curr_pg);
			$start_from = (self::$curr_pg-1)*self::$pp;

			$list = CMS::$db->getAll("SELECT a.id, a.sef, a.img, a.publish_datetime, a.ordering, a.add_by, a.add_datetime, a.mod_by, a.mod_datetime, a.is_published,
					tr.text AS title,
					cu.name AS author_name,
					(
						SELECT COUNT(c.id)
							FROM comments c
								JOIN site_users u ON u.id=c.user_id
							WHERE c.ref_table='".self::$tbl."' AND c.ref_id=a.id
					) AS comments_num
				FROM `".self::$tbl."` a
					".implode("\n", $joins)."
				{$where}
				ORDER BY a.ordering DESC
				LIMIT ".(($start_from>0)? ($start_from.', '): '').self::$pp, [
				':default_site_lang' => CMS::$default_site_lang
			]);
			// print "<pre>RESULT:\n".var_export($list, 1)."\n\nQUERIES:\n".var_export(CMS::$db->queries, 1)."\n\nERRORS:\n".var_export(CMS::$db->errors, 1)."\n</pre>";
		}

		return $list;
	}

	public static function addArticle() { // 2016-06-10
		$response = ['success' => false, 'message' => 'insert_err'];

		$article = [];
		$translates = [];

		$title = trim(@$_POST['title'][CMS::$default_site_lang]);

		if (!utils::valid_date(@$_POST['publish_date'])) {
			$response['errors'][] = 'article_add_err_publish_date_invalid';
		} else if (!isset($_POST['publish_hour']) || (@$_POST['publish_hour']<0) || (@$_POST['publish_hour']>23)) {
			$response['errors'][] = 'article_add_err_publish_hour_invalid';
		} else if (!isset($_POST['publish_minutes']) || (@$_POST['publish_minutes']<0) || (@$_POST['publish_minutes']>59)) {
			$response['errors'][] = 'article_add_err_publish_minutes_invalid';
		} else {
			$article['publish_datetime'] = utils::formatPlainDate('Y-m-d', $_POST['publish_date']).' '.str_pad((int)$_POST['publish_hour'], 2, '0', STR_PAD_LEFT).':'.str_pad((int)$_POST['publish_minutes'], 2, '0', STR_PAD_LEFT).':00';
		}

		$sef = trim(@$_POST['sef']);
		if (empty($sef) && !empty($title)) {
			$sef = $title;
		}
		$sef = utils::makeSEF($sef);
		if (empty($sef)) {
			$response['errors'][] = 'article_edit_err_sef_empty';
		} else {
			$article['sef'] = $sef;
		}

		self::checkSource($response, $article);

		self::checkGallery($response, $article);

		if (!empty($_FILES['img']['name'])) {
			if (empty($_FILES['img']['error'])) {
				$article['img'] = utils::upload($_FILES['img']['name'], $_FILES['img']['tmp_name'], UPLOADS_DIR.'articles/originals/', self::$allowed_thumb_ext);
				if (empty($article['img'])) {
					$response['errors'][] = 'upl_invalid_image_extension_err';
				} else {
					foreach (self::$dimensions as $dir=>$size) {
						@mkdir(UPLOADS_DIR.'articles/'.$dir.'/', 0777, true);
						$img = new SimpleImage(UPLOADS_DIR.'articles/originals/'.$article['img']);
						$img->thumbnail($size['width'], $size['height'])->save(UPLOADS_DIR.'articles/'.$dir.'/'.$article['img']);
					}
				}
			} else {
				$response['errors'][] = CMS::$upload_err[$_FILES['img']['error']];
			}
		}

		// processing translates
		foreach (CMS::$site_langs as $lng) {
			foreach (self::$tr_fields as $f) {
				if (in_array($f, ['title', 'full'])) {
					$translates[$lng['language_dir']][$f] = trim(@$_POST[$f][$lng['language_dir']]);

					if ($f=='full') {
						$translates[$lng['language_dir']]['short'] = self::genShorttext($translates[$lng['language_dir']][$f]);
					}

					if (!empty($_POST['is_published_lang'][$lng['language_dir']])) {
						if (empty($translates[$lng['language_dir']][$f]) && in_array($f, ['title', 'full'])) {
							$response['errors'][] = 'article_add_err_'.$f.'_empty';
						}
					}
				} else if (in_array($f, ['is_published_lang'])) {
					$translates[$lng['language_dir']][$f] = (empty($_POST[$f][$lng['language_dir']])? '0': '1');
				} else if (in_array($f, ['keywords'])) {
					$s = @$_POST['title'][$lng['language_dir']].' '.@$_POST['full'][$lng['language_dir']];
					$s = self::genKeywords($s, $lng['language_dir']);
					$s = implode(', ', $s);
					$translates[$lng['language_dir']][$f] = $s;
				}
			}
		}

		//$response['errors'][] = 'prevent saving';
		if (empty($response['errors'])) {
			$article['ordering'] = CMS::$db->get("SELECT MAX(ordering) FROM `".self::$tbl."`")+1;
			$article['is_published'] = (empty($_POST['is_published'])? '0': '1');
			$article['show_on_main_page'] = (empty($_POST['show_on_main_page'])? '0': '1');
			$article['is_highlighted'] = (empty($_POST['is_highlighted'])? '0': '1');
			$article['add_by'] = $_SESSION[CMS::$sess_hash]['ses_adm_id'];
			$article['add_datetime'] = date('Y-m-d H:i:s');

			$article_id = CMS::$db->add(self::$tbl, $article);

			if ($article_id) {
				$response['success'] = true;
				$response['message'] = 'insert_suc';

				// saving translates
				foreach ($translates as $lang=>$tr_data) {
					foreach ($tr_data as $fieldname=>$text) {
						tr::store([
							'ref_table' => self::$tbl,
							'ref_id' => $article_id,
							'lang' => $lang,
							'fieldname' => $fieldname,
							'text' => $text,
						]);
					}
				}

				// saving categories
				if (!empty($_POST['cats']) && is_array($_POST['cats'])) foreach ($_POST['cats'] as $c) {
					CMS::$db->add('articles_cats_rel', [
						'article_id' => $article_id,
						'category_id' => $c,
					]);
				}

				// creating counters
				$types = ['like', 'dislike', 'view', 'comment'];
				foreach ($types as $e) {
					CMS::$db->add('counters', [
						'ref_table' => self::$tbl,
						'ref_id' => $article_id,
						'type' => $e,
						'counter' => '0',
					]);
				}

				// log event
				CMS::log([
					'subj_table' => self::$tbl,
					'subj_id' => $article_id,
					'action' => 'add',
					'descr' => 'Article added by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO,
				]);
			}
		}

		return $response;
	}

	public static function editArticle($id) { // 2016-06-10
		$response = ['success' => false, 'message' => 'update_err'];
		$article = self::getArticle($id);
		if (empty($article['id'])) {
			$response['message'] = 'article_edit_err_not_found';
			return $response;
		}

		$upd = [];
		$translates = [];

		$title = trim(@$_POST['title'][CMS::$default_site_lang]);
		$sef = trim(@$_POST['sef']);
		if (empty($sef) && !empty($title)) {
			$sef = $title;
		}
		$sef = utils::makeSEF($sef);
		if (empty($sef)) {
			$response['errors'][] = 'article_edit_err_sef_empty';
		} else {
			$upd['sef'] = $sef;
		}

		self::checkSource($response, $upd, $article['id']);

		self::checkGallery($response, $upd, $article['id']);

		if (!empty($_FILES['img']['name'])) {
			if (empty($_FILES['img']['error'])) {
				$uploaded = utils::upload($_FILES['img']['name'], $_FILES['img']['tmp_name'], UPLOADS_DIR.'articles/originals/', self::$allowed_thumb_ext);
				if (empty($uploaded)) {
					$response['errors'][] = 'upl_invalid_image_extension_err';
				} else {
					$upd['img'] = $uploaded;
					@unlink(UPLOADS_DIR.'articles/originals/'.$article['img']);

					foreach (self::$dimensions as $dir=>$size) {
						@unlink(UPLOADS_DIR.'articles/'.$dir.'/'.$article['img']);
						$img = new SimpleImage(UPLOADS_DIR.'articles/originals/'.$uploaded);
						$img->thumbnail($size['width'], $size['height'])->save(UPLOADS_DIR.'articles/'.$dir.'/'.$uploaded);
					}
				}
			} else {
				$response['errors'][] = CMS::$upload_err[$_FILES['img']['error']];
			}
		}

		if (!utils::valid_date(@$_POST['publish_date'])) {
			$response['errors'][] = 'article_add_err_publish_date_invalid';
		} else if (!isset($_POST['publish_hour']) || (@$_POST['publish_hour']<0) || (@$_POST['publish_hour']>23)) {
			$response['errors'][] = 'article_add_err_publish_hour_invalid';
		} else if (!isset($_POST['publish_minutes']) || (@$_POST['publish_minutes']<0) || (@$_POST['publish_minutes']>59)) {
			$response['errors'][] = 'article_add_err_publish_minutes_invalid';
		} else {
			$upd['publish_datetime'] = utils::formatPlainDate('Y-m-d', $_POST['publish_date']).' '.str_pad((int)$_POST['publish_hour'], 2, '0', STR_PAD_LEFT).':'.str_pad((int)$_POST['publish_minutes'], 2, '0', STR_PAD_LEFT).':00';
		}

		// processing translates
		foreach (CMS::$site_langs as $lng) {
			foreach (self::$tr_fields as $f) {
				if (in_array($f, ['title', /*'descr',*/ 'short', 'full'])) {
					$translates[$lng['language_dir']][$f] = trim(@$_POST[$f][$lng['language_dir']]);

					if (!empty($_POST['is_published_lang'][$lng['language_dir']])) {
						if (empty($translates[$lng['language_dir']][$f]) && in_array($f, ['title', 'full'])) {
							$response['errors'][] = 'article_add_err_'.$f.'_empty';
						}
					}
				} else if (in_array($f, ['is_published_lang'])) {
					$translates[$lng['language_dir']][$f] = (empty($_POST[$f][$lng['language_dir']])? '0': '1');
				} else if (in_array($f, ['keywords'])) {
					$translates[$lng['language_dir']][$f] = trim(@$_POST[$f][$lng['language_dir']]);
				}
			}
		}

		if (empty($response['errors'])) {
			$upd['is_published'] = (empty($_POST['is_published'])? '0': '1');
			$upd['show_on_main_page'] = (empty($_POST['show_on_main_page'])? '0': '1');
			$upd['is_highlighted'] = (empty($_POST['is_highlighted'])? '0': '1');
			$upd['mod_by'] = $_SESSION[CMS::$sess_hash]['ses_adm_id'];
			$upd['mod_datetime'] = date('Y-m-d H:i:s');

			$updated = CMS::$db->mod(self::$tbl.'#'.(int)$id, $upd);

			// saving translates
			foreach ($translates as $lang=>$tr_data) {
				foreach ($tr_data as $fieldname=>$text) {
					tr::store([
						'ref_table' => self::$tbl,
						'ref_id' => $id,
						'lang' => $lang,
						'fieldname' => $fieldname,
						'text' => $text,
					]);
				}
			}

			// saving categories
			$old_cats = self::getArtCats($id);
			if (empty($old_cats)) {$old_cats = [];}
			$new_cats = @$_POST['cats'];
			if (empty($new_cats)) {$new_cats = [];}
			$del = array_diff($old_cats, $new_cats);
			$ins = array_diff($new_cats, $old_cats);
			foreach ($del as $cid) {
				CMS::$db->run("DELETE FROM articles_cats_rel WHERE article_id=:article_id AND category_id=:category_id", [
					':article_id' => $id,
					':category_id' => $cid
				]);
			}
			foreach ($ins as $cid) {
				CMS::$db->add('articles_cats_rel', [
					'article_id' => $id,
					'category_id' => $cid,
				]);
			}

			// log event
			CMS::log([
				'subj_table' => self::$tbl,
				'subj_id' => $id,
				'action' => 'edit',
				'descr' => 'Article modified by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO,
			]);

			$response['success'] = true;
			$response['message'] = 'update_suc';
		}

		return $response;
	}

	public static function setArticleStatus($id, $status) { // 2016-12-04
		$updated = CMS::$db->mod(self::$tbl.'#'.(int)$id, [
			'is_published' => (($status=='on')? '1': '0')
		]);

		if ($updated) {
			CMS::log([
				'subj_table' => self::$tbl,
				'subj_id' => $id,
				'action' => 'edit',
				'descr' => 'Article '.(($status=='on')? '': 'un').'published by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO,
			]);
		}

		return $updated;
	}

	public static function deleteArticle($id) { // 2016-12-04
		$deleted = CMS::$db->mod(self::$tbl.'#'.(int)$id, [
			'is_deleted' => '1',
		]);

		if ($deleted) {
			CMS::log([
				'subj_table' => self::$tbl,
				'subj_id' => $id,
				'action' => 'delete',
				'descr' => 'Article moved to recycle bin by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO,
			]);
		}

		return $deleted;
	}

	public static function deleteArticleImages($id) { // 2016-12-04
		$article = self::getArticle($id);
		if (empty($article['id']) || empty($article['img'])) {return false;}

		$updated = CMS::$db->mod(self::$tbl.'#'.(int)$id, [
			'img' => null
		]);

		if ($updated) {
			CMS::log([
				'subj_table' => self::$tbl,
				'subj_id' => $id,
				'action' => 'edit',
				'descr' => 'Article image removed by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO,
			]);
		}

		@unlink(UPLOADS_DIR.'articles/originals/'.$article['img']);
		foreach (self::$dimensions as $dir=>$size) {
			@unlink(UPLOADS_DIR.'articles/'.$dir.'/'.$article['img']);
		}

		return true;
	}

	public static function getArticle($id) { // 2016-12-04
		$sql = "SELECT * FROM `".self::$tbl."` WHERE id=:article_id AND is_deleted='0' LIMIT 1";
		$article = CMS::$db->getRow($sql, [
			':article_id' => $id
		]);
		if (!empty($article['id'])) {$article['translates'] = tr::get(self::$tbl, $id);}
		return $article;
	}

	public static function getArtCats($id) { // 2016-05-13
		$sql = "SELECT category_id FROM articles_cats_rel WHERE article_id=:article_id";
		$params = [
			':article_id' => $id
		];
		return CMS::$db->getList($sql, $params);
	}

	public static function sortArticles($from, $to) { // 2016-05-09
		$from = (int)$from;
		$to = (int)$to;
		if (empty($from) || empty($to) || ($from==$to)) {return false;}

		/*
		$from - идентификатор элемента, который перетаскивали
		$to - последний элемент до новой позиции перетаскиваемого (если тащили вниз то до перетаскиваемого, если вверх - после)
		нужно изменить ордеринг всех элементов, чей ордеринг между старой позицией перетаскиваемого элемента и новой позицией
		перетаскиваемый элемент становится на место $to
		*/
		$from_ord = CMS::$db->get("SELECT ordering FROM `".self::$tbl."` WHERE id=:from_id LIMIT 1", [
			':from_id' => $from
		]);
		$to_ord = CMS::$db->get("SELECT ordering FROM `".self::$tbl."` WHERE id=:to_id LIMIT 1", [
			':to_id' => $to
		]);
		if (($from_ord===false) || ($to_ord===false) || ($from_ord==$to_ord)) {return false;}

		CMS::$db->run("UPDATE `".self::$tbl."`
			SET ordering=(ordering".(($to_ord>$from_ord)? '-': '+')."1)
			WHERE ordering".(($to_ord>$from_ord)? '>': '<').":from AND ordering".(($to_ord>$from_ord)? '<': '>')."=:to",
			[
			':from' => $from_ord,
			':to' => $to_ord
		]);
		CMS::$db->run("UPDATE `".self::$tbl."`
			SET ordering=:to_ord
			WHERE id=:from_id",
			[
			':from_id' => $from,
			':to_ord' => $to_ord
		]);
		//file_put_contents('ordering.txt', var_export(CMS::$db->queries, 1)."\n\n".var_export(CMS::$db->errors, 1));

		return true;
	}

	public static function sortArticlesPaged($item, $page) { // 2016-05-09
		$item = (int)$item;
		$page = (int)trim($page);
		if (empty($item) || empty($page)) {return false;}

		self::$curr_pg = $page;
		$articles = self::getArticlesList();
		if (empty($articles)) {return false;}
		$page_first_item = $articles[0]['id'];

		return self::sortArticles($item, $page_first_item);
	}

	public static function getArticlesAutocomplete($q, $page=1) { // 2017-05-07
		$data = [
			'total_count' => 0,
			'articles' => []
		];

		$pp = 30;
		$start_from = ($page-1)*$pp;

		$params = [':q' => "%".utils::makeSearchable($q)."%"];

		$params[':lang'] = CMS::$default_site_lang;

		$c = CMS::$db->get("SELECT COUNT(a.id)
			FROM `".self::$tbl."` a
				LEFT JOIN translates tr ON tr.ref_table='".self::$tbl."' AND tr.ref_id=a.id AND tr.lang=:lang AND tr.fieldname='title'
			WHERE a.is_deleted='0' AND tr.text LIKE :q", $params);
		if (!$c) {return $data;}
		$data['total_count'] = (int)$c;

		$sql = "SELECT a.id, tr.text AS `label`, tr.text AS `value`
			FROM `".self::$tbl."` a
				LEFT JOIN translates tr ON tr.ref_table='".self::$tbl."' AND tr.ref_id=a.id AND tr.lang=:lang AND tr.fieldname='title'
			WHERE a.is_deleted='0' AND tr.text LIKE :q
			ORDER BY tr.text
			LIMIT ".(($start_from>0)? ($start_from.', '): '').$pp;

		$data['articles'] = CMS::$db->getAll($sql, $params);

		return $data;
	}

	public static function getAuthors() { // 2016-05-31
		$sql = "SELECT cu.id, cu.name, cu.role
			FROM cms_users cu
				JOIN `".self::$tbl."` a ON a.add_by=cu.id
			WHERE cu.role IN ('".implode("', '", array_keys(CMS::$roles))."') AND a.is_deleted='0'
			GROUP BY cu.id
			ORDER BY cu.name ASC";
		return CMS::$db->getAll($sql);
	}

	public static function prefiltrateRestrictedCategories($allowed_cats) { // 2016-05-26
		if (!empty($allowed_cats)) { // prefiltrate categories if restricted
			self::$runtime['original_filter_cats'] = @$_GET['filter']['cats'];
			self::$runtime['editor_cats'] = self::$runtime['original_filter_cats'];
			unset(self::$runtime['editor_cats']['none']);
			if (empty(self::$runtime['editor_cats'])) {
				$_GET['filter']['cats'] = $allowed_cats;
			} else {
				$_GET['filter']['cats'] = array_intersect(self::$runtime['editor_cats'], $allowed_cats);
			}
		}
	}

	public static function restoreCategoriesFilter($allowed_cats) { // 2016-05-26
		if (!empty($allowed_cats)) { // restore categories filter
			$_GET['filter']['cats'] = self::$runtime['original_filter_cats'];
		}
	}

	public static function countArticleComments($article_id) { // 2017-01-04
		$sql = "SELECT COUNT(c.id)
			FROM comments c
				JOIN site_users u ON u.id=c.user_id
			WHERE c.ref_table='".self::$tbl."' AND c.ref_id=:id";
		$params = [':id' => $article_id];

		return CMS::$db->get($sql, $params);
	}

	public static function countArticles() { // 2017-01-04
		$sql = "SELECT COUNT(a.id)
			FROM `".self::$tbl."` a
			WHERE a.is_deleted='0'";

		return CMS::$db->get($sql);
	}
}

?>