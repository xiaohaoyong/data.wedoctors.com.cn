<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Users;

/**
 * UsersSearchModel represents the model behind the search form about `app\models\Users`.
 */
class UsersSearchModel extends Users
{
    public $phone;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'level', 'type', 'createtime', 'state','phone'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Users::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $query->orderBy('id desc');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        //关联个人资料
        if($this->phone)
        {
            $query->joinWith('info');
        }
        if($this->phone)
        {
            $query->andFilterWhere([UserInfo::tableName().'.phone' => $this->phone]);
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'level' => $this->level,
            'type' => $this->type,
            'createtime' => $this->createtime,
            'state' => 0,
        ]);

        return $dataProvider;
    }
}
