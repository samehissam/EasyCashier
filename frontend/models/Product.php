<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $ProductId
 * @property string $ProductName
 * @property integer $ProductCategoryId
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ProductName', 'ProductCategoryId'], 'required'],
            [['ProductCategoryId'], 'integer'],
            [['ProductName'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ProductId' => 'Product ID',
            'ProductName' => 'Product Name',
            'ProductCategoryId' => '',
        ];
    }
}
