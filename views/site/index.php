<?php

/** @var yii\web\View $this */
/** @var \app\models\Stuff[] $models */
/** @var \yii\data\Pagination $pagination */

use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$this->title = 'Best Free Audio Plugins';

$this->params['og.title'] = $this->title;
$this->params['og.description'] = 'Free plugins for music production (' .
    implode(', ', array_keys(ArrayHelper::index(\app\models\Format::find()->orderBy('ord')->all(), 'name'))) . ')';
$this->params['meta.description'] = $this->params['og.description'];
$this->params['og.image'] = Url::to('@web/img/og.png', true);
?>
<div class="container">
    <h1>Free audio plugins archive</h1>

    <?= $this->render('@app/views/category/_grid', ['models' => $models, 'tag' => null, 'pagination' => $pagination]); ?>
</div>
