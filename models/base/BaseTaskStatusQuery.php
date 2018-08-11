<?php

namespace app\models\base;

/**
 * This is the ActiveQuery class for [[BaseTaskStatus]].
 *
 * @see BaseTaskStatus
 */
class BaseTaskStatusQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return BaseTaskStatus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BaseTaskStatus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
