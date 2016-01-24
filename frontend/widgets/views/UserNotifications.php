<?php
/**
 * powered by php-shaman
 * UserNotifications.php 12.01.2016
 * Hashtag
 */

?>
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-bell navbar-notification-icon"></i>
    <span class="visible-xs-inline">&nbsp;<?=Yii::t('app', 'Notifications')?></span>
    <b class="badge badge-primary">3</b>
</a>
<div class="dropdown-menu">
    <div class="dropdown-header">&nbsp;<?=Yii::t('app', 'Notifications')?></div>
    <div class="slimScrollDiv">
        <div class="notification-list">
            <a href="" class="notification">
                <span class="notification-icon"><i class="fa fa-cloud-upload text-primary"></i></span>
                <span class="notification-title">Notification Title</span>
                <span class="notification-description">Praesent dictum nisl non est sagittis luctus.</span>
                <span class="notification-time">20 minutes ago</span>
            </a>
        </div><div class="slimScrollBar"></div>
        <div class="slimScrollRail"></div></div>
    <a href="" class="notification-link"><?=Yii::t('app', 'View All Notifications')?></a>
</div>
