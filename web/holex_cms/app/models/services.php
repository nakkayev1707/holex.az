<?php


namespace app\models;


use abeautifulsite\simple_image\SimpleImage;
use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\tr;
use profit_az\profit_cms\helpers\utils;

class services
{
    public $curr_page = 1;
    public $per_page = 20;
    public $pages_amount = 0;
    public $items_amount = 0;
    public $table = 'services';
    public $tr_fields = ['title', 'full'];

    public function getServicesList()
    {
        $servicesList = [];
        $joins = [];
        $joins['tr'] = "LEFT JOIN translates tr ON tr.ref_table='" . $this->table . "' AND tr.ref_id=s.id AND tr.lang=:default_site_lang AND tr.fieldname='title'";
        $filter = [];

        // search //
        if (!empty($_GET['q'])) {
            $filter[] = "tr.text LIKE '%" . utils::makeSearchable($_GET['q']) . "%'";
        }
        // start filter //
        if (!empty($_GET['filter']['type'])) {
            $filter[] = " s.type_id=" . CMS::$db->escape($_GET['filter']['type'] . "");
        }
        // end filter //
        $where = (empty($filter) ? '' : (' WHERE ' . implode(" AND ", $filter)));
        $sqlCount = "SELECT COUNT(s.id) FROM `" . $this->table . "` s " . implode("\n", $joins) . "{$where}";
        $c = CMS::$db->get($sqlCount, [
            ':default_site_lang' => CMS::$default_site_lang
        ]);

        $this->items_amount = $c;
        $pages_amount = ceil($c / $this->per_page);
        if ($pages_amount > 0) {
            $this->pages_amount = $pages_amount;
            $this->curr_page = (($this->curr_page > $this->pages_amount) ? $this->pages_amount : $this->curr_page);
            $start_from = ($this->curr_page - 1) * $this->per_page;

            $sqlGetServices = "SELECT s.*, tr.text AS title FROM `" . $this->table . "` s " . implode("\n", $joins) . "
				{$where} ORDER BY id DESC
				LIMIT " . (($start_from > 0) ? ($start_from . ', ') : '') . $this->per_page;

            $servicesList = CMS::$db->getAll($sqlGetServices, [
                ':default_site_lang' => CMS::$default_site_lang
            ]);
        }
        return $servicesList;
    }


    public function addService()
    {
        $response = ['success' => false, 'message' => 'insert_err'];
        if (!$this->validate(@$_POST)) {
            $response['message'] = 'validate_err';
            return $response;
        }
        $service = [
            'type_id' => $_POST['type']
        ];
        $translates = [];
        // processing translates
        foreach (CMS::$site_langs as $lng) {
            foreach ($this->tr_fields as $f) {
                if (in_array($f, ['title', 'full'])) {
                    $translates[$lng['language_dir']][$f] = trim(@$_POST[$f][$lng['language_dir']]);
                }
            }
        }
        // saving images
        if (!empty($_FILES['img']['name'])) {
            if (empty($_FILES['img']['error'])) {
                $service['image'] = utils::upload($_FILES['img']['name'], $_FILES['img']['tmp_name'], UPLOADS_DIR.'services/', images::$allowed_ext);
                if (empty($service['image'])) {
                    $response['errors'][] = 'upl_invalid_image_extension_err';
                } else {
                    @mkdir(UPLOADS_DIR.'services/', 0777, true);
                    $img = new SimpleImage(UPLOADS_DIR.'services/'.$service['image']);
                }
            } else {
                $response['errors'][] = CMS::$upload_err[$_FILES['img']['error']];
            }
        }
        // saving service //
        $ins_id = CMS::$db->add($this->table, $service);
        if ($ins_id) {
            $response['success'] = true;
            $response['message'] = 'insert_suc';
        }
        // saving translates
        foreach ($translates as $lang => $tr_data) {
            foreach ($tr_data as $fieldname => $text) {
                tr::store([
                    'ref_table' => $this->table,
                    'ref_id' => $ins_id,
                    'lang' => $lang,
                    'fieldname' => $fieldname,
                    'text' => $text,
                ]);
            }
        }
        return $response;
    }

    public function editService($id){
        $response = ['success' => false, 'message' => 'update_err'];
        $service = $this->getServiceById($id);
        $upd = [];
        $translates = [];

        if (!empty($_FILES['img']['name'])) {
            if (empty($_FILES['img']['error'])) {
                $uploaded = utils::upload($_FILES['img']['name'], $_FILES['img']['tmp_name'], UPLOADS_DIR.'services/', images::$allowed_ext);
                if (empty($uploaded)) {
                    $response['errors'][] = 'upl_invalid_image_extension_err';
                } else {
                    $upd['image'] = $uploaded;
                    @unlink(UPLOADS_DIR.'services/'.$service['image']);
                }
            } else {
                $response['errors'] = "file_upload_err";
            }
        }


        // processing translates
        foreach (CMS::$site_langs as $lng) {
            foreach ($this->tr_fields as $f) {
                if (in_array($f, ['title', 'full'])) {
                    $translates[$lng['language_dir']][$f] = trim(@$_POST[$f][$lng['language_dir']]);
                }
            }
        }
        $upd['type'] = $_POST['type'];

        CMS::$db->mod($this->table . '#' . (int)$id, $upd);
        // saving translates
        foreach ($translates as $lang => $tr_data) {
            foreach ($tr_data as $fieldname => $text) {
                tr::store([
                    'ref_table' => $this->table,
                    'ref_id' => $id,
                    'lang' => $lang,
                    'fieldname' => $fieldname,
                    'text' => $text,
                ]);
            }
        }
        $response['success'] = true;
        $response['message'] = 'update_suc';

        return $response;
    }

    public function getServiceById($id){
        $id = (int)$id;
        $sql = "SELECT * FROM " . $this->table ." WHERE id=:service_id LIMIT 1";
        $service = CMS::$db->getRow($sql, [
            ':service_id' => $id
        ]);
        if (!empty($service['id']))  {$service['translates'] = tr::get($this->table, $id);}
        return $service;
    }

    public function deleteService($id){
        $sqlServiceDelete = "DELETE FROM " . $this->table . " WHERE id=:id";
        $service = $this->getServiceById((int)$id);
        $serviceDeleted = CMS::$db->exec($sqlServiceDelete, [
            ':id' => (int)$id
        ]);
        if ($serviceDeleted && $service['id']) {
            if (tr::del($this->table, (int)$id)) {
                @unlink(UPLOADS_DIR.'services/'.$service['image']);
                return true;
            }
        }
        return false;
    }


    private function validate($post)
    {
        if (empty($post['CSRF_token']) || empty($post['type']) || (empty($post['title']['az'])
                || empty($post['title']['en'])) || (empty($post['full']['az']) || empty($post['full']['en']))) {
            return false;
        }
        return true;
    }

}