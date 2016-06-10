<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cexpensetype".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Cexpenses[] $cexpenses
 */
class Cexpensetype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cexpensetype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCexpenses()
    {
        return $this->hasMany(Cexpenses::className(), ['expense_type_id' => 'id']);
    }
}
