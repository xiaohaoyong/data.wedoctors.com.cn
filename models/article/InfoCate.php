<?php

namespace app\models\article;

use Yii;

/**
 * This is the model class for table "info_category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $pid
 * @property string $pids
 * @property integer $createtime
 * @property integer $level
 */
class InfoCate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'info_category';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('dbzx');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'name'], 'required'],

            [['pid', 'createtime', 'level'], 'integer'],
            [['name', 'pids'], 'string', 'max' => 20],
            ['pid', 'default', 'value' => 0]


        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'pid' => '父类',
            'pids' => '父类集',
            'createtime' => '创建时间',
            'level' => '数据状态',
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
