<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $birthday
 * @property string $city
 * @property integer $id
 *
 * @property User[] $users
 */
class BaseProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['birthday'], 'safe'],
            [['firstname', 'lastname', 'email', 'city'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'firstname' => Yii::t('app', 'Firstname'),
            'lastname' => Yii::t('app', 'Lastname'),
            'email' => Yii::t('app', 'Email'),
            'birthday' => Yii::t('app', 'Birthday'),
            'city' => Yii::t('app', 'City'),
            'id' => Yii::t('app', 'ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['profile_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return BaseProfileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BaseProfileQuery(get_called_class());
    }
}
