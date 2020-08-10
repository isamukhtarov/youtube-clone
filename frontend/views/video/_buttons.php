<?php
    use yii\helpers\Url;
?>

                <a href="<?= Url::to(["/video/like", "id" => $model->video_id])?>" 
                data-method="post" data-pjax="1" class="btn btn-sm <?= $model->isLikeBy(Yii::$app->user->id) 
                ? 'btn-outline-primary': 'btn-outline-secondary'?>">
                    <i class="fas fa-thumbs-up"></i> <?= $model->getLikes()->count() ?>
                </a>

                <a href="<?= Url::to(["/video/dislike", "id" => $model->video_id])?>" 
                data-method="post" data-pjax="1" class="btn btn-sm <?= $model->isDislikeBy(Yii::$app->user->id) 
                ? 'btn-outline-primary': 'btn-outline-secondary'?>">
                    <i class="fas fa-thumbs-down"></i> <?= $model->getDislikes()->count() ?>
                </a>
