<?php

namespace console\models;

use common\UrlHelp;
use Yii;

/**
 * This is the model class for table "{{%operation}}".
 *
 * @property string $id
 * @property string $pars
 * @property string $name
 * @property string $url
 * @property string $state
 * @property string $city
 * @property string $address
 * @property string $phone
 * @property string $site
 * @property string $postal
 * @property string $description
 * @property string $img
 * @property string $created
 *
 * @property ParsSettings $pars0
 * @property OperationCategoryJoin[] $operationCategoryJoins
 */
class Operation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%operation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'state', 'city', 'address', 'phone', 'site', 'img', 'postal', 'description', 'url'], 'filter', 'filter' => 'trim', 'skipOnArray' => true],
            [['name', 'state', 'city', 'address', 'phone', 'site', 'img', 'postal', 'url'], 'filter', 'filter' => 'strip_tags', 'skipOnArray' => true],
            [['pars', 'name', 'state'], 'required'],
            [['pars'], 'integer'],
            [['created'], 'safe'],
            [['description'], 'string'],
            [['url'], 'unique'],
            [['name', 'state', 'city', 'address', 'phone', 'site', 'img', 'postal', 'url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'pars' => Yii::t('app', 'Pars'),
            'name' => Yii::t('app', 'Name'),
            'state' => Yii::t('app', 'State'),
            'city' => Yii::t('app', 'City'),
            'address' => Yii::t('app', 'Address'),
            'phone' => Yii::t('app', 'Phone'),
            'site' => Yii::t('app', 'Site'),
            'img' => Yii::t('app', 'Img'),
            'created' => Yii::t('app', 'Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPars0()
    {
        return $this->hasOne(ParsSettings::className(), ['id' => 'pars']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperationCategoryJoins()
    {
        return $this->hasMany(OperationCategoryJoin::className(), ['operation' => 'id']);
    }

    public static function addNew($params){
        $model = new self();
        $model->load($params);
        if($model->validate()){
            $model->save();
            return $model->id;
        }
        return false;
    }

    public static function maxResult($page){
        preg_match("/<span class\=\"pagination\-results\-window\">(.*)<\/span>/Uis", $page, $r);
        preg_match("/^Showing ([0-9]+)\-([0-9]+) of ([0-9]{1,})$/Uis", trim($r[1]), $r2);
        return trim($r2[3]);
    }

    public static function allLinks($page){
        preg_match_all("/([0-9]+)\.(\s+)<a class\=\"biz\-name\" href\=\"(.*)\"(.*)>(.*)<\/a>/Uis", $page, $r);
        return $r[3];
    }

    public static function gerParams($page){
        $r = [];
        $r['Operation']['name'] = self::getName($page);
        $r['Operation']['state'] = self::getAddress($page, 'addressRegion');
        $r['Operation']['city'] = self::getAddress($page, 'addressLocality');
        $r['Operation']['address']= self::getAddress($page, 'streetAddress');
        $r['Operation']['phone'] = self::getPhone($page);
        $r['Operation']['site'] = self::getSite($page);
        $r['Operation']['postal'] = self::getAddress($page, 'postalCode');
        $r['Operation']['description'] = self::getDescription($page);
        $r['Operation']['url'] = UrlHelp::translateUrl($r['Operation']['name'].' '.$r['Operation']['city'].' '.$r['Operation']['state'].' '.$r['Operation']['postal']);
        $r['categories'] = self::getCategoriesPage($page);
        return $r;
    }

    protected static function getCategoriesPage($page){
        preg_match("/<span class\=\"category\-str\-list\">(.*)<\/span>/Uis", $page, $r);
        $tr = trim($r[1]);
        $tr = explode(',', $tr);
        $rs = [];
        if(sizeof($tr) > 1){
            foreach($tr AS $c){
                $c = trim(strip_tags($c));
                if($c){
                    $rs[] = $c;
                }
            }
        }else{
            $rs[] = trim(strip_tags(join('', $tr)));
        }

        return $rs;
    }

    protected static function getDescription($page){
        preg_match("/<p itemprop\=\"description\" lang\=\"([a-z]{1,3})\">(.*)<\/p>/Uis", $page, $r);
        return isset($r[2]) ? trim(strip_tags($r[2], '<br>')) : '';
    }

    protected static function getSite($page){
        preg_match("/<a href\=\"\/biz_redir\?url\=(.*)\" target\=\"_blank\">(.*)<\/a>/Uis", $page, $r);
        return isset($r[2]) ? trim(strip_tags($r[2])) : '';
    }

    protected static function getPhone($page){
        preg_match("/<span class\=\"biz-phone\" itemprop\=\"telephone\">(.*)<\/span>/Uis", $page, $r);
        return isset($r[1]) ? trim(strip_tags($r[1])) : '';
    }

    protected static function getAddress($page, $type = 'addressLocality'){
        preg_match("/<span itemprop\=\"".$type."\">(.*)<\/span>/Uis", $page, $r);
        return isset($r[1]) ? trim(strip_tags($r[1])) : '';
    }

    protected static function getName($page){
        preg_match("/<h1 (.*)>(.*)<\/h1>/Uis", $page, $r);
        return isset($r[2]) ? trim(strip_tags($r[2])) : '';
    }
}
