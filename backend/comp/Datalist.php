<?php

namespace app\comp;

use yii\helpers\ArrayHelper;

/**
 *
 */
class Datalist
{
    public function getBoxListaja()
    {
        $datas = \backend\models\Box::find()->all();
        
        foreach ($datas as $key => $value) {
            $data[$value['id_box']] = $value['no_box'];

        }
        
        return $data;
    }


    
    
}
