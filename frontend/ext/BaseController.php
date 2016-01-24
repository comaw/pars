<?php

namespace frontend\ext;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;

class BaseController extends Controller{

    public function behaviors(){
        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                    [
//                        'allow' => false,
//                        'roles' => ['*'],
//                    ],
//                ],
//            ],
        ];
    }

    public function afterAction($action, $result){
        Yii::$app->getUser()->setReturnUrl(Yii::$app->request->url);
        return parent::afterAction($action, $result);
    }
}