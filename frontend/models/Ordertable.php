<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ordertable".
 *
 * @property integer $id
 * @property integer $order_tabe
 */
class Ordertable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ordertable';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_tabe'], 'required'],
            [['id', 'order_tabe'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_tabe' => 'Order Tabe',
        ];
    }
}
