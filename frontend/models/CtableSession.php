<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ctable_session".
 *
 * @property integer $table_id
 * @property integer $table_state
 * @property string $session_start
 */
class CtableSession extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ctable_session';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['table_state'], 'integer'],
            [['session_start'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'table_id' => 'Table ID',
            'table_state' => 'Table State',
            'session_start' => 'Session Start',
        ];
    }
}
