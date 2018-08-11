<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "event_status".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Event[] $events
 */
class BaseEventStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event_status';
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
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['event_status_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return BaseEventStatusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BaseEventStatusQuery(get_called_class());
    }
}
