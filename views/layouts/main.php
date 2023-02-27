<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta.description'] ?? '']);
$this->registerMetaTag(['property' => 'og:title', 'content' => $this->params['og.title'] ?? '']);
$this->registerMetaTag(['property' => 'og:image', 'content' => $this->params['og.image'] ?? Yii::getAlias('@web/img/og.png')]);
$this->registerMetaTag(['property' => 'og:description', 'content' => $this->params['og.description'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

$navbarItems = [];
$list = \app\models\Category::list();
$categories = [];
foreach ($list as $item) {
    $categories[] = ['label' => $item['name'], 'url' => ['/category/view', 'id' => $item['id']]];
}

$navbarItems = \yii\helpers\ArrayHelper::merge($navbarItems, $categories);
$navbarItems[] = ['label' => 'FREE SYNTH PRESETS', 'url' => 'https://presetshare.com', 'linkOptions' => ['class' => 'presetshare', 'target' => '_blank']];

$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::canonical()]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <?php echo Yii::$app->settings->get('Layout', 'Head scripts'); ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $navbarItems
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <?= $content ?>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; <?= Yii::$app->name; ?> <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end">Powered by <a href="https://yiiframework.com" target="_blank">Yii Framework</a></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
