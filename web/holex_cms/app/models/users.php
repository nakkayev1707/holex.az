<?php


namespace app\models;


use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;

class users {
    public $curr_page = 1;
    public $per_page = 10;
    public $pages_amount = 0;
    public $items_amount = 0;
    public $table = 'site_users';

    public function getUsersList(){
        $users_list = [];
        $joins = [];
        $filter = [];
        $where = (empty($filter) ? '' : (' WHERE ' . implode(" AND ", $filter)));
        $sqlCount = "SELECT COUNT(u.id) FROM `" . $this->table . "` u " . implode("\n", $joins) . "{$where}";
        $c = CMS::$db->get($sqlCount);
        $this->items_amount = $c;
        $pages_amount = ceil($c / $this->per_page);
        if ($pages_amount > 0) {
            $this->pages_amount = $pages_amount;
            $this->curr_page = (($this->curr_page > $this->pages_amount) ? $this->pages_amount : $this->curr_page);
            $start_from = ($this->curr_page - 1) * $this->per_page;

            $sqlGetUsers = "SELECT u.* FROM `" . $this->table . "` u " . implode("\n", $joins) . " {$where} ORDER BY id DESC LIMIT "
                . (($start_from > 0) ? ($start_from . ', ') : '') . $this->per_page;
            $users_list = CMS::$db->getAll($sqlGetUsers);
        }
        return $users_list;
    }

    public function deleteUser($user_id) {
        $user_id = (int)$user_id;
        $deleted = CMS::$db->exec('DELETE FROM `'.$this->table.'` WHERE `id`=:id', [':id' => $user_id]);
        if ($deleted) {
            CMS::$db->exec('OPTIMIZE TABLE `'.$this->table.'`, `comments`');
            CMS::log([
                'subj_table' => $this->table,
                'subj_id' => $user_id,
                'action' => 'erase',
                'descr' => 'Site user erased by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO,
            ]);
        }
        return $deleted;
    }

    public function getUser($user_id) { // 2016-06-10
        return CMS::$db->getRow('SELECT * FROM `'.$this->table.'` WHERE id=:id LIMIT 1', [':id' => $user_id]);
    }

    public function setUserStatus($id, $status) { // 2016-11-16
        $updated = CMS::$db->mod($this->table.'#'.(int)$id, [
            'is_blocked' => (($status=='on')? '0': '1')
        ]);

        if ($updated) {
            CMS::log([
                'subj_table' => $this->table,
                'subj_id' => (int)$id,
                'action' => 'edit',
                'descr' => 'Site user '.(($status=='on')? 'un': '').'blocked by '.$_SESSION[CMS::$sess_hash]['ses_adm_type'].' '.ADMIN_INFO,
            ]);
        }

        return $updated;
    }

}