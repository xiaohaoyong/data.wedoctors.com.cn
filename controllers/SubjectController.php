<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2017/5/2
 * Time: 上午11:32
 */

namespace app\controllers;


use app\models\doctor\Subject;
use yii\helpers\Html;

class SubjectController extends BaseController
{
    public function actionGet($id)
    {

        $subject=Subject::$subject_all[$id];
        echo Html::tag('option',Html::encode("请选择"),array('value'=>0));

        foreach($subject as $k=>$v)
        {
            echo Html::tag('option',Html::encode($v),array('value'=>$k));
        }
    }

}