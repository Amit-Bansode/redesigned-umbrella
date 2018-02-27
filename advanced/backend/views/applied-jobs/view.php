<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AppliedJobs */

$this->title = $model->customers->first_name . ' ' . $model->customers->last_name . ' Applied For ' . $model->jobPost->job_title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Applied Jobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="applied-jobs-view">

    <h2><?= Html::encode($this->title) ?></h2>

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
            [
                'attribute' => 'customer_id',
                'value' => function( $model ) {
                    return $model->customers->first_name . ' ' . $model->customers->last_name;
                }
            ],
            [
                'attribute' => 'job_post_id',
                'value' => $model->jobPost->job_title
            ],
            [
                'attribute' => 'application_status_id',
                'value' => $model->applicationStatus->status
            ],
            'locked_on',
            'is_locked',
            'updated_by',
            'updated_on',
            'created_on',
        ],
    ])
    ?>

</div>
