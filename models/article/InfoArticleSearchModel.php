<?php

namespace app\models\article;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\article\InfoArticle;

/**
 * InfoArticleSearchModel represents the model behind the search form about `app\models\article\InfoArticle`.
 */
class InfoArticleSearchModel extends InfoArticle
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'praiseNum', 'createtime', 'catid', 'dept', 'catpid', 'level', 'mediaid', 'timing', 'top', 'style', 'model'], 'integer'],
            [['title', 'content', 'author', 'source', 'image', 'vector'], 'safe'],
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
        $query = InfoArticle::find();

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
            'praiseNum' => $this->praiseNum,
            'createtime' => $this->createtime,
            'catid' => $this->catid,
            'dept' => $this->dept,
            'catpid' => $this->catpid,
            'level' => $this->level,
            'mediaid' => $this->mediaid,
            'timing' => $this->timing,
            'top' => $this->top,
            'style' => $this->style,
            'model' => $this->model,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'source', $this->source])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'vector', $this->vector]);
        $query->orderBy([self::primaryKey()[0]=>SORT_DESC]);

        return $dataProvider;
    }
}
