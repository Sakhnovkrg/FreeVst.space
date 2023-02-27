<?php

use app\models\Os;
use app\widgets\SortableGridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\OsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Os';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="os-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Os', ['create'], ['class' => 'btn btn-success']) ?>
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
                'urlCreator' => function ($action, Os $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>

</div>
