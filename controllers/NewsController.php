<?php


namespace app\controllers;


use app\models\Publication;
use yii\db\Exception;
use Yii;
use yii\web\NotFoundHttpException;

class NewsController extends BaseController
{
    public function actionIndex(){
        $newsModel = new Publication('news');
        $searchQuery = Yii::$app->request->get('q');
        $newsList = [];
        $lastFiveNews = [];
        try {
            $newsList = $newsModel->getPublications(-1, $searchQuery, 'DESC');
            $lastFiveNews = $newsModel->getPublications(4, '', 'DESC');
        } catch (Exception $e) {
            $this->render('index');
        }
        return $this->render('news', [
            'newsList' => $newsList,
            'lastFiveNews' => $lastFiveNews,
            'currentPage' => $newsModel->currentPage,
            'pagesAmount' => $newsModel->pagesAmount
        ]);
    }

    public function actionView($id)
    {
        $newsModel = new Publication('news');
        $view = $newsModel->getOne($id);
        $lastFiveNews = [];
        try {
            $lastFiveNews = $newsModel->getPublications(4, '', 'DESC');
        } catch (Exception $e) {}
        if (!$view) {
            throw new NotFoundHttpException();
        }
        if (!isset($_COOKIE["publication_view_$id"])) {
            setcookie(
                "publication_view_$id",
                1,
                time() + (3600 * 4)
            );
        }
        return $this->render('view', [
            'view' => $view,
            'lastFiveNews' => $lastFiveNews
        ]);
    }

}