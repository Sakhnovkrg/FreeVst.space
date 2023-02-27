<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "tag".
 *
 * @property int $id
 * @property string $name
 * @property int $freq
 *
 * @property StuffTag[] $stuffTags
 * @property Stuff[] $stuffs
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['freq'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'freq' => 'Freq',
        ];
    }

    /**
     * Gets query for [[StuffTags]].
     *
     * @return \yii\db\ActiveQuery|StuffTagQuery
     */
    public function getStuffTags()
    {
        return $this->hasMany(StuffTag::class, ['tag_id' => 'id']);
    }

    /**
     * Gets query for [[Stuffs]].
     *
     * @return \yii\db\ActiveQuery|StuffQuery
     */
    public function getStuffs()
    {
        return $this->hasMany(Stuff::class, ['id' => 'stuff_id'])->viaTable('stuff_tag', ['tag_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return TagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TagQuery(get_called_class());
    }
}
