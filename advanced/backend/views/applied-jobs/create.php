<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AppliedJobs */

$this->title = Yii::t('app', 'Create Applied Jobs');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Applied Jobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="applied-jobs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
