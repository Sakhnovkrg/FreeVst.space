<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "stuff_tag".
 *
 * @property int $stuff_id
 * @property int $tag_id
 * @property int $ord
 *
 * @property Stuff $stuff
 * @property Tag $tag
 */
class StuffTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stuff_tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stuff_id', 'tag_id'], 'required'],
            [['stuff_id', 'tag_id', 'ord'], 'integer'],
            [['stuff_id', 'tag_id'], 'unique', 'targetAttribute' => ['stuff_id', 'tag_id']],
            [['stuff_id'], 'exist', 'skipOnError' => true, 'targetClass' => Stuff::class, 'targetAttribute' => ['stuff_id' => 'id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::class, 'targetAttribute' => ['tag_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'stuff_id' => 'Stuff ID',
            'tag_id' => 'Tag ID',
            'ord' => 'Ord',
        ];
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
     * Gets query for [[Tag]].
     *
     * @return \yii\db\ActiveQuery|TagQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::class, ['id' => 'tag_id']);
    }

    /**
     * {@inheritdoc}
     * @return StuffTagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StuffTagQuery(get_called_class());
    }
}
