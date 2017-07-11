<?php

namespace app\models\dynamic;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\dynamic\DyOpen;

/**
 * DyOpenSearchModel represents the model behind the search form about `app\models\dynamic\DyOpen`.
 */
class DyOpenSearchModel extends DyOpen
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dynamicid', 'userid', 'starttime'], 'integer'],
            [['title', 'intro', 'video'], 'safe'],
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
        $query = DyOpen::find();

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
            'userid' => $this->userid,
            'starttime' => $this->starttime,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'intro', $this->intro])
            ->andFilterWhere(['like', 'video', $this->video]);
        $query->orderBy([self::primaryKey()[0]=>SORT_DESC]);

        return $dataProvider;
    }
}
