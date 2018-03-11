<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "notification_types".
 *
 * @property int $id
 * @property string $notification_type
 *
 * @property Notifications[] $notifications
 */
class NotificationTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notification_type'], 'required'],
            [['notification_type'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'notification_type' => Yii::t('app', 'Notification Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(Notifications::className(), ['notification_type_id' => 'id']);
    }
}
