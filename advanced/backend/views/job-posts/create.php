<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\JobPosts */

$this->title = Yii::t('app', 'Create Job Posts');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Job Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-posts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'documents' => $documents,
        'job_governing' => $job_governing
    ]) ?>

</div>
