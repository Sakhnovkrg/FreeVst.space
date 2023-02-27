<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Developer $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Developers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="developer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
