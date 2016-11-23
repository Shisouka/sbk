<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Subcatalog */
/* @var $form yii\widgets\ActiveForm */

$id_catalog = $model->isNewRecord ? $id_catalog : $model->id_catalog;
?>

<div class="subcatalog-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_catalog')->hiddenInput(['value' => $id_catalog])->label(false); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
