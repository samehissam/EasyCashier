<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ctransaction".
 *
 * @property integer $id
 * @property integer $qty
 * @property string $table_session
 * @property integer $item_item_id
 * @property string $total
 * @property integer $table_table_id
 *
 * @property Citem $itemItem
 */
class Ctransaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ctransaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qty', 'item_item_id'], 'required'],
            [['qty', 'item_item_id', 'table_table_id'], 'integer'],
            [['table_session'], 'safe'],
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
            'qty' => 'الكمية',
            'table_session' => 'وقت الطلب',
            'item_item_id' => 'إسم الصنف',
          //  'total' => 'Total',
            'table_table_id' => 'رقم المقعد',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemItem()
    {
        return $this->hasOne(Citem::className(), ['item_id' => 'item_item_id']);
    }
}
