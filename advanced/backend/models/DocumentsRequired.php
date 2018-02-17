<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "documents_required".
 *
 * @property string $id
 * @property int $document_id
 * @property int $job_post_id
 */
class DocumentsRequired extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'documents_required';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'document_id', 'job_post_id'], 'required'],
            [['id', 'document_id', 'job_post_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'document_id' => Yii::t('app', 'Document ID'),
            'job_post_id' => Yii::t('app', 'Job Post ID'),
        ];
    }
}
