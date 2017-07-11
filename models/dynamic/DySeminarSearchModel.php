<?php

namespace app\models\dynamic;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\dynamic\DySeminar;

/**
 * DySeminarSearchModel represents the model behind the search form about `app\models\dynamic\DySeminar`.
 */
class DySeminarSearchModel extends DySeminar
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dynamicid', 'state', 'userid'], 'integer'],
            [['title', 'phase', 'content'], 'safe'],
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
        $query = DySeminar::find();

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
            'dynamicid' => $this->dynamicid,
            'state' => $this->state,
            'userid' => $this->userid,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'phase', $this->phase])
            ->andFilterWhere(['like', 'content', $this->content]);

        $query->orderBy([self::primaryKey()[0]=>SORT_DESC]);
        return $dataProvider;
    }
}
