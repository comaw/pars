<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property string $id
 * @property string $role
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */

class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            $this->updated_at = time();
            if($this->isNewRecord){
                $this->created_at = time();
                $this->password_hash = Yii::$app->security->generatePasswordHash($this->password_hash);
            }
            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email'], 'filter', 'filter' => 'trim', 'skipOnArray' => true],
            [['role'], 'string'],
            [['role'], 'in', 'range' => ['user', 'admin']],
            [['username', 'password_hash', 'email'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'email'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['password_hash'], 'string', 'min' => 6],
            [['username'], 'string', 'min' => 2, 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'role' => Yii::t('app', 'Role'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public static function roleList(){
        return [
            'user' => Yii::t('app', 'User'),
            'admin' => Yii::t('app', 'Admin'),
        ];
    }

    public static function getRole($id){
        return isset(self::roleList()[$id]) ? self::roleList()[$id] : null;
    }

    public static function bannedList(){
        return [
            10 => Yii::t('app', 'Active'),
            5 => Yii::t('app', 'Banned'),
        ];
    }

    public static function getBanned($id){
        return isset(self::bannedList()[$id]) ? self::bannedList()[$id] : null;
    }
}
