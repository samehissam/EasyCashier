<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invoic".
 *
 * @property integer $id
 * @property string $cost
 * @property integer $order_num
 * @property string $order_date
 */
class Invoic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_num'], 'required'],
            //[['cost'], 'number'],
            [['order_num'], 'integer'],
            [['order_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
           // 'cost' => 'Cost',
            'order_num' => 'Order Num',
            'order_date' => 'Order Date',
        ];
    }
}
