<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Notifications;

/**
 * NotificationsSearch represents the model behind the search form of `backend\models\Notifications`.
 */
class NotificationsSearch extends Notifications {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'notification_type_id'], 'integer'],
            [['notification', 'is_read', 'created_on'], 'safe'],
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
        $query = Notifications::find();
        $query->joinWith(['notificationType']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
            'pagination' => ['pageSize' => 20]
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
            'notification_type_id' => $this->notification_type_id,
            'created_on' => $this->created_on,
        ]);

        $query->andFilterWhere(['like', 'notification', $this->notification])
                ->andFilterWhere(['like', 'is_read', $this->is_read]);

        return $dataProvider;
    }

}
