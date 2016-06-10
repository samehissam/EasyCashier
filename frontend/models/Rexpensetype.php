<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rexpensetype".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Rexpenses[] $rexpenses
 */
class Rexpensetype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rexpensetype';
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
    public function getRexpenses()
    {
        return $this->hasMany(Rexpenses::className(), ['expense_type_id' => 'id']);
    }
}
