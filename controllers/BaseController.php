<?php


namespace app\controllers;


use app\models\Service;
use app\models\User;
use yii\web\Controller;
use Yii;

class BaseController extends Controller
{
    public function beforeAction($action)
    {
        $userModel = new User();
        $userIp = Yii::$app->request->getUserIP();
        if (!$userModel->ipIsBlocked($userIp)) {
            if (Yii::$app->language == 'ru') {
                return $this->redirect('site/underconstruction');
            }
            $serviceModel = new Service();
            $lastFourServiceType = $serviceModel->getServiceTypes(4);
            Yii::$app->view->params['lastFourServiceType'] = $lastFourServiceType;
        } else {
            return $this->redirect('site/error');
        }
        return parent::beforeAction($action);
    }

}