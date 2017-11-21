<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "box_trans".
 *
 * @property integer $id_trans
 * @property integer $id_box
 * @property integer $id_person
 * @property integer $value_trans
 * @property integer $month_trans
 * @property integer $year_trans
 * @property integer $created_at
 * @property integer $created_by
 *
 * @property Box $idBox
 * @property PersonTb $idPerson
 */
class BoxTrans extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $imageFile;
    
    public static function tableName()
    {
        return 'box_trans';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_box', 'id_person', 'value_trans', 'month_trans', 'year_trans', 'created_at', 'created_by'], 'integer'],
            [['id_box'], 'exist', 'skipOnError' => true, 'targetClass' => Box::className(), 'targetAttribute' => ['id_box' => 'id_box']],
            [['id_person'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['id_person' => 'id_person']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_trans' => 'Id Trans',
            'id_box' => 'Id Box',
            'id_person' => 'Id Person',
            'value_trans' => 'Value Trans',
            'month_trans' => 'Month Trans',
            'year_trans' => 'Year Trans',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBox()
    {
        return $this->hasOne(Box::className(), ['id_box' => 'id_box']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPerson()
    {
        return $this->hasOne(Person::className(), ['id_person' => 'id_person']);
    }
}
