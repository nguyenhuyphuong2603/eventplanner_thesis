<?php

namespace app\models\base;

use app\models\EventQuery;
use app\models\EventStatus;
use app\models\Task;
use app\models\User;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%event}}".
 *
 * @property integer $event_id
 * @property string $event_date
 * @property integer $creator_id
 * @property integer $reminder
 * @property string $description
 * @property integer $event_status_id
 * @property string $name
 *
 * @property EventStatus $eventStatus
 * @property User $creator
 * @property Task[] $tasks
 */
class BaseEvent extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%event}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'event_date', 'description'], 'required'],
            [['event_date'], 'safe'],
            [['creator_id', 'reminder', 'event_status_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 150],
            [['event_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventStatus::className(), 'targetAttribute' => ['event_status_id' => 'id']],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['creator_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'event_id' => Yii::t('app', 'Event ID'),
            'event_date' => Yii::t('app', 'Event Date'),
            'creator_id' => Yii::t('app', 'Creator ID'),
            'reminder' => Yii::t('app', 'Reminder'),
            'description' => Yii::t('app', 'Description'),
            'event_status_id' => Yii::t('app', 'Event Status ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getEventStatus()
    {
        return $this->hasOne(EventStatus::className(), ['id' => 'event_status_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['user_id' => 'creator_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['event_id' => 'event_id']);
    }

    /**
     * @inheritdoc
     * @return EventQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EventQuery(get_called_class());
    }
}
