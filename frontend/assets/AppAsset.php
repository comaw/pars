<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/d/css.css',
        'css/d/css1.css',
        'css/d/font-awesome.min.css',
        'css/d/mvpready-admin.css',
        'css/site.css',
    ];
    public $js = [
        'js/jquery.slimscroll.min.js',
        'js/excanvas.min.js',
        'js/jquery.flot.js',
        'js/jquery.flot.pie.js',
        'js/jquery.flot.resize.js',
        'js/jquery.flot.time.js',
        'js/jquery.flot.tooltip.js',
        'js/mvpready-core.js',
        'js/mvpready-helpers.js',
        'js/mvpready-admin.js',
        'js/line.js',
        'js/pie.js',
        'js/auto.js',
        'js/home.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
