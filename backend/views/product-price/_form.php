<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProductPrice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-price-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'image')->widget(\dosamigos\fileinput\BootstrapFileInput::className(), [
        'options' => ['multiple' => false, 'accept' => 'image/*', 'id' => 'upload-image'],
        'clientOptions' => \common\helpers\hBootstrapFileInput::getBootstrapFileInputOptions($model, 'image'),
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cost')->textInput() ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
