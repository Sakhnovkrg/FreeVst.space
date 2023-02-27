<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Os]].
 *
 * @see Os
 */
class OsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Os[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Os|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
