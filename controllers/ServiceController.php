<?php


namespace app\controllers;


use app\models\ContactForm;
use app\models\Publication;
use app\models\Service;
use Yii;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class ServiceController extends BaseController
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
        $serviceModel = new Service();
        $serviceList = [];
        try {
            $serviceList = $serviceModel->getServices();
        } catch (Exception $e) {
            $this->render('index');
        }
        return $this->render('index', [
            'services' => $serviceList,
        ]);
    }

    public function actionView($id)
    {
        $serviceModel = new Service();
        $serviceList = $serviceModel->getServices();
        $view = $serviceModel->getOne($id);
        if (!$view) {
            throw new NotFoundHttpException();
        }
        return $this->render('view', [
            'view' => $view,
            'services' => $serviceList
        ]);
    }

    public function actionContact()
    {
        $contactModel = new ContactForm();
        $serviceModel = new Service();
        $errors = [];
        $serviceList = [];
        try {
            $serviceList = $serviceModel->getServices();
        } catch (Exception $e) {
            throw new NotFoundHttpException();
        }
        if ($contactModel->load(Yii::$app->request->post(), '')) {
            if ($contactModel->validate() && $contactModel->contact(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('contactFormSubmitted');
                return $this->refresh();
            } else {
                $errors = $contactModel->errors;
                Yii::$app->session->setFlash('contactFormNotSubmitted');
            }
        }
        return $this->render('index', [
            'errors' => $errors,
            'model' => $contactModel,
            'services' => $serviceList,
        ]);
    }
}