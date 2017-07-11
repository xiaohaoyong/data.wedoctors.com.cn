<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\UserLogin;
use app\models\Users;
use yii\console\Controller;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex()
    {
        $users=Users::findAll(['state'=>0]);
        foreach($users as $k=>$v)
        {
            $login=UserLogin::findOne(['userid'=>$v->id]);
            if(!$login)
            {
                $login=new UserLogin();
                $login->loadDefaultValues();
                $login->password=md5("000000KzhRb99Tn37dPP4u");
                $login->userid=$v->id;
                $login->save();
            }
            echo $v->id."\n";
        }
    }
}
