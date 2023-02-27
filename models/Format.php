<?php

namespace app\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "format".
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property int|null $ord
 *
 * @property StuffFormat[] $stuffFormats
 * @property Stuff[] $stuffs
 */
class Format extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'format';
    }

    public function behaviors()
    {
        return [
            ['class' => SluggableBehavior::class, 'attribute' => 'name']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['ord'], 'integer'],
            [['slug', 'name'], 'string', 'max' => 255],
            [['slug'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => 'Slug',
            'name' => 'Name',
            'ord' => 'Ord',
        ];
    }

    /**
     * Gets query for [[StuffFormats]].
     *
     * @return \yii\db\ActiveQuery|StuffFormatQuery
     */
    public function getStuffFormats()
    {
        return $this->hasMany(StuffFormat::class, ['format_id' => 'id']);
    }

    /**
     * Gets query for [[Stuffs]].
     *
     * @return \yii\db\ActiveQuery|StuffQuery
     */
    public function getStuffs()
    {
        return $this->hasMany(Stuff::class, ['id' => 'stuff_id'])->viaTable('stuff_format', ['format_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return FormatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FormatQuery(get_called_class());
    }
}
