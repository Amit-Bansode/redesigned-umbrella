<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JobPostsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="job-posts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'job_type_id') ?>

    <?= $form->field($model, 'unique_job_number') ?>

    <?= $form->field($model, 'job_title') ?>

    <?= $form->field($model, 'job_description') ?>

    <?php // echo $form->field($model, 'apply_url') ?>

    <?php // echo $form->field($model, 'start_date') ?>

    <?php // echo $form->field($model, 'end_date') ?>

    <?php // echo $form->field($model, 'is_published') ?>

    <?php // echo $form->field($model, 'is_deleted') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'updated_on') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_on') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
