<?php

use app\models\Format;
use app\widgets\SortableGridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;

/** @var yii\web\View $this */
/** @var app\models\FormatSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Formats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="format-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Format', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    echo SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table table-bordered'],
        'showHeader' => false,
        'sortUrl' => Url::to(['sortItem']),

        'columns' => [
            'name',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Format $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>


</div>
