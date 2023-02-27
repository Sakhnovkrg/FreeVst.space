<?php

namespace app\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "os".
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property int|null $ord
 *
 * @property StuffOs[] $stuffOs
 * @property Stuff[] $stuffs
 */
class Os extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'os';
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

    public function behaviors()
    {
        return [
            ['class' => SluggableBehavior::class, 'attribute' => 'name']
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
     * Gets query for [[StuffOs]].
     *
     * @return \yii\db\ActiveQuery|StuffOsQuery
     */
    public function getStuffOs()
    {
        return $this->hasMany(StuffOs::class, ['os_id' => 'id']);
    }

    /**
     * Gets query for [[Stuffs]].
     *
     * @return \yii\db\ActiveQuery|StuffQuery
     */
    public function getStuffs()
    {
        return $this->hasMany(Stuff::class, ['id' => 'stuff_id'])->viaTable('stuff_os', ['os_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return OsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OsQuery(get_called_class());
    }
}
