<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use branchonline\lightbox\Lightbox;

/* @var $this yii\web\View */
/* @var $model backend\models\AppliedJobs */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .document-container {
        float:left;
    }
</style>
<?php
if ($model->application_status_id != 3 && ( $model->updated_by == NULL || ( $model->updated_by == Yii::$app->user->id ) )) {
    ?>
    <div class="alert alert-danger alert-dismissible">
        This application is locked. If not processed then open in 20 minutes.
    </div>

    <?php
}
?>
<div class="applied-jobs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::label('Customer Name : '); ?>
    <?= Html::label($model->customers->first_name . ' ' . $model->customers->last_name); ?>

    <div style="clear:both"></div>

    <?= Html::label('Job Post Title : '); ?>
    <?= Html::label($model->jobPost->job_title); ?>

    <?= Html::label($model->getAttributeLabel('is_locked')); ?>
    <?= Html::label(Yii::$app->common->convertBooleanValue($model->is_locked)); ?>
    <div style="clear:both"></div>

    <?= Html::label($model->getAttributeLabel('locked_on')); ?>
    <?= Html::label($model->locked_on); ?>
    <div style="clear:both"></div>

    <?= Html::label($model->getAttributeLabel('updated_on')); ?>
    <?= Html::label($model->updated_on); ?>
    <div style="clear:both"></div>

    <?= Html::label($model->getAttributeLabel('created_on')); ?>
    <?= Html::label($model->created_on); ?>
    <div style="clear:both"></div>

    <?= $form->field($model, 'application_status_id')->dropDownList($application_statues, ['style' => 'width:200px;']) ?>
    <div style="clear:both"></div>
    <?php
    foreach ($model->documents_uploaded AS $documentsUploaded) {
        echo '<div class="document-container">';
        echo Lightbox::widget([
            'files' => [
                [
                    'thumb' => $documentsUploaded['document_link'],
                    'original' => $documentsUploaded['document_link'],
                    'title' => $documentsUploaded['document_title'],
                    'thumbOptions' => [ 'height' => 250, 'width' => 300, 'style' => 'margin-left:1%;', 'title' => $documentsUploaded['document_title']]
                ],
            ]
        ]);
        echo '<label>' . $documentsUploaded['document_title'] . '</label>';
        echo '</div>';
    }
    ?>
    <div style="clear: both;"></div>

    <div class="form-group">
        <?php
        if ($model->application_status_id != 3 && ( $model->updated_by == NULL || ( $model->updated_by == Yii::$app->user->id ) )) {
            echo Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']);
        }
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
