<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AppliedJobs;

/**
 * AppliedJobsSearch represents the model behind the search form of `backend\models\AppliedJobs`.
 */
class AppliedJobsSearch extends AppliedJobs {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'is_locked', 'updated_by'], 'integer'],
            [['locked_on', 'customer_id', 'job_post_id', 'application_status_id', 'updated_on', 'created_on'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = AppliedJobs::find();
        $query->joinWith(['customers']);
        $query->joinWith('jobPost');
        $query->joinWith('applicationStatus');
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
            'locked_on' => $this->locked_on,
            'is_locked' => $this->is_locked,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
            'created_on' => $this->created_on,
        ]);
        
        //$query->where('OR', ['customers.first_name' => $this->customer_id, 'customers.last_name'=>$this->customer_id]);
        
        $query->andFilterWhere(['OR', [ 'like', 'customers.first_name', $this->customer_id], [ 'like', 'customers.last_name', $this->customer_id]]);
        $query->andFilterWhere(['like', 'job_posts.job_title', $this->job_post_id]);
        $query->andFilterWhere(['like', 'application_statuses.status', $this->application_status_id]);
        //echo '<pre>'; print_r($dataProvider); exit;
        return $dataProvider;
    }

}
