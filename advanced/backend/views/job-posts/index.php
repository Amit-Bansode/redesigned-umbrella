<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JobPostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Job Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-posts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
<?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
<?= Html::a(Yii::t('app', 'Create Job Posts'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            //'job_type_id',
            'unique_job_number',
            'job_title',
            [
                'attribute' => 'job_description',
                'value' => function( $model ) {
                    return substr( strip_tags($model->job_description) , 0, 80);
                }
            ],
            //'job_description:ntext',
            //'apply_url:url',
            'start_date',
            'end_date',
            //'is_published',
            //'is_deleted',
            //'updated_by',
            //'updated_on',
            //'created_by',
            //'created_on',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
<?php Pjax::end(); ?>
</div>
