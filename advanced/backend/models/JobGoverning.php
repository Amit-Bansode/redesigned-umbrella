<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "job_governing".
 *
 * @property int $id
 * @property string $governing_name
 * @property int $is_published
 * @property string $created_on
 *
 * @property JobPosts[] $jobPosts
 */
class JobGoverning extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job_governing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['governing_name', 'created_on'], 'required'],
            [['is_published'], 'integer'],
            [['created_on'], 'safe'],
            [['governing_name'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'governing_name' => Yii::t('app', 'Governing Name'),
            'is_published' => Yii::t('app', 'Is Published'),
            'created_on' => Yii::t('app', 'Created On'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobPosts()
    {
        return $this->hasMany(JobPosts::className(), ['job_governing_id' => 'id']);
    }
}
