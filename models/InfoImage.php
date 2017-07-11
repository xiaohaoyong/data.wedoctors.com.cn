<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "info_image".
 *
 * @property integer $id
 * @property integer $artid
 * @property string $description
 * @property string $image
 */
class InfoImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'info_image';
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
            [['artid'], 'integer'],
            [['description'], 'string', 'max' => 400],
            [['image'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'artid' => 'Artid',
            'description' => 'Description',
            'image' => 'Image',
        ];
    }
}
