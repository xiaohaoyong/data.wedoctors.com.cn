<?php

namespace app\models\dynamic;

use Yii;

/**
 * This is the model class for table "dc_dynamic".
 *
 * @property integer $id
 * @property integer $userid
 * @property integer $createtime
 * @property integer $type
 * @property integer $source
 * @property integer $level
 * @property integer $yimaisource
 */
class Dynamic extends \yii\db\ActiveRecord
{
    public static $pushstateText=[-1=>'发布失败',0=>'发布中',1=>'未发布',2=>'发布成功'];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dc_dynamic';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbdc');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'createtime'], 'required'],
            [['userid', 'createtime', 'type', 'source', 'level'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '动态id',
            'userid' => '公众号',
            'createtime' => '动态创建时间',
            'type' => '用户名显示，1为实名，2为匿名',
            'source' => '动态来源，1为普通动态，3为转发，4为病例研讨班',
            'level' => '动态状态，0为线上，-1为用户删除，-2后台删除，-3后台手动屏蔽，-4敏感词匹配屏蔽',
        ];
    }
}
