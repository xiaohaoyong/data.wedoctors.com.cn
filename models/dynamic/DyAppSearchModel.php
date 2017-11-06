<?php

namespace app\models\dynamic;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\dynamic\DyApp;

/**
 * DyAppSearchModel represents the model behind the search form about `app\models\dynamic\DyApp`.
 */
class DyAppSearchModel extends DyApp
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dynamicid', 'createtime', 'level'], 'integer'],
            [['title', 'ftitle', 'url'], 'safe'],
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
        $query = DyApp::find();

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
            'dynamicid' => $this->dynamicid,
            'createtime' => $this->createtime,
            'level' => $this->level,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'ftitle', $this->ftitle])
            ->andFilterWhere(['like', 'url', $this->url]);
        $query->orderBy([self::primaryKey()[0]=>SORT_DESC]);

        return $dataProvider;
    }
}
