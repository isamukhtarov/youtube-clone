<aside class="shadow">
<?php
  use yii\bootstrap4\Nav;

  echo Nav::widget([
      "options" => [
        "class" => "d-flex flex-column nav-pills"
      ],
      "items" => [
          [
            'label' => 'Dashboard',
            'url' => ["/site/index"]
          ],

          [
              'label' => 'Videos',
              'url' => ['/video/index']
          ]
      ]
  ]);

?>
</aside>

<!-- <div class="list-group">
  <a href="#" class="list-group-item list-group-item-action active">
    Cras justo odio
  </a>
  <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
  <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
  <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
  <a href="#" class="list-group-item list-group-item-action disabled">Vestibulum at eros</a>
</div> -->