<?php

namespace app\models;

use Yii;
use yii\db\Exception;

class User
{
    private $table = 'site_users';

    public function getBlockedIpList()
    {
        $sql = 'SELECT u.ip_address FROM ' . $this->table . " u WHERE u.is_blocked = '1'";
        $ipList = [];
        try {
            $ipList = Yii::$app->db->createCommand($sql)->queryAll();
            return $ipList;
        }  catch (Exception $e) {
            return $ipList;
        }
    }

    public function ipIsBlocked($ip)
    {
        if (is_null($ip)) return false;
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            $blockedIpList = $this->getBlockedIpList();
            foreach ($blockedIpList as $key => $blockedIp) {
                return ($blockedIp['ip_address'] == $ip);
            }
        }
        return false;
    }

    public function saveUser($userData){
        $params = [
            ':fio' => $userData['fio'],
            ':email' => $userData['email'],
            ':phone' => $userData['phone'],
            ':ip_address' => $userData['ip_address'],
            ':request_date' => $userData['request_date'],
            ':title' => $userData['title'],
            ':text' => $userData['text']
        ];
        $sql = "INSERT INTO " .$this->table. " VALUES (NULL, :fio, :email, :phone, :ip_address, '0', :request_date, :title, :text)";
        return Yii::$app->db->createCommand($sql, $params)->execute();
    }


}
