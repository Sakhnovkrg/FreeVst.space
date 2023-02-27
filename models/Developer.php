<?php

namespace app\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "developer".
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property string|null $url
 * @property string|null $donate_url
 *
 * @property Stuff[] $stuffs
 */
class Developer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'developer';
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
            [['slug', 'name', 'url', 'donate_url'], 'string', 'max' => 255],
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
            'url' => 'Url',
            'donate_url' => 'Donate Url',
        ];
    }

    /**
     * Gets query for [[Stuffs]].
     *
     * @return \yii\db\ActiveQuery|StuffQuery
     */
    public function getStuffs()
    {
        return $this->hasMany(Stuff::class, ['developer_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return DeveloperQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DeveloperQuery(get_called_class());
    }
}
