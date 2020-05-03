<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;

class AppAdminController extends Controller{
    
    public function behaviors() {
	  return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
	
    }
    //put your code here
}
