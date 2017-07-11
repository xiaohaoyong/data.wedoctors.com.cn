<?php

namespace app\models\classes;

use Yii;

/**
 * This is the model class for table "cl_classes_lesson".
 *
 * @property integer $id
 * @property integer $classesid
 * @property integer $lessonid
 * @property integer $createtime
 * @property integer $state
 * @property integer $userid
 */
class ClassLesson extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cl_classes_lesson';
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
            [['classesid', 'lessonid', 'createtime', 'state', 'userid'], 'integer'],
            [['userid'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'classesid' => '课程表ID',
            'lessonid' => '课ID',
            'createtime' => '签到时间',
            'state' => '状态0,观看1,签到',
            'userid' => 'Userid',
        ];
    }
}
