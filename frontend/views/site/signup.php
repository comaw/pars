<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Sign Up');
$this->registerMetaTag(['name' => 'description', 'content' => $this->title]);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?=Yii::t('app', 'Please fill out the following fields to signup')?>:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username') ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'confirm')->passwordInput() ?>

            <?= $form->field($model, 'verifyCode')->widget(
                \common\recaptcha\ReCaptcha::className(),
                ['siteKey' => \common\recaptcha\ReCaptcha::SITE_KEY]
            ) ?>
            <?= $form->field($model, 'laws')->checkbox(['class' => 'forest'])->label(Yii::t('app', 'I agree with <a href="{url}" title="{name}">{name}</a>.', [
                'url' => Url::toRoute('site/laws'),
                'name' => Html::encode(Yii::t('app', 'Terms of Use')),
            ])) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Sign Up'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
