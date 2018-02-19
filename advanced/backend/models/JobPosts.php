<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "job_posts".
 *
 * @property int $id
 * @property int $job_type_id
 * @property string $unique_job_number
 * @property string $job_title
 * @property string $job_description
 * @property int $job_governing_id
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
 * @property DocumentsRequired[] $documentsRequireds
 * @property JobTypes $jobType
 */
class JobPosts extends \yii\db\ActiveRecord {

    public $documents_required;
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
            [['job_type_id', 'job_title', 'job_description', 'job_governing_id','apply_url', 'start_date', 'end_date'], 'required'],
            [['job_type_id', 'job_governing_id', 'is_published', 'is_deleted', 'updated_by', 'created_by'], 'integer'],
            [['job_description'], 'string'],
            [['start_date', 'end_date', 'updated_on', 'created_on', 'documents_required'], 'safe'],
            [['unique_job_number'], 'string', 'max' => 50],
            [['job_title', 'qualification', 'apply_url'], 'string', 'max' => 250],
            [['unique_job_number'], 'unique'],
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
            'documents_required' => Yii::t( 'app', 'Required Documents' ),
            'job_governing_id' => Yii::t('app', 'Job Governing')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentsRequireds() {
        return $this->hasMany(DocumentsRequired::className(), ['job_post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobType() {
        return $this->hasOne(JobTypes::className(), ['id' => 'job_type_id']);
    }
    
    public function getJobGoverning() {
        return $this->hasOne(JobGoverning::className(), ['id' => 'job_governing_id']);
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);

        if ($insert) {
            $this->created_by = Yii::$app->user->id;
            $this->created_on = date('Y-m-d H:i:s');
        }

        $this->start_date = \Yii::$app->common->convertDateFormat($this->start_date);
        $this->end_date = \Yii::$app->common->convertDateFormat($this->end_date);
        $this->updated_on = date('Y-m-d H:i:s');
        $this->updated_by = Yii::$app->user->id;

        return true;
    }
}
