<?php

    use yii\helpers\Html;
use yii\helpers\Url;

?>

<a class="btn <?php echo $channel->isSubscribed(Yii::$app->user->id) ? 'btn-secondary' : 'btn-danger'?>"
 href="<?= Url::to(["/channel/subscribe", "username" => $channel->username])?>" 
    data-method="post" data-pjax="1" role="button">
       <?= $channel->isSubscribed(Yii::$app->user->id) ? 'Unsubscribe' : 'Subscribe' ?>  
       <i class="far fa-bell"></i>
</a> <?= $channel->getSubscribers()->count() ?>