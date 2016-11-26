<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CatalogContent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catalog-content-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_catalog')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'id_subcatalog')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 50]) ?>
<?php
/*
 echo $form->field($model, 'content')->widget(\dosamigos\tinymce\TinyMce::className(), [
    'options' => ['rows' => 50],
    'language' => 'ru',
    'clientOptions' => [
        'plugins' => [
            "advlist autolink lists link charmap preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste image"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        'images_upload_url' => "postAcceptor.php",
        'file_browser_callback' => new yii\web\JsExpression("function(field_name, url, type, win) {
                if(type=='image'){
                    $('#content_gallery_modal').data('field_name',field_name).modal('show');
                }
            }")
    ]
]);
*/
?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
