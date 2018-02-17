<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "documents".
 *
 * @property int $id
 * @property string $document_name
 * @property int $is_published
 * @property int $modified_by
 * @property string $modified_on
 * @property int $created_by
 * @property string $created_on
 */
class Documents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'documents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['document_name', 'modified_by', 'modified_on', 'created_by'], 'required'],
            [['is_published', 'modified_by', 'created_by'], 'integer'],
            [['modified_on', 'created_on'], 'safe'],
            [['document_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'document_name' => Yii::t('app', 'Document Name'),
            'is_published' => Yii::t('app', 'Is Published'),
            'modified_by' => Yii::t('app', 'Modified By'),
            'modified_on' => Yii::t('app', 'Modified On'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_on' => Yii::t('app', 'Created On'),
        ];
    }
}
