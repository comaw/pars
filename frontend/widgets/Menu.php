<?php
/**
 * powered by php-shaman
 * Menu.php 12.01.2016
 * Hashtag
 */

namespace frontend\widgets;


use yii\helpers\Url;

class Menu extends \yii\bootstrap\Widget
{
    public $url = [];

    public function init(){
        parent::init();
    }

    public function run(){
        return $this->render('Menu', [
            'url' => $this->url,
        ]);
    }

    public static function current($url){
        if(is_array($url)){
            foreach($url AS $name => $u){
                if($u['link'] == Url::current()){
                    return true;
                }
            }
        }else{
            if($url == Url::current()){
                return true;
            }
        }
        return false;
    }
}