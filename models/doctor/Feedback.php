<?php

namespace app\models\doctor;

use Yii;

/**
 * This is the model class for table "feedback".
 *
 * @property integer $id
 * @property string $content
 * @property integer $createtime
 * @property integer $userid
 */
class Feedback extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedback';
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
            [['createtime', 'userid'], 'integer'],
            [['content'], 'string', 'max' => 249],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => '内容',
            'createtime' => '时间',
            'userid' => '用户',
        ];
    }
}
