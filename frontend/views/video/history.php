<?php

use yii\widgets\ListView;
?>

<h1>My history</h1>

<?php
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_video_item',
        'layout' => '<div class="d-flex flex-wrap">{items}</div>{pager}',
        'itemOptions' => [
            'tag' => false
        ]
    ]);
?>