<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\ParsSettings;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ParsSettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Parsing result');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pars-settings-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app', 'Create new parsing'), ['/site/index'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'created',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($data){
                    return $data->status;
                },
                'filter' => ParsSettings::listStatus(),
            ],
            'search',
            'city',
            [
                'attribute' => 'state',
                'format' => 'raw',
                'value' => function($data){
                    return ParsSettings::getState($data->state);
                },
                'filter' => ParsSettings::listStates(),
            ],
            [
                'label' => Yii::t('app', 'View results'),
                'format' => 'raw',
                'value' => function($data){
                    return Html::a(Yii::t('app', 'view'), ['/operation/index', 'pars' => $data->id]);
                },
                'filter' => false,
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
            ],
        ],
    ]); ?>

</div>
