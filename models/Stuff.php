<?php

namespace app\models;

use himiklab\sitemap\behaviors\SitemapBehavior;
use Imagine\Image\ManipulatorInterface;
use mohorev\file\UploadImageBehavior;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;

/**
 * This is the model class for table "stuff".
 *
 * @property int $id
 * @property int $category_id
 * @property int $developer_id
 * @property string $slug
 * @property string $name
 * @property string|null $description
 * @property string|null $text
 * @property string|null $url
 * @property string|null $youtube_url
 * @property string|null $download_url
 * @property string|null $version
 * @property string|null $image
 * @property int $created_at
 * @property int $updated_at
 * @property int $hits
 * @property int $downloads
 * @property int $likes
 * @property int $comments
 * @property int $active
 *
 * @property Category $category
 * @property Developer $developer
 * @property Format[] $formats
 * @property Os[] $os
 * @property StuffFormat[] $stuffFormats
 * @property StuffOs[] $stuffOs
 * @property StuffTag[] $stuffTags
 * @property Tag[] $tags
 */
class Stuff extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stuff';
    }

    public function behaviors()
    {
        return [
            ['class' => SluggableBehavior::class, 'attribute' => 'name'],
            ['class' => TimestampBehavior::class],
            'image' => [
                'class' => UploadImageBehavior::className(),
                'attribute' => 'image',
                'scenarios' => ['insert', 'update'],
                'placeholder' => '@webroot/img/nophoto600x400.png',
                'path' => '@webroot/uploads/stuff/{id}',
                'url' => '@web/uploads/stuff/{id}',
                'thumbs' => [
                    'thumb' => ['height' => 400, 'mode' => ManipulatorInterface::THUMBNAIL_OUTBOUND],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'developer_id', 'name'], 'required'],
            [['category_id', 'developer_id', 'created_at', 'updated_at', 'active', 'hits', 'downloads', 'likes', 'comments'], 'integer'],
            [['text'], 'string'],
            [['slug', 'name', 'description', 'url', 'youtube_url', 'download_url', 'version'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['developer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Developer::class, 'targetAttribute' => ['developer_id' => 'id']],
            [['image'], 'string', 'max' => 255, 'on' => ['default']],
            [['image'], 'required', 'on' => ['insert']],
            [['image'], 'image', 'extensions' => 'png', 'on' => ['insert', 'update']],
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|CategoryQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Developer]].
     *
     * @return \yii\db\ActiveQuery|DeveloperQuery
     */
    public function getDeveloper()
    {
        return $this->hasOne(Developer::class, ['id' => 'developer_id']);
    }

    /**
     * Gets query for [[Formats]].
     *
     * @return \yii\db\ActiveQuery|FormatQuery
     */
    public function getFormats()
    {
        return $this->hasMany(Format::class, ['id' => 'format_id'])->viaTable('stuff_format', ['stuff_id' => 'id']);
    }

    /**
     * Gets query for [[Os]].
     *
     * @return \yii\db\ActiveQuery|OsQuery
     */
    public function getOs()
    {
        return $this->hasMany(Os::class, ['id' => 'os_id'])->viaTable('stuff_os', ['stuff_id' => 'id']);
    }

    /**
     * Gets query for [[StuffFormats]].
     *
     * @return \yii\db\ActiveQuery|StuffFormatQuery
     */
    public function getStuffFormats()
    {
        return $this->hasMany(StuffFormat::class, ['stuff_id' => 'id']);
    }

    /**
     * Gets query for [[StuffOs]].
     *
     * @return \yii\db\ActiveQuery|StuffOsQuery
     */
    public function getStuffOs()
    {
        return $this->hasMany(StuffOs::class, ['stuff_id' => 'id']);
    }

    /**
     * Gets query for [[StuffTags]].
     *
     * @return \yii\db\ActiveQuery|StuffTagQuery
     */
    public function getStuffTags()
    {
        return $this->hasMany(StuffTag::class, ['stuff_id' => 'id']);
    }

    /**
     * Gets query for [[Tags]].
     *
     * @return \yii\db\ActiveQuery|TagQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])->viaTable('stuff_tag', ['stuff_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return StuffQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StuffQuery(get_called_class());
    }
}
