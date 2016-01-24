<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ParsSettings */

$this->title = Yii::t('app', 'Create Pars Settings');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pars Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pars-settings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
