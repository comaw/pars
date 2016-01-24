<?php
/**
 * powered by php-shaman
 * UserNotifications.php 12.01.2016
 * Hashtag
 */

namespace frontend\widgets;


class UserNotifications extends \yii\bootstrap\Widget
{
    public function init(){
        parent::init();
    }

    public function run(){
        return $this->render('UserNotifications', [

        ]);
    }
}