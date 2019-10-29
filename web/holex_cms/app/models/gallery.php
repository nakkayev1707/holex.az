<?php

namespace app\models;

use abeautifulsite\simple_image\SimpleImage;
use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\tr;
use profit_az\profit_cms\helpers\utils;

if (!defined("_VALID_PHP")) {die('Direct access to this location is not allowed.');}

class gallery {
	public static $curr_pg = 1;
	public static $pp = 12;
	public static $pages_amount = 0;
	public static $items_amount = 0;
	public static $tbl = 'galleries';

	public static $dir = '../uploads/galleries/';
	public static $subdirs = ['original', 'thumb', 'big'];
	public static $allowed_ext = ['jpg', 'jpeg', 'jpe'];
	public static $upload_err = [
		1 => 'upl_ini_size_err',			// The uploaded file exceeds the upload_max_filesize directive in php.ini
		2 => 'upl_form_size_err',			// The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form
		3 => 'upl_partial_err',				// The uploaded file was only partially uploaded
		4 => 'upl_no_file_err',				// No file was uploaded
		// 5 => 'upl_empty_file_err',			// Empty file was uploaded
		6 => 'upl_no_tmp_dir_err',			// Missing a temporary folder
		7 => 'upl_can_write_err',			// Failed to write file to disk
		8 => 'upl_extension_err'			// A PHP extension stopped the file upload
	];
	public static $dimensions = [
		'thumb' => [
			'width' => 240,
			'height' => 160
		],
		'big' => [
			'width' => 1280,
			'height' => 720
		]
	];
	public static $tr_fields = ['name', 'is_published_lang'];


	private static function processTranslates(&$response, &$translates) { // 2016-05-16
		foreach (CMS::$site_langs as $lng) {
			foreach (self::$tr_fields as $f) {
				if (in_array($f, ['name'])) {
					$translates[$lng['language_dir']][$f] = trim(@$_POST[$f][$lng['language_dir']]);

					if (($lng['language_dir']==CMS::$default_site_lang) || !empty($_POST['is_published_lang'][$lng['language_dir']])) {
						if (empty($translates[$lng['language_dir']][$f]) && in_array($f, ['name'])) {
							$response['errors'][] = 'gallery_edit_err_'.$f.'_empty';
						}
					}
				} else if (in_array($f, ['is_published_lang'])) {
					if ($lng['language_dir']==CMS::$default_site_lang) {
						$translates[$lng['language_dir']][$f] = '1';
					} else {
						$translates[$lng['language_dir']][$f] = (empty($_POST[$f][$lng['language_dir']])? '0': '1');
					}
				}
			}
		}
	}


	public static function addGallery() { // 2016-05-16
		$response = ['success' => false, 'message' => 'insert_err'];

		$gallery = [];
		$translates = [];

		self::processTranslates($response, $translates);

		if (empty($response['errors'])) {
			$gallery['is_published'] = (empty($_POST['is_published'])? '0': '1');
			$gallery['add_by'] = $_SESSION[CMS::$sess_hash]['ses_adm_id'];
			$gallery['add_datetime'] = date('Y-m-d H:i:s');

			$gallery_id = CMS::$db->add('galleries', $gallery);

			if (!empty($gallery_id)) {
				$response['success'] = true;
				$response['message'] = 'insert_suc';
				$response['data']['gallery_id'] = $gallery_id;

				// saving translates
				foreach ($translates as $lang=>$tr_data) {
					foreach ($tr_data as $fieldname=>$text) {
						tr::store([
							'ref_table' => 'galleries',
							'ref_id' => $gallery_id,
							'lang' => $lang,
							'fieldname' => $fieldname,
							'text' => $text,
						]);
					}
				}

				CMS::log([
					'subj_table' => 'galleries',
					'subj_id' => $gallery_id,
					'action' => 'add',
					'descr' => 'Gallery album added by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO,
				]);
			}
		}

		return $response;
	}

	public static function editGallery($gallery_id) { // 2016-05-16
		$response = ['success' => false, 'message' => 'update_err'];

		$old_data = self::getGalleryInfo($gallery_id);
		if (empty($old_data['id'])) {
			$response['message'] = 'gallery_edit_item_err_not_found';
			return $response;
		}

		$gallery = [];
		$translates = [];

		self::processTranslates($response, $translates);

		if (empty($response['errors'])) {
			$gallery['is_published'] = (empty($_POST['is_published'])? '0': '1');
			$gallery['mod_by'] = $_SESSION[CMS::$sess_hash]['ses_adm_id'];
			$gallery['mod_datetime'] = date('Y-m-d H:i:s');

			$updated = CMS::$db->mod('galleries#'.$gallery_id, $gallery);

			// saving translates
			foreach ($translates as $lang=>$tr_data) {
				foreach ($tr_data as $fieldname=>$text) {
					tr::store([
						'ref_table' => 'galleries',
						'ref_id' => $gallery_id,
						'lang' => $lang,
						'fieldname' => $fieldname,
						'text' => $text,
					]);
				}
			}

			CMS::log([
				'subj_table' => 'galleries',
				'subj_id' => $gallery_id,
				'action' => 'edit',
				'descr' => 'Gallery album modified by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO,
			]);

			$response['success'] = true;
			$response['message'] = 'update_suc';
		}

		return $response;
	}

	public static function getGalleriesList() {
		$list = [];

		$joins = [];
		$joins['tr'] = "LEFT JOIN translates tr ON tr.ref_table='galleries' AND tr.ref_id=g.id AND tr.lang=:default_site_lang AND tr.fieldname='name'";
		$joins['cu'] = "LEFT JOIN cms_users cu ON cu.id=g.add_by";
		$filter = [];
		$filter[] = "g.is_deleted='0'";
		if (!empty($_GET['q'])) {
			$filter[] = "tr.text LIKE '%".utils::makeSearchable($_GET['q'])."%'";
		}
		if (in_array(@$_GET['filter']['status'], ['0', '1'])) {
			$filter[] = "g.is_published=".CMS::$db->escape($_GET['filter']['status']);
		}
		if (!empty($_GET['filter']['author'])) {
			$filter[] = "g.add_by='".(int)$_GET['filter']['author']."'";
		}
		$where = (empty($filter)? '': ('WHERE '.implode(" AND ", $filter)));

		//$c = CMS::$db->select('COUNT(id)', 'galleries', $where);
		$c = CMS::$db->get("SELECT COUNT(g.id)
			FROM galleries g
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

			$list = CMS::$db->getAll("SELECT g.*, COUNT(f.id) AS photos_num, tr.text AS name, cu.name AS author_name
				FROM galleries g
					LEFT JOIN gallery_photos f ON f.gallery_id=g.id
					".implode("\n", $joins)."
				{$where}
				GROUP BY g.id
				ORDER BY g.id DESC
				LIMIT ".($start_from? ($start_from.', '): '').self::$pp, [
				':default_site_lang' => CMS::$default_site_lang
			]);
			// print "<pre>RESULT:\n".var_export($list, 1)."\n\nQUERIES:\n".var_export(CMS::$db->queries, 1)."\n\nERRORS:\n".var_export(CMS::$db->errors, 1)."\n</pre>";
		}

		return $list;
	}

	public static function getGalleryInfo($gallery_id) {
		$sql = "SELECT g.*, COUNT(f.id) AS photos_num, cu.name AS author_name, mcu.name AS editor_name
			FROM galleries g
				LEFT JOIN gallery_photos f ON f.gallery_id=g.id
				JOIN cms_users cu ON cu.id=g.add_by
				LEFT JOIN cms_users mcu ON mcu.id=g.mod_by
			WHERE g.id=:gallery_id AND g.is_deleted='0'
			LIMIT 1";
		$gallery = CMS::$db->getRow($sql, [
			':gallery_id' => $gallery_id
		]);

		if (!empty($gallery['id'])) {
			foreach (CMS::$site_langs as $lng) {
				$translates = CMS::$db->getPairs("SELECT fieldname, text FROM translates WHERE ref_table='galleries' AND ref_id=:gallery_id AND lang=:lang", [
					':gallery_id' => $gallery_id,
					':lang' => $lng['language_dir']
				]);
				$gallery['translates'][$lng['language_dir']] = $translates;
			}
		}

		return $gallery;
	}

	public static function moveGalleryToBin($gallery_id) { // 2016-05-16
		$deleted = CMS::$db->mod('galleries#'.(int)$gallery_id, [
			'is_deleted' => '1',
		]);

		if ($deleted) {
			CMS::log([
				'subj_table' => 'galleries',
				'subj_id' => $gallery_id,
				'action' => 'delete',
				'descr' => 'Gallery album moved to recycle bin by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO,
			]);
		}

		return $deleted;
	}

	public static function deleteGallery($gallery_id) {
		if (empty($gallery_id)) {return false;} else {$gallery_id = intval($gallery_id);}

		$photos = CMS::$db->selectAll('*', 'gallery_photos', "gallery_id='{$gallery_id}'");
		if (is_array($photos) && count($photos)) foreach ($photos as $f) {
			self::deletePhoto($f['id']);
		}

		utils::deleteDir(self::$dir.'gallery_'.$gallery_id.'/');

		$deleted = CMS::$db->exec("DELETE FROM galleries WHERE id='{$gallery_id}'");
		CMS::$db->exec("OPTIMIZE TABLE galleries");

		if ($deleted) {
			CMS::log([
				'subj_table' => 'galleries',
				'subj_id' => $gallery_id,
				'action' => 'erase',
				'descr' => 'Gallery album erased by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO,
			]);
		}

		return $deleted;
	}

	public static function setGalleryStatus($gallery_id, $status) { // 2017-01-18
		$updated = CMS::$db->mod(self::$tbl.'#'.(int)$gallery_id, [
			'is_published' => (($status=='on')? '1': '0')
		]);

		if ($updated) {
			CMS::log([
				'subj_table' => self::$tbl,
				'subj_id' => $gallery_id,
				'action' => 'edit',
				'descr' => 'Gallery album '.(($status=='on')? '': 'un').'published by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO,
			]);
		}

		return $updated;
	}

	public static function getAutocomplete($q, $page=1) { // 2017-04-02
		$data = [
			'total_count' => 0,
			'galleries' => []
		];
		$pp = 30;
		$start_from = ($page-1)*$pp;

		$params = [':q' => "%".utils::makeSearchable($q)."%"];
		$c = CMS::$db->get("SELECT COUNT(g.id)
			FROM galleries g
				LEFT JOIN translates tr ON tr.ref_table='galleries' AND tr.ref_id=g.id AND tr.lang='az' AND tr.fieldname='name'
			WHERE g.is_deleted='0' AND tr.text LIKE :q", $params);
		if (!$c) {return $data;}
		$data['total_count'] = (int)$c;

		$sql = "SELECT g.id, tr.text AS `label`, tr.text AS `value`
			FROM galleries g
				LEFT JOIN translates tr ON tr.ref_table='galleries' AND tr.ref_id=g.id AND tr.lang='az' AND tr.fieldname='name'
			WHERE g.is_deleted='0' AND tr.text LIKE :q
			ORDER BY tr.text
			LIMIT ".(($start_from>0)? ($start_from.', '): '').$pp;
		$data['galleries'] = CMS::$db->getAll($sql, $params);

		return $data;
	}

	public static function getAuthors() { // 2016-05-31
		$sql = "SELECT cu.id, cu.name, cu.role
			FROM cms_users cu
				JOIN galleries g ON g.add_by=cu.id
			WHERE cu.role IN ('".implode("', '", array_keys(CMS::$roles))."') AND g.is_deleted='0'
			GROUP BY cu.id
			ORDER BY cu.name ASC";
		return CMS::$db->getAll($sql);
	}


/* Photos */

	public static function getPhoto($photo_id) {
		$sql = "SELECT f.*, cu.name AS author_name, mcu.name AS editor_name
			FROM gallery_photos f
				JOIN cms_users cu ON cu.id=f.add_by
				LEFT JOIN cms_users mcu ON mcu.id=f.mod_by
			WHERE f.id=:photo_id
			LIMIT 1";
		$f = CMS::$db->getRow($sql, [
			':photo_id' => $photo_id
		]);

		if (!empty($f['id'])) {
			foreach (CMS::$site_langs as $lng) {
				$translates = CMS::$db->getPairs("SELECT fieldname, text FROM translates WHERE ref_table='gallery_photos' AND ref_id=:photo_id AND lang=:lang", [
					':photo_id' => $photo_id,
					':lang' => $lng['language_dir']
				]);
				$f['translates'][$lng['language_dir']] = $translates;
			}
		}

		return $f;
	}

	public static function getGalleryPhotos($gallery_id) {
		$photos = [];
		if (empty($gallery_id)) {return $photos;} else {$gallery_id = intval($gallery_id);}

		$joins = [];
		$joins['tr'] = "LEFT JOIN translates tr ON tr.ref_table='gallery_photos' AND tr.ref_id=f.id AND tr.lang=:default_site_lang AND tr.fieldname='name'";
		$joins['cu'] = "LEFT JOIN cms_users cu ON cu.id=f.add_by";
		$filter = [];
		$filter[] = "gallery_id=:gallery_id";
		$params = [
			':default_site_lang' => CMS::$default_site_lang,
			':gallery_id' => $gallery_id
		];
		if (!empty($_GET['q'])) {
			$filter[] = "tr.text LIKE '%".utils::makeSearchable($_GET['q'])."%'";
		}
		if (in_array(@$_GET['filter']['status'], ['0', '1'])) {
			$filter[] = "f.status=:status";
			$params[':status'] = $_GET['filter']['status'];
		}
		$where = (empty($filter)? '': ('WHERE '.implode(" AND ", $filter)));

		if (!empty($_GET['no_pagination'])) {
			$photos = CMS::$db->getAll("SELECT f.*, tr.text AS name, cu.name AS author_name
				FROM gallery_photos f
					".implode("\n", $joins)."
				{$where}
				ORDER BY f.ordering ASC", $params);
		} else {
			$c = CMS::$db->get("SELECT COUNT(f.id)
				FROM gallery_photos f
					".implode("\n", $joins)."
				{$where}", $params);
			//print "<pre>RESULT:\n{$c}\n\nQUERIES:\n".var_export(CMS::$db->queries, 1)."\n\nERRORS:\n".var_export(CMS::$db->errors, 1)."\n</pre>";
			self::$items_amount = $c;
			$pages_amount = ceil($c/self::$pp);

			if ($pages_amount>0) {
				self::$pages_amount = $pages_amount;
				self::$curr_pg = ((self::$curr_pg>self::$pages_amount)? self::$pages_amount: self::$curr_pg);
				$start_from = (self::$curr_pg-1)*self::$pp;

				$photos = CMS::$db->getAll("SELECT f.*, tr.text AS name, cu.name AS author_name
					FROM gallery_photos f
						".implode("\n", $joins)."
					{$where}
					ORDER BY f.ordering ASC
					LIMIT ".(($start_from>0)? ($start_from.', '): '').self::$pp, $params);
				// print "<pre>RESULT:\n".var_export($photos, 1)."\n\nQUERIES:\n".var_export(CMS::$db->queries, 1)."\n\nERRORS:\n".var_export(CMS::$db->errors, 1)."\n</pre>";
			}
		}

		return $photos;
	}

	public static function addPhotos($gallery_id) {
		if (empty($gallery_id)) {return false;} else {$gallery_id = intval($gallery_id);}

		$gallery = self::getGalleryInfo($gallery_id);
		if (empty($gallery['id'])) {return ['success' => false, 'message' => 'gallery_not_found_err'];} // make sure gallery is exists

		foreach (self::$subdirs as $d) utils::dirCreate(self::$dir.'gallery_'.$gallery['id'].'/'.$d.'/'); // make sure all subfolders are exists

		//print "<pre>\n".var_export($_FILES, 1)."\n\n".var_export($_POST, 1)."\n</pre>";
		$photos = $_FILES['photo'];
		$statuses = [];
		$i = 0;
		while ($i<5) {
			if (!empty($photos['name'][$i])) {
				if (empty($photos['error'][$i])) {
					$image = utils::upload($photos['name'][$i], $photos['tmp_name'][$i], self::$dir.'gallery_'.$gallery['id'].'/original/', self::$allowed_ext);
					if (empty($image)) {
						$statuses[$i] = 'upl_invalid_image_extension_err';
					} else {
						// resize thumb image
						$thumb = new SimpleImage(self::$dir.'gallery_'.$gallery['id'].'/original/'.$image);
						$thumb->thumbnail(self::$dimensions['thumb']['width'], self::$dimensions['thumb']['height'])->save(self::$dir.'gallery_'.$gallery['id'].'/thumb/'.$image);

						// resize big image
						$big = new SimpleImage(self::$dir.'gallery_'.$gallery['id'].'/original/'.$image);
						$big->thumbnail(self::$dimensions['big']['width'], self::$dimensions['big']['height'])->save(self::$dir.'gallery_'.$gallery['id'].'/big/'.$image);

						// save
						$max_ordering = CMS::$db->select('MAX(ordering)', 'gallery_photos', "gallery_id='{$gallery['id']}'");
						$data = [
							'gallery_id' => $gallery['id'],
							'image' => $image,
							'ordering' => $max_ordering+1,
							'status' => '1',
							'add_by' => $_SESSION[CMS::$sess_hash]['ses_adm_id'],
							'add_datetime' => date('Y-m-d H:i:s')
						];
						$inserted = CMS::$db->add('gallery_photos', $data);

						if ($inserted) {
							$statuses[$i] = 'insert_suc';

							CMS::log([
								'subj_table' => 'gallery_photos',
								'subj_id' => $inserted,
								'action' => 'add',
								'descr' => 'Gallery photo added to album #'.$gallery['id'].' by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO,
							]);
						} else {
							$statuses[$i] = 'insert_err';
						}
					}
				} else {
					$statuses[$i] = self::$upload_err[$photos['error'][$i]];
				}
			}

			$i++;
		}

		return ['success' => true, 'message' => 'ok', 'data' => $statuses];
	}

	public static function editPhoto($photo_id) {
		$response = ['success' => false, 'message' => 'update_err'];

		if (empty($photo_id)) {return $response;} else {$photo_id = intval($photo_id);}

		$old_data = self::getPhoto($photo_id);
		if (empty($old_data['id'])) {return ['success' => false, 'message' => 'gallery_photo_not_found_err'];} // make sure photo is exists

		$gallery = self::getGalleryInfo($old_data['gallery_id']);
		if (empty($gallery['id'])) {return ['success' => false, 'message' => 'gallery_not_found_err'];} // make sure gallery is exists

		foreach (self::$subdirs as $d) utils::dirCreate(self::$dir.'gallery_'.$gallery['id'].'/'.$d.'/'); // make sure all subfolders are exists

		$photo = [];
		$translates = [];

		// process translates
		$tr_fields = ['name'];
		foreach (CMS::$site_langs as $lng) {
			foreach ($tr_fields as $f) {
				$translates[$lng['language_dir']][$f] = trim(@$_POST[$f][$lng['language_dir']]);
			}
		}

		if (!empty($_FILES['image']['name']) && !empty($_FILES['image']['error'])) {
			$response['errors']['image'] = self::$upload_err[$_FILES['image']['error']];
		} else if (!empty($_FILES['image']['name'])) {
			$image = utils::upload($_FILES['image']['name'], $_FILES['image']['tmp_name'], self::$dir.'gallery_'.$gallery['id'].'/original/', self::$allowed_ext);
			if (empty($image)) {
				$response['errors']['image'] = 'upl_invalid_image_extension_err';
			} else {
				@unlink(self::$dir.'gallery_'.$gallery['id'].'/original/'.$old_data['image']);

				// resize thumb image
				$thumb = new SimpleImage(self::$dir.'gallery_'.$gallery['id'].'/original/'.$image);
				$thumb->thumbnail(self::$dimensions['thumb']['width'], self::$dimensions['thumb']['height'])->save(self::$dir.'gallery_'.$gallery['id'].'/thumb/'.$image);
				@unlink(self::$dir.'gallery_'.$gallery['id'].'/thumb/'.$old_data['image']);

				// resize big image
				$big = new SimpleImage(self::$dir.'gallery_'.$gallery['id'].'/original/'.$image);
				$big->thumbnail(self::$dimensions['big']['width'], self::$dimensions['big']['height'])->save(self::$dir.'gallery_'.$gallery['id'].'/big/'.$image);
				@unlink(self::$dir.'gallery_'.$gallery['id'].'/big/'.$old_data['image']);

				$photo['image'] = $image;
			}
		}

		if (empty($response['errors'])) {
			$photo['status'] = (empty($_POST['status'])? '0': '1');
			$photo['mod_by'] = $_SESSION[CMS::$sess_hash]['ses_adm_id'];
			$photo['mod_datetime'] = date('Y-m-d H:i:s');

			$updated = CMS::$db->mod('gallery_photos#'.$old_data['id'], $photo);

			// saving translates
			foreach ($translates as $lang=>$tr_data) {
				foreach ($tr_data as $fieldname=>$text) {
					tr::store([
						'ref_table' => 'gallery_photos',
						'ref_id' => $photo_id,
						'lang' => $lang,
						'fieldname' => $fieldname,
						'text' => $text,
					]);
				}
			}

			CMS::log([
				'subj_table' => 'gallery_photos',
				'subj_id' => $photo_id,
				'action' => 'edit',
				'descr' => 'Gallery photo of album #'.$gallery['id'].' modified by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO,
			]);

			return ['success' => true, 'message' => 'update_suc'];
		}

		return $response;
	}

	public static function saveGalleryPhotosOrdering($gallery_id, $page_ordering) {
		if (empty($gallery_id)) {return false;} else {$gallery_id = intval($gallery_id);}

		$gallery = self::getGalleryInfo($gallery_id);
		if (empty($gallery['id'])) {return false;}

		if (empty($page_ordering)) {return false;}
		if (!is_array($page_ordering) || !count($page_ordering)) {return false;}

		/*
			сортировка идет по возрастающей
			каждая сортировка затрагивает все фотки этой галереи

			при сохранении сортировки текущей страницы
			находим минимальную сортировку для фоток этой страницы, то есть те фотки сортировка которых меньше находятся на предыдущих страницах
			слачала пересортируем все фотки предыдущих страниц, так мы избавляемся от пробелов из-за удаления и неверно прописанного ордеринга
			потом сохраним сортировку текущей страницы
			и, наконец, пересортируем все оставшиеся фотки. так как мы при каждом сохранении удаляем из массива всех фоток сохранённую фотку, в массиве останутся только те кого мы еще не сохранили
			таким образом у нас грантирована последовательная сортировка и не может быть дублирующихся значений
		*/

		$old_ordering = CMS::$db->getAll("SELECT * FROM gallery_photos WHERE gallery_id='{$gallery['id']}' ORDER BY ordering ASC");

		$indexes = []; // вспомогательный массив с индексами фоток из массива $old_ordering хранящимися под ключом из ID соответствующей фотки. нужен чтоб бысто находить или удалять фотку из массива
		foreach ($old_ordering as $i=>$f) {
			$indexes[$f['id']] = $i;
		}

		$resorted_photos = []; // вспомогательный массив с перечислением всех ID фоток редактируемой страницы
		foreach ($page_ordering as $fid) {
			$fid = intval($fid);
			if ($fid) {$resorted_photos[] = $fid;}
		}

		// минимальный ордеринг фоток с текущей страницы
		$min_ordering = CMS::$db->get("SELECT MIN(ordering) FROM gallery_photos WHERE gallery_id='{$gallery['id']}' AND id IN ('".implode("', '", $resorted_photos)."')");

		// последняя фотка перед первой фоткой с текущей страницы
		$stop_at = CMS::$db->get("SELECT id FROM gallery_photos WHERE gallery_id='{$gallery['id']}' AND ordering<'{$min_ordering}' ORDER BY ordering DESC LIMIT 1");

		$current_ordering = 1;

		// перебираем предыдущие фотки если есть
		if ($stop_at && isset($indexes[$stop_at])) {
			foreach ($old_ordering as $i=>$f) {
				if ($f['ordering']!=$current_ordering) {
					CMS::$db->mod('gallery_photos#'.$f['id'], ['ordering' => $current_ordering]);
				}
				$current_ordering++;
				unset($indexes[$f['id']]); // убираем обработанную фотку из индекса чтобы остались только необработанные
				if ($f['id']==$stop_at) {break;}
			}
		}

		// перебираем фотки текущей страницы
		foreach ($page_ordering as $fid) {
			$f = $old_ordering[$indexes[$fid]];
			if ($f['ordering']!=$current_ordering) {
				CMS::$db->mod('gallery_photos#'.$f['id'], ['ordering' => $current_ordering]);
			}
			$current_ordering++;
			unset($indexes[$f['id']]);
		}

		// перебираем оставшиеся фотки
		if (count($indexes)) {
			foreach ($indexes as $id=>$i) {
				$f = $old_ordering[$i];
				if ($f['ordering']!=$current_ordering) {
					CMS::$db->mod('gallery_photos#'.$f['id'], ['ordering' => $current_ordering]);
				}
				$current_ordering++;
			}
		}

		return true;
	}

	public static function setPhotoStatus($photo_id, $status) {
		if (empty($photo_id)) {return false;} else {$photo_id = intval($photo_id);}
		$status = (empty($status)? '0': '1');

		$updated = CMS::$db->mod('gallery_photos#'.$photo_id, ['status' => $status]);

		if ($updated) {
			CMS::log([
				'subj_table' => 'gallery_photos',
				'subj_id' => $photo_id,
				'action' => 'edit',
				'descr' => 'Gallery photo of album #'.CMS::$db->select('gallery_id', 'gallery_photos', "id='".$photo_id."'").' modified by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO,
			]);
		}

		return $updated;
	}

	public static function deletePhoto($photo_id) {
		if (empty($photo_id)) {return false;} else {$photo_id = intval($photo_id);}

		$photo = CMS::$db->getRow("SELECT * FROM gallery_photos WHERE id='{$photo_id}' LIMIT 1");
		if (empty($photo['id'])) {return false;}

		foreach (self::$subdirs as $d) @unlink(self::$dir.'gallery_'.$photo['gallery_id'].'/'.$d.'/'.$photo['image']);

		$deleted = CMS::$db->exec("DELETE FROM gallery_photos WHERE id='{$photo_id}'");
		CMS::$db->exec("OPTIMIZE TABLE gallery_photos");

		tr::del('gallery_photos', $photo_id);

		if ($deleted) {
			CMS::log([
				'subj_table' => 'gallery_photos',
				'subj_id' => $photo_id,
				'action' => 'erase',
				'descr' => 'Gallery photo of album #'.$photo['gallery_id'].' erased by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO,
			]);
		}

		return $deleted;
	}
}

?>