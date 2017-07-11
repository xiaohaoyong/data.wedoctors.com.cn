<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2017/6/14
 * Time: 上午10:53
 */

namespace app\models;


use yii\base\Model;

class IosVersion extends Model
{
    public $currentVersion;
    public $versionInfo;
    public $isForceUpdate;
    public $isStopUpdate;
    public $type;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['currentVersion', 'versionInfo', 'isForceUpdate', 'isStopUpdate'], 'required'],
        ];
    }
    public function save()
    {
        $rs=$this->toArray();
        unset($rs['type']);
        $row[$this->type]=$rs;

        $redis=\Yii::$app->rdmp;
        //病历研讨班推送队列
        $taskstr=json_encode($row);
        $key="mp:setup:app:".$this->type;
        $redis->set($key,$taskstr);
    }
    public static function findOne()
    {

        $redis=\Yii::$app->rdmp;
        //病历研讨班推送队列
        $key="mp:setup:app:ios";
        $rs=json_decode($redis->get($key),true);
        $row['IosVersion']=$rs['ios'];
        $model= new IosVersion();
        $model->load($row);
        return $model;
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'currentVersion' => '版本号',
            'versionInfo' => '版本描述',
            'isForceUpdate' => '是否强制更新',
            'isStopUpdate' => '是否停止更新',
            'type' => '类型',
        ];
    }
}