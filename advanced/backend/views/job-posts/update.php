<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JobPosts */

$this->title = Yii::t('app', 'Update Job Posts: {nameAttribute}', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Job Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="job-posts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'documents' => $documents,
        'job_governing' => $job_governing
    ]) ?>

</div>
