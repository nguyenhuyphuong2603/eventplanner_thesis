<?php

namespace app\models\base;

use app\models\Event;
use app\models\Profile;
use app\models\Task;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user".
 *
 * @property integer $user_id
 * @property string $username
 * @property string $password
 * @property integer $profile_id
 *
 * @property Assignment[] $assignments
 * @property Event[] $events
 * @property Note[] $notes
 * @property Task[] $tasks
 * @property Profile $profile
 */
class BaseUser extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_id'], 'integer'],
            [['username', 'password'], 'string', 'max' => 100],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'profile_id' => Yii::t('app', 'Profile ID'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getAssignments()
    {
        return $this->hasMany(Assignment::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['creator_id' => 'user_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getNotes()
    {
        return $this->hasMany(Note::className(), ['creator_id' => 'user_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['creator_id' => 'user_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return BaseUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BaseUserQuery(get_called_class());
    }
}
