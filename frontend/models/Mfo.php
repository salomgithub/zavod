<?php

namespace frontend\models;

use Yii;

class Mfo extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'mfo';
    }
    public function rules()
    {
        return [
            [['name'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'MFO',
        ];
    }

    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['color_id' => 'id']);
    }

}
