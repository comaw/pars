<?php
/**
 * powered by php-shaman
 * ParsController.php 24.01.2016
 * www
 */

namespace console\controllers;

set_time_limit(0);
ignore_user_abort(true);

use console\models\Curl;
use console\models\Operation;
use console\models\OperationCategory;
use console\models\OperationCategoryJoin;
use console\models\ParsSettings;
use yii\console\Controller;
use yii\helpers\ArrayHelper;
use yii\helpers\Console;
use Yii;

class ParsController extends Controller
{
    public function actionIndex() {
        Curl::cookieFile(true);
        $settings = ParsSettings::find()->where("operation = 'no' AND status = 'active'", [])->orderBy("id asc")->one();
        if(!$settings){
            exit();
        }
        $settings->operation = 'yes';
        $settings->save();
        $parsId = $settings->id;
//        $baseUrl = 'http://www.yelp.com/search?find_desc=dentist&find_loc=Dallas,+TX';
        $baseUrl = 'http://www.yelp.com/search?find_desc='.urlencode($settings->search).'';
        if($settings->city){
            $baseUrl .= '&find_loc='.urlencode($settings->city);
            if($settings->state){
                $baseUrl .= ','.urlencode(' '.$settings->state);
            }
        }elseif($settings->state){
            $baseUrl .= '&find_loc='.urlencode($settings->state);
        }
        $this->runInFile($baseUrl, 'txt', 'lastUrl');
        $page = Curl::get($baseUrl.'&start=0');
        $max = (int)Operation::maxResult($page);
        if($max < 1){
            exit();
        }
        $this->runInFile($max, 'txt', 'lastMax');
        $maxPage = ceil($max / 10);
//        $maxPage = 1000;
        $data = [];
        $this->runInFileLink(join(PHP_EOL, $data), $parsId, true);
        for($i = 0; $i <= $maxPage; $i += 10){
            $url = $baseUrl.'&start='.$i;
            $url = Curl::get($url);
            $page = Operation::allLinks($url);
            if(is_array($page) && sizeof($page) > 0){
                $page = Operation::urlCorrect($page);
//                $data = ArrayHelper::merge($data, $page);
                $this->runInFileLink(join(PHP_EOL, $page), $parsId);
            }
            $time = rand(50, 200) * 10000;
            usleep($time);
        }
        unset($page);
        unset($data);
        unset($url);
        $links = $this->getInFileLink($parsId);
        $links = explode(PHP_EOL, $links);
        foreach($links AS $link){
            $link = trim($link);
            if(!$link){
                continue;
            }
            $link = 'http://www.yelp.com'.$link;
            $page = Curl::get($link);
            $params = Operation::gerParams($page);
            $categoriesIds = OperationCategory::forId($params['categories']);
            if(!$params['Operation']['name']){
                continue;
            }
            $params['Operation']['pars'] = $parsId;
            $itemId = Operation::addNew($params);
            if($itemId && $categoriesIds){
                OperationCategoryJoin::addNew($itemId, $categoriesIds);
            }
            $time = rand(50, 200) * 10000;
            usleep($time);
        }
        $this->delInFileLink($parsId);
        $settings->operation = 'yes';
        $settings->status = 'finished';
        $settings->save();
        $this->runInFile(sizeof($links), 'html', 'finish');
    }

    protected function runInFile($str, $ext = 'txt', $name = null){
        $name = $name ? $name : date("Y-m-d_H_i_s");
        file_put_contents(Yii::getAlias('@console').'/runtime/'.$name.'.'.$ext, $str);
    }

    protected function delInFileLink($id){
        $name = Yii::getAlias('@console').'/runtime/'.$id.'_links.txt';
        @unlink($name);
    }

    protected function getInFileLink($id){
        $name = Yii::getAlias('@console').'/runtime/'.$id.'_links.txt';
        return @file_get_contents($name);
    }

    protected function runInFileLink($str, $id, $new = false){
        $name = Yii::getAlias('@console').'/runtime/'.$id.'_links.txt';
        $data = '';
        if(!$new){
            $data = @file_get_contents($name);
        }

        file_put_contents($name, $data.PHP_EOL.$str);
    }
}