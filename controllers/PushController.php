<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 17/4/8
 * Time: 下午1:53
 */

namespace app\controllers;


use app\models\dynamic\Dynamic;
use app\models\dynamic\DySeminar;
use app\models\Push;

class PushController extends BaseController{

    public function actionIndex()
    {
        $params=\Yii::$app->request->post();
        if($params)
        {

            if($params['t']==1) {
                //修改发送状态
                $dySem = Dynamic::findOne($params['id']);
                $dySem->pushstate = 0;
                $dySem->save();
            }


            //发起推送任务
            $push = new Push();
            $push->load(['Push'=>$params]);
            $push->run();
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['code'=>10000,'msg'=>'成功'];
        }
        return $this->renderAjax('index');
    }
} 