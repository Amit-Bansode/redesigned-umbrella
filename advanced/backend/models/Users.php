<?php

namespace backend\models;

use Yii;
use app\models\User;
/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property int $user_type user type considered 1 for super admin and 2 for admin users
 * @property string $username
 * @property string $email_address
 * @property string $password
 * @property string $password_hash
 * @property string $last_login_date
 * @property int $is_published
 * @property int $is_deleted 
 * @property int $updated_by
 * @property string $updated_on
 * @property int $created_by
 * @property string $created_on
 */
class Users extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['username', 'email_address', 'password'], 'required'],
            [['user_type', 'is_published', 'is_deleted', 'updated_by', 'created_by'], 'integer'],
            [['last_login_date', 'updated_on', 'created_on'], 'safe'],
            [['username'], 'string', 'max' => 100],
            [['email_address', 'password'], 'string', 'max' => 150],
            [['password_hash'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_type' => Yii::t('app', 'User Type'),
            'username' => Yii::t('app', 'Username'),
            'email_address' => Yii::t('app', 'Email Address'),
            'password' => Yii::t('app', 'Password'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'last_login_date' => Yii::t('app', 'Last Login Date'),
            'is_published' => Yii::t('app', 'Is Published'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_on' => Yii::t('app', 'Created On'),
        ];
    }
    
    public function beforeSave($insert) {
        parent::beforeSave($insert);
        
        if( TRUE == $insert ) {
            $this->user_type = 2;
            $this->created_by = Yii::$app->user->id;
            $this->created_on = date('Y-m-d H:i:s');
        }
        
        $objCommonUserModule = new \common\models\User();

        $objCommonUserModule->setPassword( $this->password );
        $this->password_hash = $objCommonUserModule->password_hash;
        $this->updated_by = Yii::$app->user->id;;
        $this->updated_on = date('Y-m-d H:i:s');
        return TRUE;
    }
}
