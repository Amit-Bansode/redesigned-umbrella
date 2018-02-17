<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "job_posts".
 *
 * @property int $id
 * @property int $job_type_id
 * @property string $unique_job_number
 * @property string $job_title
 * @property string $job_description
 * @property string $qualification
 * @property string $apply_url
 * @property string $start_date
 * @property string $end_date
 * @property int $is_published
 * @property int $is_deleted
 * @property int $updated_by
 * @property string $updated_on
 * @property int $created_by
 * @property string $created_on
 *
 * @property JobTypes $jobType
 */
class JobPosts extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'job_posts';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['job_type_id', 'job_title', 'job_description', 'apply_url', 'start_date', 'end_date', 'updated_by', 'created_by'], 'required'],
            [['job_type_id', 'is_published', 'is_deleted', 'updated_by', 'created_by'], 'integer'],
            [['job_description', 'qualification'], 'string'],
            [['start_date', 'end_date', 'updated_on', 'created_on'], 'safe'],
            [['job_title', 'apply_url'], 'string', 'max' => 250],
            [['job_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => JobTypes::className(), 'targetAttribute' => ['job_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'job_type_id' => Yii::t('app', 'Job Type ID'),
            'unique_job_number' => Yii::t('app', 'Unique Job Number'),
            'job_title' => Yii::t('app', 'Job Title'),
            'job_description' => Yii::t('app', 'Job Description'),
            'qualification' => Yii::t('app', 'Qualification'),
            'apply_url' => Yii::t('app', 'Apply Url'),
            'start_date' => Yii::t('app', 'Start Date'),
            'end_date' => Yii::t('app', 'End Date'),
            'is_published' => Yii::t('app', 'Is Published'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_on' => Yii::t('app', 'Created On'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobType() {
        return $this->hasOne(JobTypes::className(), ['id' => 'job_type_id']);
    }
    

}
