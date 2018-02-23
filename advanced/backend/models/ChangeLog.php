<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "change_log".
 *
 * @property int $id
 * @property string $table_name
 * @property string $data
 * @property int $created_by
 * @property string $created_on
 */
class ChangeLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'change_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['table_name', 'data', 'created_by', 'created_on'], 'required'],
            [['data'], 'string'],
            [['created_by'], 'integer'],
            [['created_on'], 'safe'],
            [['table_name'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'table_name' => Yii::t('app', 'Table Name'),
            'data' => Yii::t('app', 'Data'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_on' => Yii::t('app', 'Created On'),
        ];
    }
}
