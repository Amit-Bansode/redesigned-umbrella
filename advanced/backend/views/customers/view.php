<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use branchonline\lightbox\Lightbox;

/* @var $this yii\web\View */
/* @var $model backend\models\Customers */

$this->title = $model->first_name . ' ' . $model->last_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .document-container {
        float:left;
    }
</style>

<div class="customers-view">

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
            'username',
            'first_name',
            'last_name',
            'email_address:email',
            'primary_contact_number',
            'is_published',
            'updated_on',
            'created_on',
            [ 'attribute' => 'Documents',
                'format' => 'raw',
                'value' => ''
            ]
        ],
    ])
    ?>
    <?php
    foreach ($model->documents_uploaded AS $documentsUploaded) {
        echo '<div class="document-container">';
        echo Lightbox::widget([
            'files' => [
                [
                    'thumb' => $documentsUploaded['document_link'],
                    'original' => $documentsUploaded['document_link'],
                    'title' => $documentsUploaded['document_title'],
                    'thumbOptions' => [ 'height' => 250, 'width' => 300, 'style' => 'margin-left:1%;', 'title' => $documentsUploaded['document_title'] ]
                ],
            ]
        ]);
        echo '<label>'.$documentsUploaded['document_title'].'</label>';
        echo '</div>';
        
    }
    ?>
    <div style="clear: both;"></div>
</div>
