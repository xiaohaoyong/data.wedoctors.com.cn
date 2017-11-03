<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "data_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $type
 * @property integer $hospital
 * @property integer $province
 * @property integer $county
 * @property integer $city
 * @property integer $careatetime
 * @property integer $lasttime
 */
class DataUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'data_user';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbud');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['type', 'hospital', 'province', 'county', 'city', 'careatetime', 'lasttime'], 'integer'],
            [['username'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'password' => '密码',
            'type' => '1,政府2，地区，3医院',
            'hospital' => '医院ID',
            'province' => '省',
            'county' => '县',
            'city' => '市',
            'careatetime' => '添加时间',
            'lasttime' => '最后一次登录时间',
        ];
    }
}
