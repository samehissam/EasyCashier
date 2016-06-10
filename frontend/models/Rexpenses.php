<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rexpenses".
 *
 * @property integer $expense_id
 * @property string $cost
 * @property string $description
 * @property string $date
 * @property integer $expense_type_id
 *
 * @property Rexpensetype $expenseType
 */
class Rexpenses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rexpenses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cost', 'expense_type_id'], 'required'],
            [['cost'], 'number'],
            [['date'], 'safe'],
            [['expense_type_id'], 'integer'],
            [['description'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'expense_id' => 'Expense ID',
            'cost' => 'التكلفة',
            'description' => 'تعليق',
            'date' => 'التاريخ',
            'expense_type_id' => 'وصف المصروف',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpenseType()
    {
        return $this->hasOne(Rexpensetype::className(), ['id' => 'expense_type_id']);
    }
}
