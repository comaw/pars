<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'role')->dropDownList(User::roleList()) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?php if($model->isNewRecord){ ?>
        <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>
    <?php }else{ ?>
        <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true, 'value' => ''])->hint(Yii::t('app', 'Leave blank if you do not need to change')) ?>
    <?php } ?>

    <?= $form->field($model, 'status')->dropDownList(User::bannedList()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
