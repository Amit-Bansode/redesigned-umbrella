<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property int $id
 * @property string $unique_id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $email_address
 * @property string $primary_contact_number
 * @property string $password
 * @property int $is_published
 * @property int $is_deleted
 * @property string $updated_on
 * @property string $created_on
 *
 * @property AppliedJobs[] $appliedJobs
 */
class Customers extends \yii\db\ActiveRecord {

    public $documents_uploaded;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'customers';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['unique_id', 'username', 'first_name', 'last_name', 'email_address', 'primary_contact_number', 'password', 'updated_on', 'created_on'], 'required'],
            [['is_published', 'is_deleted'], 'integer'],
            [['updated_on', 'created_on'], 'safe'],
            [['unique_id', 'email_address'], 'string', 'max' => 50],
            [['username', 'first_name', 'last_name'], 'string', 'max' => 100],
            [['primary_contact_number'], 'string', 'max' => 10],
            [['password'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'unique_id' => Yii::t('app', 'Unique ID'),
            'username' => Yii::t('app', 'Username'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'email_address' => Yii::t('app', 'Email Address'),
            'primary_contact_number' => Yii::t('app', 'Primary Contact Number'),
            'password' => Yii::t('app', 'Password'),
            'is_published' => Yii::t('app', 'Is Published'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'created_on' => Yii::t('app', 'Created On'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppliedJobs() {
        return $this->hasMany(AppliedJobs::className(), ['customer_id' => 'id']);
    }

    public function beforeSave($insert) {
        parent::beforeSave($insert);

        if (TRUE == $insert) {
            $this->created_on = date('Y-m-d H:i:s');
        }

        $this->updated_on = date('Y-m-d H:i:s');

        return TRUE;
    }

}
