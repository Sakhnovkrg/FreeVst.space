<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[StuffOs]].
 *
 * @see StuffOs
 */
class StuffOsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StuffOs[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StuffOs|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
