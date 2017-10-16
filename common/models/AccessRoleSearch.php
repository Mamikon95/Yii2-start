<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AccessRole;

/**
 * AccessRoleSearch represents the model behind the search form about `common\models\AccessRole`.
 */
class AccessRoleSearch extends AccessRole
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'role_id', 'access_id'], 'integer'],
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
        $query = AccessRole::find();

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
            'role_id' => $this->role_id,
            'access_id' => $this->access_id,
        ]);

        return $dataProvider;
    }
}
