<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Person;

/**
 * PersonSearch represents the model behind the search form about `backend\models\Person`.
 */
class PersonSearch extends Person
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_person'], 'integer'],
            [['name_person', 'zona', 'rt', 'blok', 'no_rumah'], 'safe'],
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
        $query = Person::find();

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
            'id_person' => $this->id_person,
        ]);

        $query->andFilterWhere(['like', 'name_person', $this->name_person])
            ->andFilterWhere(['like', 'zona', $this->zona])
            ->andFilterWhere(['like', 'rt', $this->rt])
            ->andFilterWhere(['like', 'blok', $this->blok])
            ->andFilterWhere(['like', 'no_rumah', $this->no_rumah]);

        return $dataProvider;
    }
}
