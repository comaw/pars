<?php
/**
 * powered by php-shaman
 * UserMenu.php 12.01.2016
 * Hashtag
 */

use yii\helpers\Url;
use yii\helpers\Html;

?>
<ul class="nav navbar-nav navbar-right">
    <li>
        <a href="javascript:;"><?=Yii::t('app', 'About Us')?></a>
    </li>
    <li>
        <a href="javascript:;"><?=Yii::t('app', 'Support')?></a>
    </li>
    <li>
        <a href="javascript:;"><?=Yii::t('app', 'F.A.Q.')?></a>
    </li>
    <?php if(Yii::$app->user->isGuest){ ?>
        <li>
            <a href="<?=Url::toRoute('site/signup')?>" title="<?=Html::encode(Yii::t('app', 'Sign Up'))?>"><?=Yii::t('app', 'Sign Up')?></a>
        </li>

        <li>
            <a href="<?=Url::toRoute('site/login')?>" title="<?=Html::encode(Yii::t('app', 'Sign In'))?>"><?=Yii::t('app', 'Sign In')?></a>
        </li>
    <?php } ?>
    <?php if(!Yii::$app->user->isGuest){ ?>
        <li class="dropdown navbar-profile">
            <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
                <img src="<?=\common\Gravatar::getAvatar(Yii::$app->user->identity->email, 40, false)?>" class="navbar-profile-avatar" alt="<?=Html::encode(Yii::$app->user->identity->username)?>">
                <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="<?=Url::toRoute('user/billing')?>">
                        <i class="fa fa-dollar"></i>
                        &nbsp;&nbsp;<?=Yii::t('app', 'Plans &amp; Billing')?>
                    </a>
                </li>
                <li>
                    <a href="<?=Url::toRoute('user/settings')?>">
                        <i class="fa fa-cogs"></i>
                        &nbsp;&nbsp;<?=Yii::t('app', 'Settings')?>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="<?=Url::toRoute('site/logout')?>" data-method="post" onclick="return confirm('<?=Yii::t('app', 'Are you sure you want to quit?')?>');">
                        <i class="fa fa-sign-out"></i>
                        &nbsp;&nbsp;<?=Yii::t('app', 'Logout')?>
                    </a>
                </li>
            </ul>
        </li>
    <?php } ?>
</ul>
