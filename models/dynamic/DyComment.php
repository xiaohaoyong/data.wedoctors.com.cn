<?php

namespace app\models\dynamic;

use Yii;

/**
 * This is the model class for table "dc_comment".
 *
 * @property string $id
 * @property string $userid
 * @property string $touserid
 * @property string $content
 * @property integer $type
 * @property string $dynamicid
 * @property integer $level
 * @property string $createtime
 * @property string $pid
 * @property integer $source
 * @property string $parentid
 */
class DyComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dc_comment';
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
            [['userid', 'touserid', 'content', 'dynamicid', 'createtime'], 'required'],
            [['userid', 'touserid', 'type', 'dynamicid', 'level', 'createtime', 'pid', 'source', 'parentid'], 'integer'],
            [['content'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '动态评论主表id',
            'userid' => '用户id',
            'touserid' => '被评论用户id',
            'content' => '评论内容',
            'type' => '用户名称状态，1为实名，2为匿名',
            'dynamicid' => '评论动态id',
            'level' => '评论显示状态，1为含敏感词评论，0为正常显示，-1用户删除，-2后台删除',
            'createtime' => '评论时间',
            'pid' => '被评论的评论id',
            'source' => '评论来源',
            'parentid' => '顶级评论ID',
        ];
    }
}
