<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "crtransaction".
 *
 * @property integer $id
 * @property integer $qty
 * @property string $table_session
 * @property integer $item_item_id
 * @property string $total
 * @property integer $table_table_id
 * @property integer $user_id
 * @property string $order_status
 *
 * @property Ritem $itemItem
 */
class Crtransaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'crtransaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qty', 'item_item_id'], 'required'],
            [['qty', 'item_item_id', 'table_table_id', 'user_id'], 'integer'],
            [['table_session'], 'safe'],
           // [['total'], 'number'],
            [['order_status'], 'string', 'max' => 3],
            [['item_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ritem::className(), 'targetAttribute' => ['item_item_id' => 'item_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'qty' => 'الكمية',
            'table_session' => 'وقت الطلب',
            'item_item_id' => 'إسم الصنف',
            //'total' => 'Total',
            'table_table_id' => 'رقم المقعد',
            'user_id' => 'User ID',
            'order_status' => 'Order Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemItem()
    {
        return $this->hasOne(Ritem::className(), ['item_id' => 'item_item_id']);
    }
}
