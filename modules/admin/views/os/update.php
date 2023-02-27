<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Os $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Os', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="os-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
