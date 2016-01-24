<?php

namespace yii\select2;

use yii\helpers\Html;
use yii\web\AssetBundle;
use yii\helpers\ArrayHelper;
use yii\widgets\InputWidget;
class Select2 extends InputWidget {

    public $items = [];
    public $clientOptions = [];
    private $_assetBundle;

    public function init()
    {
        if ($this->hasModel()) {
            $this->options['id'] = Html::getInputId($this->model, $this->attribute);
        } else {
            $this->options['id'] = $this->getId();
        }
        $this->registerAssetBundle();
        $this->registerLocate();
        $this->registerScript();
    }

    public function run()
    {
        if ($this->hasModel()) {
            echo Html::activeDropDownList($this->model, $this->attribute, $this->items, $this->options);
        } else {
            echo Html::dropDownList($this->name, $this->value, $this->items, $this->options);
        }
    }

    public function registerAssetBundle()
    {
        $this->_assetBundle = Select2Asset::register($this->getView());
        Select2BootstrapAsset::register($this->getView());
    }

    public function registerLocate()
    {
        $locate = ArrayHelper::getValue($this->clientOptions, 'locales', FALSE);
        if ($locate) {
            $locateAsset = 'locates/select2_locale_' . $locate . '.js';
            if (file_exists(Yii::getAlias($this->getAssetBundle()->sourcePath . '/' . $locateAsset))) {
                $this->getAssetBundle()->js[] = $locateAsset;
            } else {
                ArrayHelper::remove($this->clientOptions, 'locales');
            }
        }
    }

    public function registerScript()
    {
        $clientOptions = (count($this->clientOptions)) ? Json::encode($this->clientOptions) : '';
        $this->getView()->registerJs("jQuery('#{$this->options['id']}').select2({$clientOptions});");
    }

    public function getAssetBundle()
    {
        if (!($this->_assetBundle instanceof AssetBundle)) {
            $this->registerAssetBundle();
        }
        return $this->_assetBundle;
    }

}
