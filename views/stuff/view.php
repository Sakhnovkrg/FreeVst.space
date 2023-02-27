<?php

/** @var yii\web\View $this */

/** @var \app\models\Stuff $model */

use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Markdown;
use yii\helpers\Url;

$this->title = $model->name;

$this->params['breadcrumbs'][] = ['label' => $model->category->name, 'url' => ['/category/view', 'id' => $model->category->id]];
$this->params['breadcrumbs'][] = $this->title;

if($model->youtube_url) {
    preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $model->youtube_url, $match);
    $videoId = $match[1];
    $embeddedLink = 'https://www.youtube.com/embed/' . $videoId;
}

echo newerton\fancybox3\FancyBox::widget();

$this->params['og.image'] = Url::to($model->getUploadUrl('image'), true);
$this->params['og.title'] = $this->title . ' download free';
$this->params['og.description'] = $model->description;
$this->params['meta.description'] = $this->params['og.description'];
?>
<header class="stuff-view-header container mb-3">
    <h1 class="stuff-view-header__heading"><?= $this->title; ?></h1>
    <img class="stuff-view-header__img" src="<?= $model->getUploadUrl('image'); ?>" alt="<?= $model->name; ?>">
</header>
<div class="container">
    <?php if(!Yii::$app->user->isGuest): ?>
        <div class="d-flex justify-content-end">
            <a href="<?= \yii\helpers\Url::to(['/admin/stuff/update', 'id' => $model->id]); ?>">Update</a>
        </div>
    <?php endif; ?>
    <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
    <div class="row">
        <div class="col-md-5 mb-3">
            <a href="<?= $model->getUploadUrl('image'); ?>" data-fancybox>
                <img class="img-thumbnail mb-3" src="<?= $model->getThumbUploadUrl('image', 'thumb'); ?>" alt="<?= $model->name; ?>">
            </a>
            <div class="stuff-developer mb-3">
                by <a class="stuff-developer__link" target="_blank"
                      href="<?= $model->developer->url; ?>"><?= $model->developer->name; ?></a>
            </div>
            <div class="stuff-grid-tags mb-2">
                <?php foreach ($model->stuffTags as $stuffTag): ?>
                    <a class="stuff-grid-tags__item" href="<?= \yii\helpers\Url::to(['/category/view', 'id' => $model->category->id, 'tagId' => $stuffTag->tag_id]); ?>"><?= $stuffTag->tag->name; ?></a>
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
        </div>
        <div class="col-md-7">
            <?php if ($model->youtube_url): ?>
                <div class="mb-3">
                    <a style="text-decoration: none" href="<?= $embeddedLink; ?>" data-fancybox>
                        <img style="height: 16px; vertical-align: middle" src="/img/YouTube_Logo_2017.svg" alt="Watch video">
                    </a>
                </div>
            <?php endif; ?>

            <?= Markdown::process($model->text); ?>

            <a target="_blank" href="<?= $model->url; ?>" class="btn btn-primary mb-2">Download</a>
            <a target="_blank" href="<?= $model->download_url; ?>" class="btn btn-warning mb-2">Mirror <?= $model->version ? '(v.' . $model->version . ')' : ''; ?></a>
            <?php if($model->developer->donate_url): ?>
            <a target="_blank" href="<?= $model->developer->donate_url; ?>" class="btn btn-outline-success mb-2">Donate to <?= $model->developer->name; ?></a>
            <?php endif; ?>
        </div>
    </div>

</div>

<script>
    // parallax

    const parallaxImage = document.querySelector('.stuff-view-header__img');
    const parallaxContainer = document.querySelector('.stuff-view-header');
    const maxTranslation = parallaxImage.height - parallaxContainer.clientHeight;

    window.addEventListener('scroll', () => {
        const scrollTop = window.scrollY;
        const translation = scrollTop / 2;

        parallaxImage.style.transform = `translateY(${Math.min(translation, maxTranslation)}px)`;
    });
</script>