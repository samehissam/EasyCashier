<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "datetest".
 *
 * @property integer $id
 * @property string $start
 * @property string $end
 * @property string $TestDay
 */
class DateTest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'datetest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start', 'end', 'TestDay'], 'required'],
            [['start', 'end', 'TestDay'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'start' => 'Start',
            'end' => 'End',
            'TestDay' => 'Test Day',
        ];
    }
}
