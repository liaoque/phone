<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PhoneUsers;

/**
 * PhoneUsersSearch represents the model behind the search form of `backend\models\PhoneUsers`.
 */
class PhoneUsersSearch extends PhoneUsers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'phone_id', 'sex', 'age', 'phone_type_id'], 'integer'],
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
        $query = PhoneUsers::find();

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
            'phone_id' => $this->phone_id,
            'sex' => $this->sex,
            'age' => $this->age,
            'phone_type_id' => $this->phone_type_id,
        ]);

        return $dataProvider;
    }
}
