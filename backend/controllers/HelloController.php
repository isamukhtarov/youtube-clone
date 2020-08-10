<?php


namespace backend\controllers;

use yii\base\Controller;

class HelloController extends Controller{
    public function actionIndex(){
        return $this->render("index");
    }
}