<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\JobPosts */

$this->title = $model->job_title;
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
            [ 'label' => $model->getAttributeLabel('job_governing_id'), 'value' => backend\models\JobGoverning::findOne($model->job_governing_id)->governing_name],
            'qualification',
            'apply_url:url',
            [ 'label' => $model->getAttributeLabel('start_date'), 'value' => Yii::$app->common->convertDateFormat($model->start_date, 'd M Y')],
            [ 'label' => $model->getAttributeLabel('end_date'), 'value' => Yii::$app->common->convertDateFormat($model->end_date, 'd M Y')],
            [ 'label' => $model->getAttributeLabel('is_published'), 'value' => ( true == $model->is_published ) ? 'True' : 'False' ],
            'documents_required',
            [ 'label' => $model->getAttributeLabel('updated_by'), 'value' => backend\models\Users::findOne($model->updated_by)->username ],
            'updated_on',
            [ 'label' => $model->getAttributeLabel('created_by'), 'value' => backend\models\Users::findOne($model->created_by)->username ],            
            'created_on',
        ],
    ])
    ?>

</div>
