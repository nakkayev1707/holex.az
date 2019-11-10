<?php


namespace app\models;

use Yii;
use yii\data\Pagination;
use yii\db\Exception;

class Publication
{
    public $table = 'publications';
    public $type = '';
    public $currentPage = 0;
    public $pagesAmount = 0;
    public $itemsAmount = 0;
    public $perPage = 10;
    public $translateFields = ['title', 'full'];

    public function __construct($type)
    {
        $this->type = $type;
    }


    public function getPublications()
    {
        $request = Yii::$app->request;
        $searchQuery = $request->get("q");

        $where = [];
        $joins = [];
        $params = [];
        $columns = [];

        // only visible ones //
        $where[] = 'p.is_hidden = 0';
        $where[] = 'p.type=:type';

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

        // get count
        $sqlCount = "SELECT $columns FROM " . $this->table . " p $joins $where ";
        try {
            $count = Yii::$app->db->createCommand($sqlCount, $params)->queryAll();
        } catch (Exception $e) {
            return [];
        }
        $this->itemsAmount = $count;
        $pagesAmount = ceil($count / $this->perPage);
        $this->pagesAmount = $pagesAmount;
        $this->currentPage = (($this->currentPage > $this->pagesAmount) ? $this->pagesAmount : $this->currentPage);
        $startFrom = ($this->currentPage - 1) * $this->perPage;
        $limit = "LIMIT " . (($startFrom > 0) ? ($startFrom . ', ') : '') . $this->perPage;

        $sqlQetList = "SELECT $columns FROM " . $this->table . " p $joins $where $limit";
        try {
            $publications = Yii::$app->db->createCommand($sqlQetList, $params)->queryAll();
        } catch (Exception $e) {
            return [];
        }
        $pagination = new Pagination([
            'totalCount' => $this->itemsAmount,
            'pageSize' => $this->perPage
        ]);
        $result['publications'] = $publications;
        $result['pagination'] = $pagination;
        return $result;
    }


}