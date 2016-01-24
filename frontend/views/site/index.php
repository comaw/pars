<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ParsSettings;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\ParsSettings */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('app', 'Setting up a new parsing');
$this->registerMetaTag(['name' => 'description', 'content' => $this->title]);
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-10">
                <h2>Setting up a new parsing</h2>
                <div class="page-form">
                    <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($model, 'search')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'state')->dropDownList(ParsSettings::listStates(), ['prompt' => 'All states']) ?>
                    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
