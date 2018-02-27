<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Documents */

$this->title = $model->document_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documents-view">

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
//            'id',
            'document_name',
            [ 'label' => $model->getAttributeLabel('is_published'), 'value' => Yii::$app->common->convertBooleanValue($model->is_published)],
            [ 'label' => $model->getAttributeLabel('updated_by'), 'value' => backend\models\Users::findOne($model->updated_by)->username],
            'updated_on',
            [ 'label' => $model->getAttributeLabel('created_by'), 'value' => backend\models\Users::findOne($model->created_by)->username],
            'created_on',
        ],
    ])
    ?>

</div>
