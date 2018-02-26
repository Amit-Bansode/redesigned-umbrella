<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "application_statuses".
 *
 * @property int $id
 * @property string $status
 *
 * @property AppliedJobs[] $appliedJobs
 */
class ApplicationStatuses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'application_statuses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['status'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppliedJobs()
    {
        return $this->hasMany(AppliedJobs::className(), ['application_status_id' => 'id']);
    }
}
