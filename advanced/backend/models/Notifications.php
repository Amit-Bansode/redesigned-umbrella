<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notifications".
 *
 * @property int $notification_type_id
 * @property string $notification
 * @property int $is_read
 * @property string $created_on
 *
 * @property NotificationTypes $notificationType
 */
class Notifications extends \yii\db\ActiveRecord {

    public $count;
    
    const REGISTRATION = 1;
    const APPLIED_FOR_JOB = 2;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'notifications';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['notification_type_id', 'notification', 'created_on'], 'required'],
            [['notification_type_id'], 'integer'],
            [['created_on'], 'safe'],
            [['notification'], 'string', 'max' => 250],
            [['is_read'], 'string', 'max' => 1],
            [['notification_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => NotificationTypes::className(), 'targetAttribute' => ['notification_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'notification_type_id' => Yii::t('app', 'Notification Type ID'),
            'notification' => Yii::t('app', 'Notification'),
            'is_read' => Yii::t('app', 'Is Read'),
            'created_on' => Yii::t('app', 'Created On'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificationType() {
        return $this->hasOne(NotificationTypes::className(), ['id' => 'notification_type_id']);
    }

    public function fetchNotifications() {

        //$notifications = Notifications::findBySql('SELECT count(notification_type_id) AS count, notification_type_id FROM notifications WHERE created_on = CURDATE() GROUP BY notification_type_id, created_on')->all();
        $notifications = Notifications::findBySql('SELECT count(notification_type_id) AS count, notification_type_id FROM notifications GROUP BY notification_type_id, created_on')->all();
        $arrReturnNotification = [];
        $arrReturnNotification['count'] = 0;

        foreach ( $notifications AS $notification ) {
            $arrReturnNotification['count'] += $notification->count;
            $arrReturnNotification[$notification->notification_type_id] = $notification->count;
        }
        
        return $arrReturnNotification;
    }

}
