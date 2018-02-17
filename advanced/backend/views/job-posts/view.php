<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\JobPosts */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Job Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-posts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            //'job_type_id',
            'unique_job_number',
            'job_title',
            'job_description:ntext',
            'qualification',
            'apply_url:url',
            [ 'label' => $model->getAttributeLabel('start_date'), 'value' => Yii::$app->common->convertDateFormat($model->start_date, 'd M Y')],
            [ 'label' => $model->getAttributeLabel('end_date'), 'value' => Yii::$app->common->convertDateFormat($model->end_date, 'd M Y')],
            'is_published',
            //'is_deleted',
            'updated_by',
            'updated_on',
            'created_by',
            'created_on',
        ],
    ])
    ?>

</div>
