<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "documents".
 *
 * @property int $id
 * @property string $document_name
 * @property int $is_published
 * @property int $updated_by
 * @property string $updated_on
 * @property int $created_by
 * @property string $created_on
 *
 * @property DocumentsRequired[] $documentsRequireds
 */
class Documents extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'documents';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['document_name'], 'required'],
            [['is_published', 'updated_by', 'created_by'], 'integer'],
            [['updated_on', 'created_on'], 'safe'],
            [['document_name'], 'string', 'max' => 100],
            ['document_name', 'validateName', 'on' => 'create'],
            ['document_name', 'validateName', 'on' => 'update']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'document_name' => Yii::t('app', 'Document Name'),
            'is_published' => Yii::t('app', 'Is Published'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_on' => Yii::t('app', 'Created On'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentsRequireds() {
        return $this->hasMany(DocumentsRequired::className(), ['document_id' => 'id']);
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);

        if (TRUE == $insert) {
            $this->created_by = Yii::$app->user->id;
            $this->created_on = date('Y-m-d H:i:s');
        }

        $this->updated_by = Yii::$app->user->id;
        $this->updated_on = date('Y-m-d H:i:s');

        return TRUE;
    }

    public function validateName($attribute, $params, $validator) {

        if ('create' == $validator->on[0]) {

            $objDocuments = $this->findAll([ 'lower( ' . $attribute . ' ) ' => strtolower($this->document_name)]);

            if (0 >= count($objDocuments)) {
                return TRUE;
            }

            $this->addError($attribute, 'Document Name already exists.');
            return FALSE;
        } else {

            $objDocuments = $this->findAll([ 'lower( ' . $attribute . ' ) ' => strtolower($this->document_name)]);

            if (0 >= count($objDocuments)) {
                return TRUE;
            } elseif( 1 == count($objDocuments) && $objDocuments[0]->id == $this->id) {
                return TRUE;
            }

            $this->addError($attribute, 'Document Name already exists.');
            return FALSE;
        }

    }

}
