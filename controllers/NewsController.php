<?php


namespace app\controllers;


use app\models\Publication;
use yii\db\Exception;
use Yii;

class NewsController extends BaseController
{
    public function actionIndex(){
        $publicationModel = new Publication('news');
        $searchQuery = Yii::$app->request->get('q');
        $newsList = [];
        try {
            $newsList = $publicationModel->getPublications(-1, $searchQuery, 'DESC');
        } catch (Exception $e) {
            $this->render('index');
        }
        return $this->render('news', [
            'blogList' => $newsList
        ]);
    }

}