<?php

namespace console\models;

use Yii;

/**
 * This is the model class for table "{{%pars_settings}}".
 *
 * @property string $id
 * @property string $operation
 * @property string $created
 * @property string $status
 * @property string $search
 * @property string $city
 * @property string $state
 *
 * @property Operation[] $operations
 */
class ParsSettings extends \yii\db\ActiveRecord
{
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
            [['operation', 'status'], 'string'],
            [['created'], 'safe'],
            [['search'], 'required'],
            [['search', 'city', 'state'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'operation' => Yii::t('app', 'Operation'),
            'created' => Yii::t('app', 'Created'),
            'status' => Yii::t('app', 'Status'),
            'search' => Yii::t('app', 'Search'),
            'city' => Yii::t('app', 'City'),
            'state' => Yii::t('app', 'State'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperations()
    {
        return $this->hasMany(Operation::className(), ['pars' => 'id']);
    }
}
