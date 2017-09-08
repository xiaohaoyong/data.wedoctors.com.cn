<?php

namespace app\models;
use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return \Yii::$app->get('dbud');
    }

    public static function tableName()
    {
        return 'data_user';
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token]);
    }

    public static function findByUsername($username)
    {     //①
        return static::findOne(['username' => $username]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthkey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function validatePassword($password)
    {          //②
        return $this->password === md5(md5("data.wedoctors").$password);
    }

    /**
     *
     * <span style="white-space:pre">    </span> * Generates "remember me" authentication key
     * <span style="white-space:pre">    </span> */
    public function generateAuthKey()                    //③
    {
        $this->auth_key = \Yii::$app->security->generateRandomString();
        $this->save();
    }
}

?>

