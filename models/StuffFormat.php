<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stuff_format".
 *
 * @property int $stuff_id
 * @property int $format_id
 *
 * @property Format $format
 * @property Stuff $stuff
 */
class StuffFormat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stuff_format';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stuff_id', 'format_id'], 'required'],
            [['stuff_id', 'format_id'], 'integer'],
            [['stuff_id', 'format_id'], 'unique', 'targetAttribute' => ['stuff_id', 'format_id']],
            [['format_id'], 'exist', 'skipOnError' => true, 'targetClass' => Format::class, 'targetAttribute' => ['format_id' => 'id']],
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
            'format_id' => 'Format ID',
        ];
    }

    /**
     * Gets query for [[Format]].
     *
     * @return \yii\db\ActiveQuery|FormatQuery
     */
    public function getFormat()
    {
        return $this->hasOne(Format::class, ['id' => 'format_id']);
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
     * @return StuffFormatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StuffFormatQuery(get_called_class());
    }
}
