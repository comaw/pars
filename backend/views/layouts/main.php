<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title.' | '.Yii::$app->name) ?></title>
    <?php $this->head() ?>

    <link rel="shortcut icon" href="/css/favicon.ico">
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']];
    } else {
        $menuItems[] = ['label' => Yii::t('app', 'Settings'), 'url' => ['/site/index']];
        $menuItems[] = ['label' => Yii::t('app', 'Users'), 'url' => ['/users/index']];
        $menuItems[] = ['label' => Yii::t('app', 'Texts'),
            'items' => [
                ['label' => Yii::t('app', 'Pages'), 'url' => ['/page/index']],
                ['label' => Yii::t('app', 'News'), 'url' => ['/news/index']],
                ['label' => Yii::t('app', 'Encyclopedia'), 'url' => ['/encyclopedia/index']],
                ['label' => Yii::t('app', 'Video'), 'url' => ['/video/index']],
            ]
        ];
        $menuItems[] = ['label' => Yii::t('app', 'Products'),
            'items' => [
                ['label' => Yii::t('app', 'Categories'), 'url' => ['/category/index']],
                ['label' => Yii::t('app', 'Products'), 'url' => ['/item/index']]
            ]
        ];
        $menuItems[] = [
            'label' => Yii::t('app', 'Logout ({user})', ['user' => Yii::$app->user->identity->username]),
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'homeLink' => [
                'label' => Yii::t('app', 'Settings'),
                'url' => Yii::$app->homeUrl,
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <a href="<?=Url::base()?>"><?=Yii::$app->name?></a> <?= date('Y') ?></p>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
