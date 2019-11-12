<?php


namespace app\controllers;


use yii\web\Controller;
use Yii;

class BaseController extends Controller
{
    public function beforeAction($action)
    {
        if (Yii::$app->language == 'ru') {
             return $this->redirect('site/underconstruction');
        }
        return parent::beforeAction($action);
    }

}