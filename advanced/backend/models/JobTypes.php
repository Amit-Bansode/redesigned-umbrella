<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "job_types".
 *
 * @property int $id
 * @property string $job_type
 * @property int $is_published
 * @property int $updated_by
 * @property string $updated_on
 * @property int $created_by
 * @property string $created_on
 *
 * @property JobPosts[] $jobPosts
 */
class JobTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['job_type', 'updated_by', 'updated_on', 'created_by'], 'required'],
            [['is_published', 'updated_by', 'created_by'], 'integer'],
            [['updated_on', 'created_on'], 'safe'],
            [['job_type'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'job_type' => 'Job Type',
            'is_published' => 'Is Published',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobPosts()
    {
        return $this->hasMany(JobPosts::className(), ['job_type_id' => 'id']);
    }
}
