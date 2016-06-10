<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inventory".
 *
 * @property integer $InventoryId
 * @property integer $ProductQty
 * @property integer $ProductId
 */
class Inventory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inventory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ProductQty', 'ProductId'], 'required'],
            [['ProductQty', 'ProductId'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'InventoryId' => 'Inventory ID',
            'ProductQty' => 'الكمية المتاحة',
            'ProductId' => 'إسم المنتج',
        ];
    }

     public function getProductName()
    {
       
        return $this->hasOne(Product::className(), ['ProductId' => 'ProductId']);
    }
}
