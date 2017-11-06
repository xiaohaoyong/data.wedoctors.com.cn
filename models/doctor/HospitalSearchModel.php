<?php

namespace app\models\doctor;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\doctor\Hospital;

/**
 * HospitalSearchModel represents the model behind the search form about `app\models\doctor\Hospital`.
 */
class HospitalSearchModel extends Hospital
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'province', 'city', 'county', 'type', 'rank', 'nature', 'createtime'], 'integer'],
            [['name'], 'safe'],
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
        $query = Hospital::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'province' => $this->province,
            'city' => $this->city,
            'county' => $this->county,
            'type' => $this->type,
            'rank' => $this->rank,
            'nature' => $this->nature,
            'createtime' => $this->createtime,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->orderBy([self::primaryKey()[0]=>SORT_DESC]);

        return $dataProvider;
    }
}
