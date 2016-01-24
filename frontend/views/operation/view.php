<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\ParsSettings;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Operation */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Operations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$r = '<ul class="list-unstyled">';
foreach($model->categories AS $cat){
    $r .= '<li>'.$cat->name.'</li>';
}
$r .= '</ul>';


?>
<div class="operation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'pars',
                'format' => 'raw',
                'value' => isset($model->pars0->search) ? $model->pars0->search : '',
            ],
            'name',
            [
                'attribute' => 'state',
                'format' => 'raw',
                'value' => ParsSettings::getState($model->state),
            ],
            'city',
            'address',
            'phone',
            'site:url',
            [
                'label' => Yii::t('app', 'Categories'),
                'format' => 'raw',
                'value' => $r,
            ],
//            'img',
            'created',
        ],
    ]) ?>

</div>
