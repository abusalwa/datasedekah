<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "box".
 *
 * @property integer $id_box
 * @property string $no_box
 * @property integer $id_person
 *
 * @property PersonTb $idPerson
 */
class Box extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $imageFile;
    
    public static function tableName()
    {
        return 'box';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_person'], 'integer'],
            [['no_box'], 'string', 'max' => 20],
            [['id_person'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['id_person' => 'id_person']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_box' => 'Id Box',
            'no_box' => 'No Box',
            'id_person' => 'Id Person',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPerson()
    {
        return $this->hasOne(Person::className(), ['id_person' => 'id_person']);
    }
}
