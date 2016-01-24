<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%pars_settings}}".
 *
 * @property string $id
 * @property string $created
 * @property string $operation
 * @property string $status
 * @property string $search
 * @property string $city
 * @property string $state
 */
class ParsSettings extends \yii\db\ActiveRecord
{

    const TIME_WAIT = 15;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pars_settings}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['search', 'city'], 'filter', 'filter' => 'trim', 'skipOnArray' => true],
            [['created'], 'date', 'format' => 'php:Y-m-d H:i:s'],
            [['status'], 'in', 'range' => self::listStatus()],
            [['operation'], 'in', 'range' => ['no', 'yes']],
            [['search', 'created'], 'required'],
            [['search', 'city'], 'string', 'max' => 255],
            [['state'], 'in', 'range' => self::listStatesRevers()],
        ];
    }

    public static function listStatus(){
        return [
            'active' => 'active',
            'finished' => 'finished',
            'archive' => 'archive',
        ];
    }

    /**
     * @inheritdoc
     */
//    public function beforeSave($insert)
//    {
//        if(parent::beforeSave($insert)){
//            if($this->isNewRecord){
//                $this->created = date("Y-m-d H:i:s", time() + 60 * 15);
//            }
//            return true;
//        }
//        return false;
//    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'operation' => Yii::t('app', 'Taken into operation'),
            'created' => Yii::t('app', 'Start pars'),
            'status' => Yii::t('app', 'Status'),
            'search' => Yii::t('app', 'Search text'),
            'city' => Yii::t('app', 'City'),
            'state' => Yii::t('app', 'State'),
        ];
    }

    public static function getState($id){
        return isset(self::listStates()[$id]) ? self::listStates()[$id] : null;
    }

    public static function listStatesRevers(){
        $r = self::listStates();
        return array_flip($r);
    }

    public static function listStates(){
        return [
            'AK' => 'Alaska',
            'AL' => 'Alabama',
            'AR' => 'Arkansas',
            'AZ' => 'Arizona',
            'CA' => 'California',
            'CO' => 'Colorado',
            'CT' => 'Connecticut',
            'DE' => 'Delaware',
            'FL' => 'Florida',
            'GA' => 'Georgia',
            'HI' => 'Hawaii',
            'IA' => 'Iowa',
            'ID' => 'Idaho',
            'IL' => 'Illinois',
            'IN' => 'Indiana',
            'KS' => 'Kansas',
            'KY' => 'Kentucky',
            'LA' => 'Louisiana',
            'MA' => 'Massachusetts',
            'MD' => 'Maryland',
            'ME' => 'Maine',
            'MI' => 'Michigan',
            'MN' => 'Minnesota',
            'MO' => 'Missouri',
            'MS' => 'Mississippi',
            'MT' => 'Montana',
            'NC' => 'North Carolina',
            'ND' => 'North Dakota',
            'NE' => 'Nebraska',
            'NH' => 'New Hampshire',
            'NJ' => 'New Jersey',
            'NM' => 'New Mexico',
            'NV' => 'Nevada',
            'NY' => 'New York',
            'OH' => 'Ohio',
            'OK' => 'Oklahoma',
            'OR' => 'Oregon',
            'PA' => 'Pennsylvania',
            'RI' => 'Rhode Island',
            'SC' => 'South Carolina',
            'SD' => 'South Dakota',
            'TN' => 'Tennessee',
            'TX' => 'Texas',
            'UT' => 'Utah',
            'VA' => 'Virginia',
            'VT' => 'Vermont',
            'WA' => 'Washington',
            'WI' => 'Wisconsin',
            'WV' => 'West Virginia',
            'WY' => 'Wyoming',
            'DC' => 'District of Columbia',
        ];
    }
}
