<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2017/6/14
 * Time: 上午10:53
 */

namespace app\models;


use yii\base\Model;

class AndroidVersion extends Model
{
    public $apkname;
    public $versioncode;
    public $md5;
    public $apkurl;
    public $description;
    public $isupdate;
    public $isStopUpdate;
    public $type;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['apkname', 'versioncode', 'md5', 'apkurl','description','isupdate','isStopUpdate'], 'required'],
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
        $key="mp:setup:app:android";
        $rs=json_decode($redis->get($key),true);
        $row['AndroidVersion']=$rs['android'];
        $model= new AndroidVersion();
        $model->load($row);
        return $model;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'apkname'=>'版本名称',
            'versioncode'=>'版本号',
            'md5'=>'MD5密匙',
            'apkurl'=>'下载地址',
            'description'=>'版本描述',
            'isupdate'=>'是否强制更新',
            'isStopUpdate'=>'是否停止更新',
        ];
    }
}