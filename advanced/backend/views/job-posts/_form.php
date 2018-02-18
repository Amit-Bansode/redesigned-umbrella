<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\JobPosts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="job-posts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= yii\bootstrap\Html::hiddenInput('JobPosts[job_type_id]', '1') ?>

    <?= yii\bootstrap\Html::hiddenInput('JobPosts[unique_job_number]', $model->unique_job_number) ?>

    <?= $form->field($model, 'job_title')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'job_description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        
    ])
    ?>

    <?= $form->field($model, 'qualification')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apply_url')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'start_date')->widget(yii\jui\DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter start date', 'dateFormat' => 'd M Y'],
    ]);
    ?>

    <?=
    $form->field($model, 'end_date')->widget(yii\jui\DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter end date', 'dateFormat' => 'd M Y'],
    ]);
    ?>

    <?= $form->field($model, 'documents_required')->checkboxList($documents); ?>

        <?= $form->field($model, 'is_published')->checkbox() ?>

    <div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
