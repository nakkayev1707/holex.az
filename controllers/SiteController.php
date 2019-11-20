<?php

namespace app\controllers;

use app\models\Publication;
use app\models\Service;
use Yii;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends BaseController
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
        // models //
        $aphorismModel = new Publication('aphorism');
        $newsModel = new Publication('news');
        $contactModel = new ContactForm();
        // data //
        $aphorisms = [];
        $news = [];
        $errors = [];
        try {
            $aphorisms = $aphorismModel->getPublications(4, '', 'DESC');
            $news = $newsModel->getPublications(3, '', 'DESC');
        } catch (Exception $e) {
            $this->render('index');
        }

        // contact form handle
        if (Yii::$app->request->isPost) {
            if ($contactModel->load(Yii::$app->request->post(), '')) {
                if ($contactModel->validate() && $contactModel->contact(Yii::$app->params['adminEmail'])) {
                    Yii::$app->session->setFlash('contactFormSubmitted');
                    return $this->refresh();
                } else {
                    $errors = $contactModel->errors;
                    Yii::$app->session->setFlash('contactFormNotSubmitted');
                }
            }
        }

        return $this->render('index', [
            'aphorisms' => $aphorisms,
            'news' => $news,
            'model' => $contactModel,
            'errors' => $errors
        ]);
    }


    public function actionMedia(){
        $mediaModel = new Publication('media');
        try {
            $mediaList = $mediaModel->getPublications(0, '', '');
        } catch (Exception $e) {
            $mediaList = [];
        }
        return $this->render('media', [
            'media' => $mediaList
        ]);
    }

    public function actionContact()
    {
        $contactModel = new ContactForm();
        $errors = [];
        if ($contactModel->load(Yii::$app->request->post(), '')) {
            if ($contactModel->validate() && $contactModel->contact(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('contactFormSubmitted');
                return $this->refresh();
            } else {
                $errors = $contactModel->errors;
                Yii::$app->session->setFlash('contactFormNotSubmitted');
            }
        }
        return $this->render('contact', [
            'errors' => $errors,
            'model' => $contactModel,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionError()
    {
        return $this->render('error');
    }

    public function actionUnderconstruction()
    {
        return $this->render('underconstruction');
    }
}
