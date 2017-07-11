<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_login".
 *
 * @property integer $userid
 * @property string $password
 */
class UserLogin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_login';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbus');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'password'], 'required'],
            [['userid'], 'integer'],
            [['password'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userid' => '用户ID',
            'password' => '用户密码',
        ];
    }
}
