<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use frontend\models\SignupForm;
use yii\captcha\Captcha;

?>
<?php if(Yii::$app->user->isGuest){ ?>
    <?php $model = new SignupForm(); ?>
    <div class="dropdown animated fadeInDown animation-delay-11">
        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-edit"></i> <?=Yii::t('app', 'Регистрация')?></a>
        <div class="dropdown-menu dropdown-menu-right dropdown-login-box animated fadeInUp">
            <?php $form = ActiveForm::begin([
                'id' => 'loginform',
                'options' => ['role' => 'form', 'name' => 'loginform'] ,
                'action' => Url::toRoute('site/signup'),
                'fieldConfig' => ['template' => "{input}\n{hint}"],
            ]); ?>
            <input type="hidden" name="returnUrl" value="<?=$returnUrl?>">
            <h4><?=Yii::t('app', 'Регистрация')?></h4>
            <div class="form-group">
                <div class="input-group login-input">
                    <span class="input-group-addon"><i class="fa fa-child"></i></span>
                    <?= $form->field($model, 'username')->textInput(['placeholder' => Yii::t('app', 'Имя')]) ?>
                </div>
                <br>
                <div class="input-group login-input">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <?= $form->field($model, 'email')->textInput(['placeholder' => Yii::t('app', 'Email')]) ?>
                </div>
                <br>
                <div class="input-group login-input">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <?= $form->field($model, 'password')->passwordInput(['placeholder' => Yii::t('app', 'Пароль')]) ?>
                </div>
                <br>
                <div class="input-group login-input">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <?= $form->field($model, 'passto')->passwordInput(['placeholder' => Yii::t('app', 'Пароль еще раз')]) ?>
                </div>
                <br>
                <div class="input-group login-input">
                   <?= $form->field($model, 'captcha')->passwordInput(['placeholder' => Yii::t('app', 'Каптча')])->widget(Captcha::className()) ?>
                </div>
                <button type="submit" class="btn btn-ar btn-primary pull-right"><?=Yii::t('app', 'Отправить')?></button>
                <div class="clearfix"></div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
<?php } ?>