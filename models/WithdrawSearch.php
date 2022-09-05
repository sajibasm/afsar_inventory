<?php

namespace app\models;

use app\components\DateTimeUtility;
use app\components\OutletUtility;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Withdraw;

/**
 * WithdrawSearch represents the model behind the search form about `app\models\Withdraw`.
 */
class WithdrawSearch extends Withdraw
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'bank_id', 'branch_id', 'outletId'], 'integer'],
            [['withdraw_amount'], 'number'],
            [['remarks', 'type', 'created_at', 'updated_at', 'created_to', 'status'], 'safe'],
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
     * @param bool $isToday
     * @return ActiveDataProvider
     */
    public function search($params, $isToday = false)
    {
        $query = Withdraw::find();
        $query->where(['outletId' => array_keys(OutletUtility::getUserOutlet())]);

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

        if(!Yii::$app->asm->can('index-full')){
            $query->andFilterWhere([
                'user_id' => Yii::$app->user->id,
            ]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'withdraw_amount' => $this->withdraw_amount,
            'outletId' => $this->outletId,
            'bank_id' => $this->bank_id,
            'branch_id' => $this->branch_id,
            'status' => $this->status
        ]);

        $query->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'type', $this->type]);


        if($isToday){
            $query->andFilterWhere(['>=', 'created_at', DateTimeUtility::getTodayStartTime()]);
            $query->andFilterWhere(['<=', 'created_at', DateTimeUtility::getTodayEndTime()]);
        }else{
            if(!empty($this->created_at)){
                $query->andFilterWhere(['>=', 'created_at', DateTimeUtility::getDate(DateTimeUtility::getStartTime(false, $this->created_at))]);
                $query->andFilterWhere(['<=', 'created_at', DateTimeUtility::getDate(DateTimeUtility::getEndTime(false, $this->created_to))]);
            }
        }

        $query->orderBy('id DESC');


        return $dataProvider;
    }
}
