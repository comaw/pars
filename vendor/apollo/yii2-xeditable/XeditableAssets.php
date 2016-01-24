<?php
/**
 * Created by PhpStorm.
 * User: vov4ik08
 * Date: 05.03.14
 * Time: 08:53
 */

namespace Apollo;



use yii\web\AssetBundle;
use yii\web\View;

class XeditableAssets extends AssetBundle{

    public $sourcePath = '@backend/common/yii2-xeditable/assets';

    public $css = [
            'css/bootstrap-editable.css'

    ];
    /**
     * @inheritdoc
     */
    public $js = [
        'js/bootstrap-editable.min.js'


    ];
    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',

    ];


} 