<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FilesUpload */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="files-upload-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'id_file')->widget(\dosamigos\fileinput\BootstrapFileInput::className(), [
        'options' => ['multiple' => false, 'accept' => 'image/*', 'id' => 'upload-id_file'],
        'clientOptions' => \common\helpers\hBootstrapFileInput::getBootstrapFileInputOptions($model, 'id_file'),
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Загрузить' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
