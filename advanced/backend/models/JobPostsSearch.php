<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JobPosts;

/**
 * JobPostsSearch represents the model behind the search form of `app\models\JobPosts`.
 */
class JobPostsSearch extends JobPosts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'job_type_id', 'is_published', 'is_deleted', 'updated_by', 'created_by'], 'integer'],
            [['unique_job_number', 'job_title', 'job_description', 'qualification', 'apply_url', 'start_date', 'end_date', 'updated_on', 'created_on'], 'safe'],
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
        $query = JobPosts::find();

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
            'job_type_id' => $this->job_type_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'is_published' => $this->is_published,
            'is_deleted' => $this->is_deleted,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
            'created_by' => $this->created_by,
            'created_on' => $this->created_on,
        ]);

        $query->andFilterWhere(['like', 'unique_job_number', $this->unique_job_number])
            ->andFilterWhere(['like', 'job_title', $this->job_title])
            ->andFilterWhere(['like', 'job_description', $this->job_description])
            ->andFilterWhere(['like', 'qualification', $this->qualification])
            ->andFilterWhere(['like', 'apply_url', $this->apply_url]);

        return $dataProvider;
    }
}
