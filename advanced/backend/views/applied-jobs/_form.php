<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AppliedJobs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="applied-jobs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

    <?= $form->field($model, 'job_post_id')->textInput() ?>

    <?= $form->field($model, 'application_status_id')->textInput() ?>

    <?= $form->field($model, 'locked_on')->textInput() ?>

    <?= $form->field($model, 'is_locked')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'updated_on')->textInput() ?>

    <?= $form->field($model, 'created_on')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
