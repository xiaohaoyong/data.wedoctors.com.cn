<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 17/4/8
 * Time: 下午1:58
 */

namespace app\models;


use app\components\vendor\RedisConnection;
use yii\base\Model;

class Push extends Model{

    public $id;

    public $type;

    public $childs;

    private $data;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'childs'], 'required'],
        ];
    }


    public function run()
    {
        $this->data_array();
        return $this->save();
    }

    private function data_array()
    {

        if(in_array('all',$this->childs))
        {
            $this->data[] = 'all';
            return ;
        }

        foreach($this->childs as $k=>$v)
        {
            preg_match('/([a-z]+)-([0-9]+)/',$v,$m);
            if($m[1]) {
                $this->data[$m[1]][] = $m[2];
            }
        }
    }

    private function save()
    {

        $task_array['id']=$this->id;
        $task_array['type']=$this->type;
        $task_array['data']=$this->data;

        $redis=\Yii::$app->rdmp;
        //病历研讨班推送队列
        $taskstr=json_encode($task_array);
        $key="wedoctors:list:task";
        $redis->rpush($key,'push|%huanxin|@'.$taskstr);
        return true;
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'follow' => '关注用户',
            'subject' => '科室',
            'area' => '地区',
            'usertype' => '用户类型',
        ];
    }
} 