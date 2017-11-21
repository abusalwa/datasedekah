<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Box;

/**
 * BoxSearch represents the model behind the search form about `backend\models\Box`.
 */
class BoxSearch extends Box
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_box', 'id_person'], 'integer'],
            [['no_box'], 'safe'],
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
        $query = Box::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
            'pageSize' => 7,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_box' => $this->id_box,
            'id_person' => $this->id_person,
        ]);

        $query->andFilterWhere(['like', 'no_box', $this->no_box]);

        return $dataProvider;
    }
}
