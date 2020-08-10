<?php

namespace common\helpers;
use yii\helpers\Html;
use yii\helpers\Url;



class HtmlLink{
    public static function channelLink($user,$schema=false){
        return Html::a($user->username, 
        Url::to(["/channel/view", "username" =>  $user->username], $schema), ["class" => "text-dark"]);
    }
}