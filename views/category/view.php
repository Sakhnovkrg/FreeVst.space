<?php

/** @var yii\web\View $this */
/** @var \app\models\Category $category */
/** @var \yii\data\ActiveDataProvider $dataProvider */
/** @var \yii\data\Pagination $pagination */
/** @var \app\models\Stuff[] $models */
/** @var \app\models\Tag $tag */

use yii\bootstrap5\Breadcrumbs;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$this->title = $category->name;
if($tag) {
    $this->title = ucfirst($tag->name) . ' ' . lcfirst($this->title);
    $this->params['breadcrumbs'][] = ['label' => $category->name, 'url' => ['/category/view', 'id' => $category->id]];
    $this->params['breadcrumbs'][] = ucfirst($tag->name);
} else {
    $this->params['breadcrumbs'][] = $category->name;
}

$this->params['og.image'] = Url::to('@web/img/og.png', true);
$this->params['og.title'] = $this->title . ' for music production free download';
$this->params['og.description'] = 'Free ' . lcfirst($this->title) . ' plugins for music production (' .
    implode(', ', array_keys(ArrayHelper::index(\app\models\Format::find()->orderBy('ord')->all(), 'name'))) . ')';
$this->params['meta.description'] = $this->params['og.description'];
?>
<div class="container">
    <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
    <h1><?= $this->title; ?></h1>
    <?= $this->render('_grid', compact(['models', 'pagination', 'tag'])); ?>
</div>
