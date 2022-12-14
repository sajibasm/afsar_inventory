<?php

namespace app\modules\asm\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * ModulePermissionSearch represents the model behind the search form about `app\models\ModulePermission`.
 */
class ModulePermissionSearch extends ModulePermission
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'userId', 'module', 'module_action_id', 'createdBy'], 'integer'],
            [['code', 'createdAt'], 'safe'],
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
        $query = ModulePermission::find();

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
            'userId' => $this->userId,
            'module' => $this->module,
            'module_action_id' => $this->module_action_id,
            'createdAt' => $this->createdAt,
            'createdBy' => $this->createdBy,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
}
