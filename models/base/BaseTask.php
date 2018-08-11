<?php

namespace app\models\base;

use app\models\Event;
use app\models\Task;
use app\models\TaskStatus;
use app\models\User;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\rbac\Assignment;


/**
 * This is the model class for table "task".
 *
 * @property integer $task_id
 * @property string $description
 * @property integer $event_id
 * @property string $duedate
 * @property integer $reminder
 * @property integer $parent_task_id
 * @property integer $creator_id
 * @property integer $task_status_id
 * @property string $note
 * @property string $name
 *
 * @property Assignment[] $assignments
 * @property Event $event
 * @property Task $parentTask
 * @property Task[] $tasks
 * @property TaskStatus $taskStatus
 * @property User $creator
 */
class BaseTask extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'name','duedate','event_id'], 'required'],
            [['description', 'note'], 'string'],
            [['event_id', 'reminder', 'parent_task_id', 'creator_id', 'task_status_id'], 'integer'],
            [['duedate'], 'safe'],
            [['name'], 'string', 'max' => 150],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'event_id']],
            [['parent_task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['parent_task_id' => 'task_id']],
            [['task_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaskStatus::className(), 'targetAttribute' => ['task_status_id' => 'id']],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['creator_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'task_id' => Yii::t('app', 'Task ID'),
            'description' => Yii::t('app', 'Description'),
            'event_id' => Yii::t('app', 'Event ID'),
            'duedate' => Yii::t('app', 'Duedate'),
            'reminder' => Yii::t('app', 'Reminder'),
            'parent_task_id' => Yii::t('app', 'Parent Task ID'),
            'creator_id' => Yii::t('app', 'Creator ID'),
            'task_status_id' => Yii::t('app', 'Task Status ID'),
            'note' => Yii::t('app', 'Note'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getAssignments()
    {
        return $this->hasMany(Assignment::className(), ['task_id' => 'task_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['event_id' => 'event_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getParentTask()
    {
        return $this->hasOne(Task::className(), ['task_id' => 'parent_task_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['parent_task_id' => 'task_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getTaskStatus()
    {
        return $this->hasOne(TaskStatus::className(), ['id' => 'task_status_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['user_id' => 'creator_id']);
    }

    /**
     * @inheritdoc
     * @return BaseTaskQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BaseTaskQuery(get_called_class());
    }
}
