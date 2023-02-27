<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[StuffTag]].
 *
 * @see StuffTag
 */
class StuffTagQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StuffTag[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StuffTag|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
