<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property int $user_type
 * @property string $username
 * @property string $email_address
 * @property string $password
 * @property string $password_hash
 * @property string $last_login_date
 * @property int $is_published
 * @property int $updated_by
 * @property string $updated_on
 * @property int $created_by
 * @property string $created_on
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_type', 'username', 'email_address', 'password', 'password_hash', 'updated_by', 'updated_on', 'created_by'], 'required'],
            [['user_type', 'is_published', 'updated_by', 'created_by'], 'integer'],
            [['last_login_date', 'updated_on', 'created_on'], 'safe'],
            [['username'], 'string', 'max' => 100],
            [['email_address', 'password'], 'string', 'max' => 150],
            [['password_hash'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_type' => Yii::t('app', 'User Type'),
            'username' => Yii::t('app', 'Username'),
            'email_address' => Yii::t('app', 'Email Address'),
            'password' => Yii::t('app', 'Password'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'last_login_date' => Yii::t('app', 'Last Login Date'),
            'is_published' => Yii::t('app', 'Is Published'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_on' => Yii::t('app', 'Created On'),
        ];
    }
}
