<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Documents */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documents-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'document_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_published')->textInput() ?>

    <?= $form->field($model, 'modified_by')->textInput() ?>

    <?= $form->field($model, 'modified_on')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'created_on')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
