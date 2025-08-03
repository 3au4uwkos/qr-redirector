<?php

namespace app\controllers;

use yii\web\Controller;

class QrController extends Controller
{
    public function actionIndex(){
        return $this->render('index');
    }
}