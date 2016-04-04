<?php
use yii\widgets\ListView;
?>


<?= ListView::widget( [
    'layout' => '
        <div id="pasnekovaiNew">
            <div class="row" style="padding-left: 15px; padding-right: 15px;">
                {items}
            </div>
            <div class="row" style="padding-left: 15px; padding-right: 15px; text-align: right;">
                {pager}
            </div>
        </div>
        ',
    'dataProvider' => $dataProvider,
    'itemView' => '//member/_msg',
    'viewParams' => ['current' => $current],
    'pager' =>[
        'maxButtonCount'=>0,
        'nextPageLabel'=>'Kitas &#9658;',
        'nextPageCssClass' => 'removeStuff',
        'prevPageLabel'=>'&#9668; Atgal',
        'prevPageCssClass' => 'removeStuff',
        'disabledPageCssClass' => 'off',
    ]

    ] ); 
?>