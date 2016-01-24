<?php
/**
 * powered by php-shaman
 * UserNotifications.php 12.01.2016
 * Hashtag
 */

?>
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-envelope navbar-notification-icon"></i>
    <span class="visible-xs-inline">&nbsp;<?=Yii::t('app', 'Messages')?></span>
</a>
<div class="dropdown-menu">
    <div class="dropdown-header"><?=Yii::t('app', 'Messages')?></div>
    <div class="slimScrollDiv">
        <div class="notification-list">

            <a href="" class="notification">
                <div class="notification-icon"><img src="/css/d/avatar-3-md.jpg" alt=""></div>
                <div class="notification-title">New Message</div>
                <div class="notification-description">Praesent dictum nisl non est sagittis luctus.</div>
                <div class="notification-time">20 minutes ago</div>
            </a>
        </div>
        <div class="slimScrollBar"></div>
        <div class="slimScrollRail"></div>
    </div>
    <a href="" class="notification-link"><?=Yii::t('app', 'View All Messages')?></a>
</div>
