<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "person_tb".
 *
 * @property integer $id_person
 * @property string $name_person
 * @property string $zona
 * @property string $rt
 * @property string $blok
 * @property string $no_rumah
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $imageFile;

    public static function tableName()
    {
        return 'person_tb';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_person'], 'integer'],
            // [['imageFile'],'file'],
            // [['imageFile'],'required'],
            [['name_person'], 'string', 'max' => 255],
            [['zona'], 'string', 'max' => 5],
            [['rt'], 'string', 'max' => 10],
            [['no_rumah'], 'string', 'max' => 10],
            [['blok'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_person' => 'Id Person',
            'name_person' => 'Name Person',
            'zona' => 'Zona',
            'rt' => 'Rt',
            'blok' => 'Blok',
            'no_rumah' => 'No Rumah',
        ];
    }
}
