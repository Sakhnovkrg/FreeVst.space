<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Developer]].
 *
 * @see Developer
 */
class DeveloperQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Developer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Developer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
