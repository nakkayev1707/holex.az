<?php


namespace app\controllers;


use app\models\Publication;
use yii\db\Exception;
use Yii;

class BlogController extends BaseController
{
    public function actionIndex()
    {
        $blogModel = new Publication('blog');
        $searchQuery = Yii::$app->request->get('q');
        $blogList = [];
        $lastFiveBlog = [];
        try {
            $blogList = $blogModel->getPublications( 0, $searchQuery, 'DESC');
            $lastFiveBlog = $blogModel->getPublications(4, '', 'DESC');
        } catch (Exception $e) {
            $this->render('index');
        }
        return $this->render('blog', [
            'blogList' => $blogList,
            'lastFiveBlog' => $lastFiveBlog
        ]);
    }

}