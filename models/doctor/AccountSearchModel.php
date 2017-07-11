<?php

namespace app\models\doctor;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\doctor\Account;

/**
 * AccountSearchModel represents the model behind the search form about `app\models\doctor\Account`.
 */
class AccountSearchModel extends Account
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'userid', 'createtime', 'type', 'source'], 'integer'],
            [['remarks'], 'safe'],
            [['money'], 'number'],
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
        $query = Account::find();

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
            'userid' => $this->userid,
            'createtime' => $this->createtime,
            'money' => $this->money,
            'type' => $this->type,
            'source' => $this->source,
        ]);

        $query->andFilterWhere(['like', 'remarks', $this->remarks]);
        $query->orderBy([self::primaryKey()[0]=>SORT_DESC]);

        return $dataProvider;
    }
}
