<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\ParsSettings;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OperationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Results');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operation-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <a href="<?=Url::toRoute(['operation/csv', 'pars' => $pars])?>" class="btn btn-warning pull-right"><?=Yii::t('app', 'Save in CSV')?></a>
        <br>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute' => 'pars',
                'format' => 'raw',
                'value' => function($data){
                    return isset($data->pars0->search) ? $data->pars0->search : '';
                },
                'filter' => ArrayHelper::map(ParsSettings::find()->orderBy("id desc")->all(), 'id', 'search'),
            ],
            'name',
            [
                'attribute' => 'state',
                'format' => 'raw',
                'value' => function($data){
                    return ParsSettings::getState($data->state);
                },
                'filter' => ParsSettings::listStates(),
            ],
            'city',
            [
                'label' => Yii::t('app', 'Categories'),
                'format' => 'raw',
                'value' => function($data){
                    $r = '<ul class="list-unstyled">';
                    foreach($data->categories AS $cat){
                        $r .= '<li>'.$cat->name.'</li>';
                    }
                    $r .= '</ul>';
                    return $r;
                },
                'filter' => false,
            ],
            // 'address',
//             'phone',
            // 'site',
            // 'img',
            // 'created',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
