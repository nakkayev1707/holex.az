<?php


namespace app\models;

use Yii;
use yii\data\Pagination;
use yii\db\Exception;

class Publication
{
    public $table = 'publications';
    public $type = '';
    public $currentPage = 1;
    public $pagesAmount = 1;
    public $itemsAmount = 0;
    public $perPage = 10;
    public $translateFields = ['title', 'full'];

    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * @param int $amount, if value less or equal zero, get depends on pagination
     * @param string $searchQuery
     * @param string $order , values 'DESC' or 'ASC'
     * @return array of publications
     * @throws Exception
     */
    public function getPublications($amount = 0, $searchQuery = '', $order = '')
    {
        $where = [];
        $joins = [];
        $params = [];
        $columns = [];

        // only visible ones //
        $where[] = "p.is_hidden = '0'";
        $where[] = 'p.type=:type';
        $joins[] = " LEFT JOIN publications_images p_img ON p_img.publication_id=p.id ";
        $columns[] = "p_img.image";
        $columns[] = "p.id";
        $columns[] = "p.created_at";
        // search //
        if ($searchQuery) {
            $where[] = "(title.text LIKE :query)";
        }
        // translating //
        foreach ($this->translateFields as $field){
            $joins[] = "
                LEFT JOIN translates $field ON
                    $field.ref_table=:table AND
                    $field.ref_id=p.id AND
                    $field.lang=:lang AND
                    $field.fieldname='$field'";
            $columns[] = "$field.text AS $field";
        }

        $where = (empty($where) ? '' : (' WHERE ' . implode(" AND ", $where)));
        $joins = implode("\n", $joins);
        $columns = implode(", ", $columns);

        $params[":lang"] = Yii::$app->language;
        $params[":table"] = $this->table;
        $searchQuery = "%$searchQuery%";
        $params[":query"] = $searchQuery;
        $params[":type"] = $this->type;

        // get count && pagination //
        $page = intval(Yii::$app->request->getQueryParam('page'));
        if ($page <= 0) $page = 1;
        $this->currentPage = $page;
        $sqlCount = "SELECT COUNT('p.id') AS count FROM " . $this->table . " p $joins $where ";
        $count = Yii::$app->db->createCommand($sqlCount, $params)->queryOne();
        $this->itemsAmount = $count['count'];
        $pagesAmount = ceil($this->itemsAmount / $this->perPage);
        $this->pagesAmount = $pagesAmount;
//        $this->currentPage = (($this->currentPage > $this->pagesAmount) ? $this->pagesAmount : $this->currentPage);
        $startFrom = ($this->currentPage - 1) * $this->perPage;
        // limit //
        if ($amount > 0 && $amount < 9999999999) {
            $limit = "LIMIT " . $amount;
        } else {
            $limit = "LIMIT " . (($startFrom > 0) ? ($startFrom . ', ') : '') . $this->perPage;
        }
        // order //
        ($order && ($order == 'DESC' || $order == 'ASC')) ? $order = "ORDER BY p.id $order" : $order = "";
        $sqlGetList = "SELECT $columns FROM " . $this->table . " p $joins $where $order $limit ";
        // result //
        $publications = Yii::$app->db->createCommand($sqlGetList, $params)->queryAll();
        return $publications;
    }

    public function getOne($id){
        $sqlQuery ="
            SELECT p.*, pi.image, title.text AS title, full.text as full
                FROM publications p
                JOIN translates title
                  ON title.ref_id=p.id AND 
                     title.ref_table=:tablename AND 
                     title.lang=:lang AND 
                     title.fieldname='title'
                JOIN translates full
                  ON full.ref_id=p.id AND 
                     full.ref_table=:tablename AND 
                     full.lang=:lang AND 
                     full.fieldname='full'
                LEFT JOIN publications_images pi 
                  ON publication_id=:id
                WHERE 
                    p.id=:id AND 
                    type=:type AND 
                    is_hidden='0'
                    LIMIT 1
        ";
        $command = Yii::$app->db->createCommand($sqlQuery);
        $command->bindParam(':lang', Yii::$app->language);
        $command->bindParam(':tablename', $this->table);
        $command->bindParam(':type', $this->type);
        $command->bindParam(':id', $id);
        $command->bindParam(':publication_id', $id);
        $view = $command->queryOne();
        return $view;
    }



}