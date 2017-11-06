<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 17/3/28
 * Time: 下午6:18
 */

namespace app\models;


class UserDb extends Models
{
    public static function getDb()
    {
        return \Yii::$app->get('dbus');
    }
}