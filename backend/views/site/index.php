<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'My Yii Application';

?>
<div class="site-index d-flex">
                <div class="card m-2" style="width: 14rem;">
                <?php if($lastVideo): ?>
                    <div class="embed-responsive embed-responsive-16by9 mb-3">
                                <video class="embed-responsive-item" 
                                poster="<?php echo $lastVideo->getThumbnailLink(); ?>"
                                src="<?php echo $lastVideo->getVideoLink(); ?>">
                                </video>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title"><?= $lastVideo->title ?></h6>
                        <p class="card-text">
                            Likes: <?= $lastVideo->getLikes()->count()?><br>
                            Views: <?= $lastVideo->getViews()->count()?><br>
                        </p>
                        <a href="<?= Url::to(["/video/update", "id" => $lastVideo->video_id])?>" class="btn btn-primary">
                        Edit
                    </a>
                    </div>
                    <?php else: ?>
                        <div class="card-body">
                            You dont't have uploaded videos
                        </div>
                    <?php endif; ?>
                </div>

                <div class="card m-2" style="width: 14rem;">
                    <div class="card-body">
                        <h6 class="card-title">Total Views</h6>
                        <p class="card-text" style="font-size: 48px;">
                            <?= $numberView ?>
                        </p>

                    </div>
                </div>

                <div class="card m-2" style="width: 14rem;">
                    <div class="card-body">
                        <h6 class="card-title">Total Subscribers</h6>
                        <p class="card-text" style="font-size: 48px;">
                            <?= $numberOfSubscribers ?>
                        </p>

                    </div>
                </div>

                <div class="card m-2" style="width: 14rem;">
                    <div class="card-body">
                        <h6 class="card-title">Latest Subscribers</h6>
                            <?php foreach($subscribers as $subscriber): ?>
                                <?= $subscriber->user->username ?>
                            <?php endforeach; ?>   

                    </div>
                </div>
                    
    </div>
