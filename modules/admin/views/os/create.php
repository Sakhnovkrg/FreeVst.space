<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Os $model */

$this->title = 'Create Os';
$this->params['breadcrumbs'][] = ['label' => 'Os', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="os-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
