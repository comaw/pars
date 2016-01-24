<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Sign In');
$this->registerMetaTag(['name' => 'description', 'content' => $this->title]);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?=Yii::t('app', 'Please fill out the following fields to login')?>:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

            <?php if($errorLogin){ ?>
                <?= $form->field($model, 'verifyCode')->widget(
                    \common\recaptcha\ReCaptcha::className(),
                    ['siteKey' => \common\recaptcha\ReCaptcha::SITE_KEY]
                ) ?>
            <?php } ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Sign In'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
