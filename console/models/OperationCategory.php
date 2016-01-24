<?php

namespace console\models;

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

    public static function forId($cars){
        $r = [];
        foreach($cars AS $car){
            $model = self::find()->where("name = :name", [':name' => $car])->one();
            if(!$model){
                $model = new self();
                $model->name = $car;
                if($model->validate()){
                    $model->save();
                }
            }
            $r[] = $model->id;
        }
        return $r;
    }
}
