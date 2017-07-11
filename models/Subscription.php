<?php

namespace app\models;

use app\components\helper\HuanxinUserHelper;
use Yii;

/**
 * This is the model class for table "subscription".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $type
 * @property integer $level
 * @property integer $addtime
 * @property string $img
 * @property integer $attr
 * @property integer $sname

 * @property integer $subject
 */
class Subscription extends \yii\db\ActiveRecord
{
    public static $levelText=[1=>'已审核',0=>'未审核',-1=>'已删除'];
    public static $typeText=[1=>'拉手学院',2=>'轻应用',3=>'媒体号'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscription';
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
            [['id', 'name', 'description', 'img'], 'required'],
            [['id', 'type', 'level', 'addtime', 'attr','subject'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['sname'],'string','max'=>20],

            [['description'], 'string', 'max' => 255],
            [['img'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '公众号ID',
            'name' => '名称',
            'description' => '简介',
            'type' => '类型',
            'level' => '数据状态',
            'addtime' => '注册时间',
            'img' => '头像',
            'attr' => '属性',
            'subject'=>'分类',
            'sname'=>'三方名称'
        ];
    }

    public function beforeSave($insert)
    {
        if(!$this->sname)
        {
            $this->sname="官方账号";
        }
        if(!$this->subject)
        {
            $this->subject=0;
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function afterSave($insert, $changedAttributes)
    {
        if($insert){
            HuanxinUserHelper::getUserInfo($this->id,$this->type);
        }
    }

    public function afterDelete()
    {
        parent::afterDelete(); // TODO: Change the autogenerated stub
        Users::findOne($this->id)->delete();
        UserInfo::findOne(['userid'=>$this->id])->delete();
    }
}