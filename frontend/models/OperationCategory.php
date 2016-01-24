<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%operation_category}}".
 *
 * @property string $id
 * @property string $name
 * @property string $created
 *
 * @property OperationCategoryJoin[] $operationCategoryJoins
 */
class OperationCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%operation_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'created' => Yii::t('app', 'Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperationCategoryJoins()
    {
        return $this->hasMany(OperationCategoryJoin::className(), ['category' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperations()
    {
        return $this->hasMany(Operation::className(), ['id' => 'operation'])
            ->viaTable('{{%operation_category_join}}', ['category' => 'id']);
    }
}
