<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "task_status".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Task[] $tasks
 */
class BaseTaskStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['task_status_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return BaseTaskStatusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BaseTaskStatusQuery(get_called_class());
    }
}
