<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Stuff $model */
/** @var yii\widgets\ActiveForm $form */

$osSelected = [];
$formatSelected = [];
$tags = '';

if (!$model->isNewRecord) {
    $osSelected = array_keys(ArrayHelper::index(\app\models\StuffOs::find()->where(['stuff_id' => $model->id])->asArray()->all(), 'os_id'));
    $formatSelected = array_keys(ArrayHelper::index(\app\models\StuffFormat::find()->where(['stuff_id' => $model->id])->asArray()->all(), 'format_id'));
    $stuffTags = \app\models\StuffTag::find()
        ->with('tag')
        ->where(['stuff_id' => $model->id])
        ->orderBy(['ord' => SORT_ASC])
        ->asArray()
        ->all();
    $tags = [];
    foreach ($stuffTags as $item) {
        $tags[] = $item['tag']['name'];
    }


    $tags = implode(', ', $tags);
}
?>

<div class="stuff-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if (!$model->isNewRecord): ?>
        <div class="mb-3">
            <?= Html::img($model->getThumbUploadUrl('image', 'thumb'), [
                'style' => 'max-width: 400px;', 'class' => 'img-thumbnail img-fluid']); ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(
                \app\models\Category::find()->orderBy('name')->asArray()->all(), 'id', 'name'
            ), ['prompt' => '']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'developer_id')->dropDownList(\yii\helpers\ArrayHelper::map(
                \app\models\Developer::find()->orderBy('name')->asArray()->all(), 'id', 'name'
            ), ['prompt' => '']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'download_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'version')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'youtube_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->fileInput(['accept' => 'image/*']) ?>

    <div class="form-group mb-3">
        <?= Html::checkboxList('os', $osSelected, \yii\helpers\ArrayHelper::map(
            \app\models\Os::find()->orderBy('ord')->asArray()->all(), 'id', 'name'
        )); ?>
    </div>

    <div class="form-group mb-3">
        <?= Html::checkboxList('format', $formatSelected, \yii\helpers\ArrayHelper::map(
            \app\models\Format::find()->orderBy('ord')->asArray()->all(), 'id', 'name'
        )); ?>
    </div>

    <div class="form-group mb-3">
        <?= Html::label('Tags', 'tags', ['class' => 'form-label']); ?>
        <?= Html::textInput('tags', $tags, ['class' => 'form-control', 'id' => 'tags']); ?>
    </div>

    <?= $form->field($model, 'active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
