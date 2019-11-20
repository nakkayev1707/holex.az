<?php


namespace app\models;
use Yii;

class Service
{
    private $serviceTable = 'services';
    private $serviceTypeTable = 'services_types';
    private $translateFields = ['title', 'full'];

    /**
     * @param $amount - set 0 for getting all
     * @return array of service types
     */
    public function getServiceTypes($amount){
        $types = [];
        return $types;
    }

    public function getServices($amount = 0){
        $where = [];
        $joins = [];
        $params = [];
        $columns = [];

        $columns[] = 's.image';
        $columns[] = 's.id';
        // translating //
        foreach ($this->translateFields as $field){
            $joins[] = "
                LEFT JOIN translates $field ON
                    $field.ref_table=:table AND
                    $field.ref_id=s.id AND
                    $field.lang=:lang AND
                    $field.fieldname='$field'";
            $columns[] = "$field.text AS $field";
        }

        $where = (empty($where) ? '' : (' WHERE ' . implode(" AND ", $where)));
        $joins = implode("\n", $joins);
        $columns = implode(", ", $columns);

        $params[":lang"] = Yii::$app->language;
        $params[":table"] = $this->serviceTable;
        $amount <= 0 ? $limit = "" : $limit = " LIMIT " . (int)$amount;

        $sqlGetList = "SELECT $columns FROM " . $this->serviceTable . " s $joins $where $limit";
        $services = Yii::$app->db->createCommand($sqlGetList, $params)->queryAll();
        return $services;
    }

    public function getOne($id){
        $sqlQuery ="
            SELECT s.*, title.text AS title, full.text as full
                FROM $this->serviceTable s
                JOIN translates title
                  ON title.ref_id=s.id AND 
                     title.ref_table=:tablename AND 
                     title.lang=:lang AND 
                     title.fieldname='title'
                JOIN translates full
                  ON full.ref_id=s.id AND 
                     full.ref_table=:tablename AND 
                     full.lang=:lang AND 
                     full.fieldname='full'
                WHERE 
                    s.id=:id
                    LIMIT 1
        ";
        $command = Yii::$app->db->createCommand($sqlQuery);
        $command->bindParam(':lang', Yii::$app->language);
        $command->bindParam(':tablename', $this->serviceTable);
        $command->bindParam(':id', $id);
        $command->bindParam(':service_id', $id);
        $view = $command->queryOne();
        return $view;
    }

}