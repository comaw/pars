<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%operation_category_join}}".
 *
 * @property string $id
 * @property string $category
 * @property string $operation
 *
 * @property Operation $operation0
 * @property OperationCategory $category0
 */
class OperationCategoryJoin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%operation_category_join}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category', 'operation'], 'required'],
            [['category', 'operation'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category' => Yii::t('app', 'Category'),
            'operation' => Yii::t('app', 'Operation'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperation0()
    {
        return $this->hasOne(Operation::className(), ['id' => 'operation']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory0()
    {
        return $this->hasOne(OperationCategory::className(), ['id' => 'category']);
    }
}
