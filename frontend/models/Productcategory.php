<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productcategory".
 *
 * @property integer $ProductCategoryId
 * @property string $ProductCategoryName
 */
class Productcategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productcategory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ProductCategoryName'], 'required'],
            [['ProductCategoryName'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ProductCategoryId' => 'Product Category ID',
            'ProductCategoryName' => 'Product Category Name',
        ];
    }
}
