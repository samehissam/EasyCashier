<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tables".
 *
 * @property integer $id
 * @property integer $table_id
 * @property integer $order_table
 */
class Tables extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tables';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['table_id', 'order_table'], 'required'],
            [['table_id', 'order_table'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'table_id' => 'Table ID',
            'order_table' => 'Order Table',
        ];
    }
}
