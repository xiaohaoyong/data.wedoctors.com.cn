<?php

namespace app\models\dynamic;

use Yii;

/**
 * This is the model class for table "dc_praise".
 *
 * @property string $id
 * @property string $dynamicid
 * @property string $userid
 * @property integer $type
 * @property string $createtime
 * @property string $commentid
 * @property string $touserid
 * @property integer $source
 */
class DyPraise extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dc_praise';
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
            [['dynamicid', 'userid'], 'required'],
            [['dynamicid', 'userid', 'type', 'createtime', 'commentid', 'touserid', 'source'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dynamicid' => 'Dynamicid',
            'userid' => 'Userid',
            'type' => 'Type',
            'createtime' => 'Createtime',
            'commentid' => 'Commentid',
            'touserid' => 'Touserid',
            'source' => 'Source',
        ];
    }
}
