<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BoxTrans;

/**
 * BoxTransSearch represents the model behind the search form about `backend\models\BoxTrans`.
 */
class BoxTransSearch extends BoxTrans
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_trans', 'id_box', 'id_person', 'value_trans', 'year_trans', 'created_at', 'created_by'], 'integer'],
            [['month_trans'],'safe'],
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
        $query = BoxTrans::find();

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
            'id_trans' => $this->id_trans,
            'id_box' => $this->id_box,
            'id_person' => $this->id_person,
            'value_trans' => $this->value_trans,
            'month_trans' => $this->month_trans,
            'year_trans' => $this->year_trans,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
        ]);

        return $dataProvider;
    }


    public function searchbulanan($params)
    {
        $query = BoxTrans::find()->select('sum(value_trans) as value_trans, month_trans, year_trans')->groupBy(['month_trans','year_trans'])->orderBy(['(month_trans)' => SORT_ASC]);

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
            'id_trans' => $this->id_trans,
            'id_box' => $this->id_box,
            'id_person' => $this->id_person,
            'value_trans' => $this->value_trans,
            'month_trans' => $this->month_trans,
            'year_trans' => $this->year_trans,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
        ]);

        return $dataProvider;
    }


    public function searchtahunan($params)
    {
        $query = BoxTrans::find()->select('sum(value_trans) as value_trans, year_trans')->groupBy(['year_trans'])->orderBy(['(year_trans)' => SORT_ASC]);

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
            'id_trans' => $this->id_trans,
            'id_box' => $this->id_box,
            'id_person' => $this->id_person,
            'value_trans' => $this->value_trans,
            'month_trans' => $this->month_trans,
            'year_trans' => $this->year_trans,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
        ]);

        return $dataProvider;
    }
}
