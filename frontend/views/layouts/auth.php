<?php

/* @var $this \yii\web\View */
/* @var $content string */

//use frontend\assets\AppAsset;

use common\widgets\Alert;


//AppAsset::register($this);
$this->beginContent('@frontend/views/layouts/base.php');
?>

    
    <main class="d-flex">

        <div class="content-wrapper p-3">
            <?= Alert::widget();?>
            <?= $content ?>
        </div>

    </main>
    
<?php echo $this->endContent(); ?>