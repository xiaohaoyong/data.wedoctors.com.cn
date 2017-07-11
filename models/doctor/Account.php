<?php

namespace app\models\doctor;

use Yii;

/**
 * This is the model class for table "account".
 *
 * @property integer $id
 * @property integer $userid
 * @property integer $createtime
 * @property string $remarks
 * @property string $money
 * @property integer $type
 * @property integer $source
 */
class Account extends \yii\db\ActiveRecord
{
    public static $typeText=[1=>'增',2=>'减'];
    public static $sourceText=[
        1=>'公开课点评绩效奖励',
        2=>'病例研讨绩效奖励',
        3=>'线下培训绩效奖励',
        4=>'巡回义诊绩效奖励',
        5=>'线上培训绩效奖励',
        6=>'绩效提现',
        ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbus');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid','money', 'type', 'source'], 'required'],
            [['userid', 'createtime', 'type', 'source'], 'integer'],
            [['money'], 'number'],
            [['remarks'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => '用户ID',
            'createtime' => '添加时间',
            'remarks' => '备注',
            'money' => '钱',
            'type' => '类型',
            'source' => '来源',
        ];
    }
    public function beforeSave($insert)
    {
        if($insert)
        {
            $this->createtime=time();
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}
