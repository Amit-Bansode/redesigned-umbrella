<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property int $id
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
 */
class Customers extends \yii\db\ActiveRecord {

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
            [['username', 'first_name', 'last_name', 'email_address', 'primary_contact_number'], 'required'],
            [['is_published', 'is_deleted'], 'integer'],
            [['updated_on', 'created_on'], 'safe'],
            [['username', 'first_name', 'last_name'], 'string', 'max' => 100],
            [['email_address'], 'string', 'max' => 50],
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
    
    public function beforeSave($insert) {
        parent::beforeSave($insert);
        
        if( TRUE == $insert ) {
            $this->created_on = date('Y-m-d H:i:s');
        }
        
        $this->updated_on = date('Y-m-d H:i:s');
        
        return TRUE;
    }

}
