<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "documents_required".
 *
 * @property string $id
 * @property int $document_id
 * @property int $job_post_id
 *
 * @property JobPosts $jobPost
 * @property Documents $document
 */
class DocumentsRequired extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'documents_required';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['document_id', 'job_post_id'], 'required'],
            [['document_id', 'job_post_id'], 'integer'],
            [['job_post_id'], 'exist', 'skipOnError' => true, 'targetClass' => JobPosts::className(), 'targetAttribute' => ['job_post_id' => 'id']],
            [['document_id'], 'exist', 'skipOnError' => true, 'targetClass' => Documents::className(), 'targetAttribute' => ['document_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'document_id' => Yii::t('app', 'Document ID'),
            'job_post_id' => Yii::t('app', 'Job Post ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobPost() {
        return $this->hasOne(JobPosts::className(), ['id' => 'job_post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocument() {
        return $this->hasOne(Documents::className(), ['id' => 'document_id']);
    }

    public function getDocumentsByJobPostIds($intJobPostId) {

        $rows = (new \yii\db\Query())
                ->select(['documents.id', 'document_name'])
                ->from('documents')
                ->join('LEFT JOIN', 'documents_required', 'documents_required.document_id = documents.id')
                ->where(['job_post_id' => $intJobPostId])
                ->orderBy('documents.id ASC')
                ->all();
                
        $arrStrReturn = [];
        if( 0 < count($rows) ) {
            foreach ($rows AS $strDocument) {
                $arrStrReturn[$strDocument['id']] = $strDocument['document_name'];
            }            
        }
        
        return $arrStrReturn;
    }

}
