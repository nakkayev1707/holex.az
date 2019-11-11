<?php


namespace app\models;

use profit_az\profit_cms\CMS;
use profit_az\profit_cms\helpers\utils;

class images
{
    public $table = '';
    public $fields = [];
    public $upload_dir = '';
    public static $allowed_ext = ['jpg', 'jpeg', 'png', 'bmp', 'gif'];

    /**
     * @param $table - table in which data will be added
     * @param $upload_dir - upload directory
     * @param $fields - fields in selected table where will be saved data
     */
    public function __construct($table, $fields, $upload_dir)
    {
        $this->table = $table;
        $this->fields = $fields;
        $this->upload_dir = $upload_dir;
    }


    public function addImages($images, $refId)
    {
        $total = count($images['name']);
        $saved = 0;
        for ($i = 0; $i < $total; $i++) {
            $image['image'] = utils::upload($images['name'][$i], $images['tmp_name'][$i], UPLOADS_DIR . $this->upload_dir . '/', self::$allowed_ext);
            if (!empty($image['image'])) {
                $data = [
                    $this->fields[1] => $refId,
                    $this->fields[2] => $image['image'],
                ];
                if (CMS::$db->add($this->table, $data)) {
                    $saved++;
                }
            }
        }
        return ($total == $saved);
    }

    public function getImagesById($id, $ref_field){
        $id = (int) $id;
        if (!is_int($id) || $id < 0) return [];
        $sql = "SELECT * FROM " . $this->table . " WHERE " . $ref_field . " =:ref_id ";
        return CMS::$db->getAll($sql, [
            ':ref_id' => $id
        ]);
    }

    public function getImageById($id){
        $id = (int) $id;
        $sql = "SELECT * FROM " . $this->table . " WHERE  id=:id";
        return CMS::$db->getRow($sql, [
            ':id' => $id
        ]);
    }

    public function deleteImageById($id, $ref_field){
        $result = false;
        $image = $this->getImageById($id);
        $sql = "DELETE FROM " . $this->table . " WHERE id=:id";
        $deleted = CMS::$db->exec($sql, [
            ':id' => (int)$id
        ]);
        if ($deleted) {
            $path = UPLOADS_DIR.$this->upload_dir;
            if (is_writable($path)) {
                $imagePath = $path.'/'.$image['image'];
                if (file_exists($imagePath)) {
                    @unlink($imagePath);
                }
                $result = true;
            }
        }
        return $result;
    }

    public function deleteImages($id, $ref_field){
        $result = false;
        $images = $this->getImagesById($id, $ref_field);
        if (!empty($images)) {
            $sql = "DELETE FROM " . $this->table . " WHERE " . $ref_field. "=:id";
            $deletedRow = CMS::$db->exec($sql, [
                ":id" => $id
            ]);
            if ($deletedRow) {
                if (empty($images)) return true;
                $dirPath = '../uploads/' . $this->upload_dir;
                if (is_writable($dirPath)) {
                    foreach ($images as $image) {
                        $imagePath = '../uploads/' . $this->upload_dir . '/' . $image['image'];
                        if (file_exists($imagePath)) {
                            @unlink($imagePath);
                        }
                    }
                    $result = true;
                }
            }
        } else {
            $result = true;
        }
        return $result;
    }
}