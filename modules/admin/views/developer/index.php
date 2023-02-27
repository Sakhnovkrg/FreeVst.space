<?php

use app\models\Developer;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\DeveloperSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Developers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="developer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Developer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'name',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Developer $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>
</div>
