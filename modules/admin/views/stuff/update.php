<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Stuff $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Stuff', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stuff-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
