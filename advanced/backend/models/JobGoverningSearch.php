<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\JobGoverning;

/**
 * JobGoverningSearch represents the model behind the search form of `backend\models\JobGoverning`.
 */
class JobGoverningSearch extends JobGoverning
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'is_published'], 'integer'],
            [['governing_name', 'created_on'], 'safe'],
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
        $query = JobGoverning::find();

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
            'is_published' => $this->is_published,
            'created_on' => $this->created_on,
        ]);

        $query->andFilterWhere(['like', 'governing_name', $this->governing_name]);

        return $dataProvider;
    }
}
