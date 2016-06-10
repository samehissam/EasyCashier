<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "citem".
 *
 * @property integer $item_id
 * @property string $item_name
 * @property string $item_cost
 * @property integer $category_id
 *
 * @property Ctransaction[] $ctransactions
 */
class Citem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'citem';
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
    public function getCtransactions()
    {
        return $this->hasMany(Ctransaction::className(), ['item_item_id' => 'item_id']);
    }

     public function getCcategory()
    {
       
        return $this->hasOne(Ccategory::className(), ['category_id' => 'category_id']);
    }
}
