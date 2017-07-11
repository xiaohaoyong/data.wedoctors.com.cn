<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2017/6/14
 * Time: 上午10:46
 */

namespace app\controllers;
use app\models\IosVersion;
use app\models\AndroidVersion;
use yii\web\Controller;

class SetupController extends Controller
{

    public function actionIosVersion()
    {
        $model=IosVersion::findOne();

        if($model->load(\Yii::$app->request->post()))
        {
            $model->type='ios';
            $model->save();
        }


        return $this->render('iosversion', [
            'model' => $model,
        ]);
    }
    public function actionAndroidVersion()
    {
        $model=AndroidVersion::findOne();

        if($model->load(\Yii::$app->request->post()))
        {
            $model->type='android';
            $model->save();
        }


        return $this->render('androidversion', [
            'model' => $model,
        ]);
    }
}