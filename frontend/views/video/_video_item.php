<?php

use common\helpers\HtmlLink;
use yii\helpers\Url;
?>

<div class="card m-3" style="width: 18rem;">
<a href="<?php echo Url::to(['/video/show', 'id' => $model->video_id])?>">
    <div class="embed-responsive embed-responsive-16by9">
                        <video class="embed-responsive-item" 
                        poster="<?php echo $model->getThumbnailLink(); ?>"
                        src="<?php echo $model->getVideoLink(); ?>">
                        </video>
    </div> 
</a>
    
  <div class="card-body p-2">
    <h6 class="card-title"><?= $model->title; ?></h6>
    <p class="text-muted card-text m-0">
        <?= HtmlLink::channelLink($model->createdBy) ?>
    </p>
    <p class="text-muted card-text m-0">
    <?= $model->getViews()->count() ?> views. <?= Yii::$app->formatter->asRelativeTime($model->created_at) ?>
    </p>
  </div>
</div>