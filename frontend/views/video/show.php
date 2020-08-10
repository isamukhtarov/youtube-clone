<?php
    /* @var $model common\models\Video */
    //print_r($get)

use common\helpers\HtmlLink;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

?>
<div class="row">
    <div class="col-sm-8">
    <div class="embed-responsive embed-responsive-16by9">
                        <video class="embed-responsive-item" 
                        poster="<?php echo $model->getThumbnailLink(); ?>"
                        src="<?php echo $model->getVideoLink(); ?>" controls>
                        </video>
    </div> 
        <h6 class="mt-2"><?= $model->title ?></h6>
        <div class="d-flex justify-content-between align-items-center">
            <p><?= $model->getViews()->count() ?> views <?= Yii::$app->formatter->asDate($model->created_at)?></p>
        </div>
        <div>
            <?php Pjax::begin()?>
                <?= $this->render("_buttons", [
                    "model" => $model
                ])?>
            <?php Pjax::end()?>
        </div>
        <div>
            <p>
                <?= HtmlLink::channelLink($model->createdBy) ?>
            </p>
            <?= Html::encode($model->description)?>
        </div>
    </div>
    <div class="col-sm-4">
        <?php foreach($similarVideos as $video): ?>
            <div class="media mb-3">
                <a href="<?= Url::to(["/video/show", "id" => $video->video_id])?>">
                    <div class="embed-responsive embed-responsive-16by9 mr-2" style="width:120px;">
                                <video class="embed-responsive-item" 
                                poster="<?php echo $video->getThumbnailLink(); ?>"
                                src="<?php echo $video->getVideoLink(); ?>">
                                </video>
                    </div>
                </a>
                 
                <div class="media-body">
                    <h6 class="mt-0"><?= $video->title ?></h6>
                    <div class="text-muted">
                        <p class="m-0">
                            <?= HtmlLink::channelLink($model->createdBy)?>
                        </p>
                        <p>
                            <?= $video->getViews()->count() ?> views
                            <?= Yii::$app->formatter->asRelativeTime($video->created_at)?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>