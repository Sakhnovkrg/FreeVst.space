<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Stuff]].
 *
 * @see Stuff
 */
class StuffQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[active]]=1');
    }

    /**
     * {@inheritdoc}
     * @return Stuff[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Stuff|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
