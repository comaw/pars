<?php

namespace frontend\widgets;


class WidgetRegistry extends \yii\bootstrap\Widget {

    public $returnUrl = null;

    public function init(){
        parent::init();
    }

    public function run(){
        return $this->render('widgetRegistry', [
            'returnUrl' => $this->returnUrl
        ]);
    }
}