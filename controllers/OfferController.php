<?php


namespace app\controllers;


use app\models\Publication;
use yii\db\Exception;
use yii\web\NotFoundHttpException;
use Yii;

class OfferController extends BaseController
{
    public function actionIndex(){
        $offersModel = new Publication('corporate_offer');
        $searchQuery = Yii::$app->request->get('q');
        $offersList = [];
        try {
            $offersList = $offersModel->getPublications(-1, $searchQuery, 'DESC');
//            $lastFiveNews = $newsModel->getPublications(4, '', 'DESC');
        } catch (Exception $e) {
            $this->render('index');
        }
        return $this->render('corporate_offer', [
            'offersList' => $offersList,
            'currentPage' => $offersModel->currentPage,
            'pagesAmount' => $offersModel->pagesAmount
        ]);
    }

    public function actionView($id)
    {
        $offersModel = new Publication('corporate_offer');
        $view = $offersModel->getOne($id);
        if (!isset($_COOKIE["publication_view_$id"])) {
            setcookie(
                "publication_view_$id",
                1,
                time() + (3600 * 4)
            );
        }
        return $this->render('view', [
            'view' => $view,
        ]);
    }

}