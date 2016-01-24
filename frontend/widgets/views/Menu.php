<?php
/**
 * powered by php-shaman
 * Menu.php 12.01.2016
 * Hashtag
 */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\widgets\Menu;


?>
<ul class="mainnav-menu">
    <?php foreach($url AS $name => $u){ ?>
        <?php if(isset($u['item'])){ ?>
            <li class="dropdown<?=Menu::current($u['item']) ? ' active is-open' : ''?>">
                <a href="javascript:;" title="<?=Html::encode($name)?>" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><?=$name?> <i class="mainnav-caret"></i></a>
                <ul class="dropdown-menu" role="menu">
                <?php foreach($u['item'] AS $name2 => $u2){ ?>
                    <li>
                        <a href="<?=$u2['link']?>" title="<?=Html::encode($name2)?>"><?=(isset($u2['fa'])? '<i class="fa '.$u2['fa'].' dropdown-icon"></i> ':'')?><?=$name2?></a>
                    </li>
                <?php } ?>
                </ul>
            </li>
        <?php }else{ ?>
        <li class="<?=Menu::current($u['link']) ? 'active is-open' : ''?>">
            <a href="<?=$u['link']?>" title="<?=Html::encode($name)?>"><?=(isset($u['fa'])? '<i class="fa '.$u['fa'].' dropdown-icon"></i> ':'')?><?=$name?></a>
        </li>
        <?php } ?>
    <?php } ?>
</ul>
