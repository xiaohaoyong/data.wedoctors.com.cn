<?php

namespace app\models\doctor;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\doctor\Point;

/**
 * PointSearchModel represents the model behind the search form about `app\models\doctor\Point`.
 */
class PointSearchModel extends Point
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'point', 'createtime', 'userid', 'source', 'type'], 'integer'],
            [['remarks'], 'safe'],
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
        $query = Point::find();

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
            'point' => $this->point,
            'createtime' => $this->createtime,
            'userid' => $this->userid,
            'source' => $this->source,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'remarks', $this->remarks]);
        $query->orderBy([self::primaryKey()[0]=>SORT_DESC]);

        return $dataProvider;
    }
}
