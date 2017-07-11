<?php

namespace app\models\dynamic;

use app\components\behavior\DynamicBehavior;
use Yii;

/**
 * This is the model class for table "dc_dynamic_seminar".
 *
 * @property integer $dynamicid
 * @property string $title
 * @property string $phase
 * @property integer $state
 * @property integer $userid
 * @property string $content
 */
class DySeminar extends \yii\db\ActiveRecord
{
    public $subid;
    public $main;

    public function behaviors()
    {
        $behaviors["main"]= [
            'class'=>DynamicBehavior::className(),
        ];
        return $behaviors;

    }

    public static $stateText=[-1=>'发布失败',0=>'发布中',1=>'未发布',2=>'发布成功'];
    public static $end_stateText=[1=>'是',0=>'否'];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dc_dynamic_seminar';
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
            [['dynamicid', 'title', 'content'], 'required'],
            [['dynamicid', 'state', 'userid'], 'integer'],
            [['content'], 'string'],
            [['ftitle'], 'string', 'max' => 20],

            [['title'], 'string', 'max' => 30],
            [['phase'], 'string', 'max' => 10],
            [['intro'], 'string', 'max' => 200],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dynamicid' => '动态ID',
            'title' => '标题',
            'ftitle'=>'副标题',
            'phase' => '期号',
            'pushstate' => '推送状态',

            'userid' => '专家用户',
            'content' => '内容',
            'subid' =>  '学院',
            'intro' =>  '简介'

        ];
    }
    public function afterDelete()
    {
        parent::afterDelete(); // TODO: Change the autogenerated stub
        $dynamic=Dynamic::findOne($this->dynamicid);
        if($dynamic)
        {
            $dynamic->delete();
        }
    }
}