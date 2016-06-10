<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ritem".
 *
 * @property integer $item_id
 * @property string $item_name
 * @property string $item_cost
 * @property integer $category_id
 *
 * @property Crtransaction[] $crtransactions
 * @property Rtransaction[] $rtransactions
 */
class Ritem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ritem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_name', 'item_cost', 'category_id'], 'required'],
            [['item_cost'], 'number'],
            [['category_id'], 'integer'],
            [['item_name'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_id' => 'Item ID',
            'item_name' => 'إسم المنتج',
            'item_cost' => 'الثمن',
            'category_id' => 'قسم المنتج',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrtransactions()
    {
        return $this->hasMany(Crtransaction::className(), ['item_item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRtransactions()
    {
        return $this->hasMany(Rtransaction::className(), ['item_item_id' => 'item_id']);
    }

     public function getRcategory()
    {
       
        return $this->hasOne(Rcategory::className(), ['category_id' => 'category_id']);
    }

}
