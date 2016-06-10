<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rtransaction".
 *
 * @property integer $id
 * @property integer $invoice_id
 * @property integer $qty
 * @property string $date
 * @property integer $item_item_id
 * @property string $total
 *
 * @property Ritem $itemItem
 */
class Rtransaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rtransaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoice_id', 'qty', 'item_item_id'], 'integer'],
            [['qty', 'item_item_id','user_id'], 'integer'],
            //[['table_session'], 'safe'],
           // [['total'], 'number'],
            [['date'], 'safe'],
            [['order_status'], 'string', 'max' => 3],
            [['item_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ritem::className(), 'targetAttribute' => ['item_item_id' => 'item_id']],
            
           // [['total'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoice_id' => 'رقم الفاتورة',
            'qty' => 'الكمية',
            'date' => 'التاريخ',
            'item_item_id' => 'إسم الصنف',
          //  'total' => 'Total',
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
