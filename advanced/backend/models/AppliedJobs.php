<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "applied_jobs".
 *
 * @property int $id
 * @property int $customer_id
 * @property int $job_post_id
 * @property int $application_status_id
 * @property string $locked_on
 * @property int $is_locked
 * @property int $updated_by
 * @property string $updated_on
 * @property string $created_on
 *
 * @property ApplicationStatuses $applicationStatus
 * @property Customers $customer
 * @property JobPosts $jobPost
 */
class AppliedJobs extends \yii\db\ActiveRecord {

    public $documents_uploaded;
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'applied_jobs';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['customer_id', 'job_post_id', 'created_on'], 'required'],
            [['is_locked', 'updated_by'], 'integer'],
            [['customer_id', 'job_post_id', 'application_status_id', 'locked_on', 'updated_on', 'created_on'], 'safe'],
            [['application_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationStatuses::className(), 'targetAttribute' => ['application_status_id' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customers::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['job_post_id'], 'exist', 'skipOnError' => true, 'targetClass' => JobPosts::className(), 'targetAttribute' => ['job_post_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'customer_id' => Yii::t('app', 'Customer Name'),
            'job_post_id' => Yii::t('app', 'Job Post Title'),
            'application_status_id' => Yii::t('app', 'Application Status'),
            'locked_on' => Yii::t('app', 'Locked On'),
            'is_locked' => Yii::t('app', 'Is Locked'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'created_on' => Yii::t('app', 'Created On'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getApplicationStatus() {
        return ( new AppliedJobs())->hasOne(ApplicationStatuses::className(), ['id' => 'application_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getCustomers() {
        return ( new AppliedJobs())->hasOne(Customers::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getJobPost() {
        return ( new AppliedJobs())->hasOne(JobPosts::className(), ['id' => 'job_post_id']);
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);
        
        if( FALSE == $insert ) {
            $this->updated_by = \Yii::$app->user->id;
            $this->updated_on = date('Y-m-d H:i:s');
        }
        
        return TRUE;
    }
}
