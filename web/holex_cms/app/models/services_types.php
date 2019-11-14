<?php


namespace app\models;


use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\tr;
use profit_az\profit_cms\helpers\utils;

class services_types {

    public $curr_page = 1;
    public $per_page = 20;
    public $pages_amount = 0;
    public $items_amount = 0;
    public $table = 'service_types';
    public $tr_fields = ['title', 'full'];

    public function getTypesList(){
        $servicesTypesList = [];
        $joins = [];
        $joins['tr'] = "LEFT JOIN translates tr ON tr.ref_table='" . $this->table . "' AND tr.ref_id=s.id AND tr.lang=:default_site_lang AND tr.fieldname='title'";
        $filter = [];

        // search //
        if (!empty($_GET['q'])) {
            $filter[] = "tr.text LIKE '%" . utils::makeSearchable($_GET['q']) . "%'";
        }

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

            $servicesTypesList = CMS::$db->getAll($sqlGetServices, [
                ':default_site_lang' => CMS::$default_site_lang
            ]);
        }
        return $servicesTypesList;
    }

    public function addType(){
        $response = ['success' => false, 'message' => 'insert_err'];
        $service = ['id' => ''];

        $translates = [];
        // processing translates
        foreach (CMS::$site_langs as $lng) {
            foreach ($this->tr_fields as $f) {
                if (in_array($f, ['title', 'full'])) {
                    $translates[$lng['language_dir']][$f] = trim(@$_POST[$f][$lng['language_dir']]);
                }
            }
        }
        // saving service type//
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

    public function editType($id){
        $response = ['success' => false, 'message' => 'update_err'];
        $translates = [];

        // processing translates
        foreach (CMS::$site_langs as $lng) {
            foreach ($this->tr_fields as $f) {
                if (in_array($f, ['title', 'full'])) {
                    $translates[$lng['language_dir']][$f] = trim(@$_POST[$f][$lng['language_dir']]);
                }
            }
        }
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

    public function deleteType($id){
        $sqlTypeDelete = "DELETE FROM " . $this->table . " WHERE id=:id";
        $typeDeleted = CMS::$db->exec($sqlTypeDelete, [
            ':id' => (int)$id
        ]);
        return $typeDeleted;
    }

    public function getTypeById($id){
        $id = (int)$id;
        $sql = "SELECT id FROM " . $this->table ." WHERE id=:type_id LIMIT 1";
        $type = CMS::$db->getRow($sql, [
            ':type_id' => $id
        ]);
        if (!empty($type['id']))  {$type['translates'] = tr::get($this->table, $id);}
        return $type;
    }



}