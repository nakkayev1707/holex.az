<?php

namespace app\controllers;

use app\models\ContactForm;
use app\models\LoginForm;
use app\models\Publication;
use app\models\Service;
use Yii;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

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
        $aboutModel = new Publication('about_info');
        $newsModel = new Publication('news');
        $ecoBagsModel = new Publication('eco_bag');
        $corporateOffersModel = new Publication('corporate_offer');
        $giftCardModel = new Publication('gift_card');
        $contactModel = new ContactForm();
        $serviceModel = new Service();
        // data //
        $errors = [];
        try {
            $aphorisms = $aphorismModel->getPublications(4, '', 'DESC');
            $aboutInfo = $aboutModel->getPublications(1, '', 'DESC');
            $news = $newsModel->getPublications(3, '', 'DESC');
            $corporateOffers = $corporateOffersModel->getPublications(10, '', 'DESC');
            $giftCards = $giftCardModel->getPublications(10, '', 'DESC');
            $sixService = $serviceModel->getServices(6);
            $ecoBags = $ecoBagsModel->getPublications();
        } catch (Exception $e) {
            $aphorisms = [];
            $news = [];
            $sixService = [];
            $aboutInfo = [];
            $ecoBags = [];
            $corporateOffers = [];
            $giftCards = [];
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
            'aboutInfo' => $aboutInfo,
            'news' => $news,
            'model' => $contactModel,
            'sixService' => $sixService,
            'ecoBags' => $ecoBags,
            'offers' => $corporateOffers,
            'giftCards' => $giftCards,
            'errors' => $errors
        ]);
    }


    public function actionMedia()
    {
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
        $aboutModel = new Publication('about_info');
        try {
            $aboutInformation = $aboutModel->getPublications(1, '', 'DESC');
        } catch (Exception $e) {
            $aboutInformation = [];
        }
        return $this->render('about', [
            'aboutInfo' => $aboutInformation
        ]);
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
