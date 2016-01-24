<?php

namespace yii\select2;
use yii\web\AssetBundle;
class Select2Asset extends AssetBundle {
    public $sourcePath = '@yii/select2/assets';
    public $js = ['select2.js'];
    public $css = ['select2-bootstrap.css'];
    public $depends = ['yii\bootstrap\BootstrapAsset'];
}
