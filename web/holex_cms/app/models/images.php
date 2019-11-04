<?php


namespace app\models;


class images {
    public $table = '';

    public function __construct($table) {
        $this->table = $table;
    }

    public function addImages($images, $refId){
        return false;
    }
}