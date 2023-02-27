<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stuff_os".
 *
 * @property int $stuff_id
 * @property int $os_id
 *
 * @property Os $os
 * @property Stuff $stuff
 */
class StuffOs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stuff_os';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stuff_id', 'os_id'], 'required'],
            [['stuff_id', 'os_id'], 'integer'],
            [['stuff_id', 'os_id'], 'unique', 'targetAttribute' => ['stuff_id', 'os_id']],
            [['os_id'], 'exist', 'skipOnError' => true, 'targetClass' => Os::class, 'targetAttribute' => ['os_id' => 'id']],
            [['stuff_id'], 'exist', 'skipOnError' => true, 'targetClass' => Stuff::class, 'targetAttribute' => ['stuff_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'stuff_id' => 'Stuff ID',
            'os_id' => 'Os ID',
        ];
    }

    /**
     * Gets query for [[Os]].
     *
     * @return \yii\db\ActiveQuery|OsQuery
     */
    public function getOs()
    {
        return $this->hasOne(Os::class, ['id' => 'os_id']);
    }

    /**
     * Gets query for [[Stuff]].
     *
     * @return \yii\db\ActiveQuery|StuffQuery
     */
    public function getStuff()
    {
        return $this->hasOne(Stuff::class, ['id' => 'stuff_id']);
    }

    /**
     * {@inheritdoc}
     * @return StuffOsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StuffOsQuery(get_called_class());
    }
}
