<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Customers;

/**
 * CustomersSearch represents the model behind the search form of `backend\models\Customers`.
 */
class CustomersSearch extends Customers {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'is_published', 'is_deleted'], 'integer'],
            [['unique_id', 'username', 'first_name', 'last_name', 'email_address', 'primary_contact_number', 'password', 'updated_on', 'created_on'], 'safe'],
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
        $query = Customers::find();

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
            'is_deleted' => $this->is_deleted,
            'updated_on' => $this->updated_on,
            'created_on' => $this->created_on,
        ]);

        $query->andFilterWhere(['like', 'unique_id', $this->unique_id])
                ->andFilterWhere(['like', 'username', $this->username])
                ->andFilterWhere(['like', 'first_name', $this->first_name])
                ->andFilterWhere(['like', 'last_name', $this->last_name])
                ->andFilterWhere(['like', 'email_address', $this->email_address])
                ->andFilterWhere(['like', 'primary_contact_number', $this->primary_contact_number])
                ->andFilterWhere(['like', 'password', $this->password]);

        return $dataProvider;
    }

}
