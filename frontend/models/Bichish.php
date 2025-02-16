<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "bichish".
 *
 * @property int $id
 * @property int $material_id
 * @property float $quantity
 * @property string|null $color
 * @property int|null $qavat
 * @property int|null $soni
 * @property int|null $umumiy_soni
 * @property int|null $kroy
 * @property string|null $status
 * @property string|null $created_at
 * @property int|null $warehouse_id
 */
class Bichish extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bichish';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['material_id', 'quantity'], 'required'],
            [['material_id', 'qavat', 'soni', 'umumiy_soni', 'kroy', 'warehouse_id'], 'integer'],
            [['quantity'], 'number'],
            [['created_at'], 'safe'],
            [['color', 'status'], 'string', 'max' => 55],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'material_id' => 'Material ID',
            'quantity' => 'Quantity',
            'color' => 'Color',
            'qavat' => 'Qavat',
            'soni' => 'Soni',
            'umumiy_soni' => 'Umumiy Soni',
            'kroy' => 'Kroy',
            'status' => 'Status',
            'created_at' => 'Created At',
            'warehouse_id' => 'Warehouse ID',
        ];
    }
}
