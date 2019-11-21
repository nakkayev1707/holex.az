<?php


namespace app\controllers;

use app\models\Service;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class BaseController extends Controller
{
    public function beforeAction($action)
    {
//        $userModel = new User();
//        $userIp = Yii::$app->request->getUserIP();
//        if (!$userModel->ipIsBlocked($userIp)) {
//            if (Yii::$app->language == 'ru') {
//                return $this->redirect('site/underconstruction');
//            }
//            $serviceModel = new Service();
//            $lastFourServiceType = $serviceModel->getServiceTypes(4);
//            Yii::$app->view->params['lastFourServiceType'] = $lastFourServiceType;
//        } else {
//            return $this->redirect('site/error');
//        }
        if (Yii::$app->language == 'ru') {
            return $this->redirect('site/underconstruction');
        }
        $serviceModel = new Service();
        $services = $serviceModel->getServices(5, 'DESC');
        Yii::$app->view->params['services'] = $services;
        try {
            return parent::beforeAction($action);
        } catch (BadRequestHttpException $e) {
            die("Something went wrong. Bad request!");
        }
    }

}