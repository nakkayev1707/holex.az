<?php


namespace app\controllers;


use app\models\Publication;
use yii\db\Exception;
use Yii;
use yii\web\NotFoundHttpException;

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

    public function actionView($id)
    {
        $blogModel = new Publication('blog');
        $view = $blogModel->getOne($id);
        $lastFiveBlog = [];
        try {
            $lastFiveBlog = $blogModel->getPublications(4, '', 'DESC');
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
            'lastFiveBlog' => $lastFiveBlog
        ]);
    }

}