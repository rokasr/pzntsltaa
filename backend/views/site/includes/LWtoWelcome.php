<?php
/*
 * @$model->id
 * @$model->username
 * @$model->lastOnline
 * @$model->lastOnline
 *
 * INFO
 * @diena
 * @menuo
 * @metai
 * @miestas
 */
use yii\helpers\Url;

require(__DIR__ ."/../../../../frontend/views/site/form/_list.php");

$dataInfo = $model->info;

$timeDiff = time() - $model->lastOnline;

if($timeDiff <= 600){
    $online = 1;
}else{
    $online = 0;
}

?>

<?php

$d1 = new DateTime($dataInfo['diena'].'.'.$dataInfo['menuo'].'.'.$dataInfo['metai']);
$d2 = new DateTime();

$diff = $d2->diff($d1);

if(isset(Yii::$app->params['close'])){
    Yii::$app->params['close']++;
}

?>
<div class="col-xs-2" style="padding: 5px 5px;">

    <a href="<?= Url::to(['site/towelcome', 'id' => $model->id])?>" >

        <!-- Avataras -->
        <div id="a<?= $model->id; ?>" class="recentImgHolder">
            <img id="imga<?= $model->id; ?>" class="cntrm" src="<?= \frontend\models\Misc::getAvatar($model); ?>" width="100%" />
        </div>

        <!-- Info -->
        <div class="col-xs-12" style="text-align: center; padding: 0px 2px;background-color: #fff;">
            <?php
            $timeDiff = time() - $model->lastOnline;

            if($timeDiff <= 600){
                $online = 1;
            }else{
                $online = 0;
            }
            if($online):
                ?>
                <img src="/css/img/online.png" title="Prisijungęs" style="position: absolute; z-index: 1; margin-top: -14px; left: 0; margin-left: 1px;">
            <?php endif; ?>
            <span class="ProfName" style="font-size: 13px;"><?= $model->username; ?></span><br>

            <span class="ProfInfo" style="color: #5b5b5b; font-size: 11px; position: relative; top: -3px;"><?= $diff->y; ?>, <?= ($dataInfo['miestas'] !== '')? $list[$dataInfo['miestas']] : "Nenurodyta"; ?></span>
        </div>
    </a>

</div>

<?php if(isset(Yii::$app->params['close']) && Yii::$app->params['close'] > 5): Yii::$app->params['close'] = 0; ?>

</div>
<div class="row" style="padding-left: 15px; padding-right: 15px;">

    <?php endif; ?>





