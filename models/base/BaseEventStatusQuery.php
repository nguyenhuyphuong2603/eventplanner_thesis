<?php

namespace app\models\base;

/**
 * This is the ActiveQuery class for [[BaseEventStatus]].
 *
 * @see BaseEventStatus
 */
class BaseEventStatusQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return BaseEventStatus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BaseEventStatus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
