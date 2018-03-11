<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\NotificationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Notifications');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notifications-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'attribute' => 'notification_type_id',
                'value' => function( $model ) {
                    return $model->notificationType->notification_type;
                }
            ],
            'notification',
//            'is_read',
            'created_on',
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'update' => function() {},
                    'view' => function() {}        
                ]
                ],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
