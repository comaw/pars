<?php
/**
 * powered by php-shaman
 * UserMenu.php 12.01.2016
 * Hashtag
 */

namespace frontend\widgets;


class UserMenu extends \yii\bootstrap\Widget
{
    public $returnUrl = null;

    public function init(){
        parent::init();
    }

    public function run(){
        return $this->render('UserMenu', [
            'returnUrl' => $this->returnUrl
        ]);
    }
}