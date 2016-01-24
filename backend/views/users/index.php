<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p class="pull-right">
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'role',
                'format' => 'html',
                'value' => function($data){
                    return User::getRole($data->role);
                },
                'filter' => User::roleList(),
            ],
            'username',
            'email:email',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function($data){
                    return User::getBanned($data->status);
                },
                'filter' => User::bannedList(),
            ],
            [
                'attribute' => 'created_at',
                'format' => 'html',
                'value' => function($data){
                    return date("d/m/Y", $data->created_at);
                },
                'filter' => false,
            ],
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
