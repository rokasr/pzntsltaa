<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'auth_key',
            'password_hash',
            'password_reset_token',
            // 'email:email',
            // 'valiuta',
            // 'role',
            // 'status',
            // 'reg_step',
            // 'avatar:ntext',
            // 'profileVisits',
            // 'activated',
            // 'created_at',
            // 'updated_at',
            // 'lastOnline',
            // 'expires',
            // 'new',
            // 'newDone',
            // 'adminChat',
            // 'facebook',
            // 'fb_id',
            // 'photoLimit',
            // 'msgEmailNot:ntext',
            // 'firstMsg',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
