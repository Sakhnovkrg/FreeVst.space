<?php

use app\models\Stuff;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\StuffSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Stuff';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stuff-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Stuff', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'image',
                'filter' => false,
                'enableSorting' => false,
                'value' => function ($model) {
                    return Html::img($model->getThumbUploadUrl('image', 'thumb'), [
                        'style' => 'max-width: 100px; pointer-events: none', 'class' => 'img-thumbnail']);
                },
                'format' => 'raw'
            ],
            'name',
            [
                'attribute' => 'category_id',
                'filter' => \yii\helpers\ArrayHelper::map(
                    \app\models\Category::find()->orderBy('name')->asArray()->all(), 'id', 'name'
                ),
                'value' => function ($model) {
                    return $model->category->name;
                }
            ],
            [
                'attribute' => 'developer_id',
                'filter' => \yii\helpers\ArrayHelper::map(
                    \app\models\Developer::find()->orderBy('name')->asArray()->all(), 'id', 'name'
                ),
                'value' => function ($model) {
                    return $model->developer->name;
                }
            ],
            [
                'attribute' => 'active',
                'filter' => [1 => 'Yes', 0 => 'No'],
                'value' => function ($model) {
                    return $model->active ? 'Yes' : 'No';
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Stuff $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>


</div>
