<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;
use app\widgets\Alert;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap5\ActiveForm */
/* @var $model app\models\LoginForm */

$this->context->layout = '@app/modules/admin/views/layouts/main-login';
$this->title = 'Вход в панель управления';

?>
<div class="admin-default-login">
    <?php $form = ActiveForm::begin(['validateOnBlur' => false]); ?>

    <div class="row">
        <div class="col-md-4 col-sm-6 m-auto">
            <h2 class="text-center"><?= Yii::$app->name; ?></h2>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'autocomplete' => 'off']) ?>
            <?= $form->field($model, 'password')->passwordInput(['autocomplete' => 'off']) ?>

            <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>
</div>
