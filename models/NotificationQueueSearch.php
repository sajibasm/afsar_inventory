<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\NotificationQueue;

/**
 * NotificationQueueSearch represents the model behind the search form about `app\models\NotificationQueue`.
 */
class NotificationQueueSearch extends NotificationQueue
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'queue', 'customerId', 'createdBy'], 'integer'],
            [['type', 'content', 'extra_params', 'status', 'message', 'createdAt', 'updatedAt'], 'safe'],
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
        $query = NotificationQueue::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'queue' => $this->queue,
            'customerId' => $this->customerId,
            'createdBy' => $this->createdBy,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'extra_params', $this->extra_params])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }
}
