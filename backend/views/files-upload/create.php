<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FilesUpload */

$this->title = 'Create Files Upload';
$this->params['breadcrumbs'][] = ['label' => 'Files Uploads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="files-upload-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
