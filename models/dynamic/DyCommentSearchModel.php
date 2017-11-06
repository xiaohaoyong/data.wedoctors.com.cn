<?php

namespace app\models\dynamic;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\dynamic\DyComment;

/**
 * DyCommentrSearchModel represents the model behind the search form about `app\models\dynamic\DyComment`.
 */
class DyCommentSearchModel extends DyComment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'userid', 'touserid', 'type', 'dynamicid', 'level', 'createtime', 'pid', 'source', 'parentid'], 'integer'],
            [['content'], 'safe'],
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
        $query = DyComment::find();

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
            'touserid' => $this->touserid,
            'type' => $this->type,
            'dynamicid' => $this->dynamicid,
            'level' => $this->level,
            'createtime' => $this->createtime,
            'pid' => $this->pid,
            'source' => $this->source,
            'parentid' => $this->parentid,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content]);
        $query->orderBy([self::primaryKey()[0]=>SORT_DESC]);

        return $dataProvider;
    }
}
