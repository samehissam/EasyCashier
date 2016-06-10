<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rcustomer".
 *
 * @property integer $CustomerId
 * @property string $CustomerName
 * @property string $CustomerPhone
 * @property string $CustomerAddress
 */
class Rcustomer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rcustomer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CustomerName', 'CustomerPhone', 'CustomerAddress'], 'required'],
            [['CustomerName', 'CustomerPhone', 'CustomerAddress'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CustomerId' => 'Customer ID',
            'CustomerName' => 'Customer Name',
            'CustomerPhone' => 'Customer Phone',
            'CustomerAddress' => 'Customer Address',
        ];
    }
}
