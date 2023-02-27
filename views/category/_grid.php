<?php
use yii\bootstrap5\LinkPager;

/** @var yii\web\View $this */
/** @var \yii\data\ActiveDataProvider $dataProvider */
/** @var \yii\data\Pagination $pagination */
/** @var \app\models\Stuff[] $models */
/** @var \app\models\Tag $tag */

$tagId = $tag ? $tag->id : null;

echo newerton\fancybox3\FancyBox::widget();
?>
<div class="stuff-grid">
    <?php foreach ($models as $model): ?>
        <div class="stuff-grid-item">
            <div class="stuff-grid-item__left">
                <div class="stuff-grid-image">
                    <a data-fancybox href="<?= $model->getUploadUrl('image'); ?>"><img src="<?= $model->getThumbUploadUrl('image', 'thumb'); ?>" class="stuff-grid-image__img" alt="<?= $model->name; ?> by <?= $model->developer->name; ?>"></a>
                </div>
            </div>
            <div class="stuff-grid-item__right">
                <a class="stuff-grid-item-title" href="<?= \yii\helpers\Url::to(['/stuff/view', 'id' => $model->id]); ?>"><h2><?= $model->name; ?></h2></a>
                <div class="stuff-grid-tags mb-2">
                    <?php foreach ($model->stuffTags as $stuffTag): ?>
                        <a class="stuff-grid-tags__item <?= $tagId == $stuffTag->tag_id ? 'active': ''; ?>" href="<?= \yii\helpers\Url::to(['/category/view', 'id' => $model->category_id, 'tagId' => $stuffTag->tag_id]); ?>"><?= $stuffTag->tag->name; ?></a>
                    <?php endforeach; ?>
                </div>
                <div class="stuff-grid-os">
                    <?php foreach ($model->os as $os): ?>
                        <span class="stuff-grid-os__item" href="#"><?= $os->name; ?></span>
                    <?php endforeach; ?>
                </div>
                <div class="stuff-grid-format">
                    <?php foreach ($model->formats as $format): ?>
                        <span class="stuff-grid-format__item" href="#"><?= $format->name; ?></span>
                    <?php endforeach; ?>
                </div>
                <div class="stuff-grid-description mt-2">
                    <?= $model->description; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?= LinkPager::widget(['pagination' => $pagination]); ?>
