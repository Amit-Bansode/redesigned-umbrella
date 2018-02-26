<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AppliedJobsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Applied Jobs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="applied-jobs-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'customer_id',
                'value' => function( $model ) {
                    return $model->customers->first_name . ' ' . $model->customers->last_name;
                }
            ],
            [
                'attribute' => 'job_post_id',
                'value' => 'jobPost.job_title'
            ],
            [
                'attribute' => 'application_status_id',
                'value' => 'applicationStatus.status'
            ],
            'locked_on',
            [
                'class' => 'yii\grid\ActionColumn', 
                'buttons' => [ 'delete' => function() {}]],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
