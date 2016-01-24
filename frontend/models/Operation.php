<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%operation}}".
 *
 * @property string $id
 * @property string $pars
 * @property string $name
 * @property string $state
 * @property string $city
 * @property string $address
 * @property string $phone
 * @property string $site
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
            [['pars', 'name', 'state'], 'required'],
            [['pars'], 'integer'],
            [['created'], 'safe'],
            [['name', 'state', 'city', 'address', 'phone', 'site', 'img'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'pars' => Yii::t('app', 'Parsing'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(OperationCategory::className(), ['id' => 'category'])
            ->viaTable('{{%operation_category_join}}', ['operation' => 'id']);
    }
}
