<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-view">

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
            [ 'label' => $model->getAttributeLabel('user_type'), 'value' => ( 1 == $model->user_type ) ? 'Super Admin' : 'Admin User'],
            'username',
            'email_address:email',
//            'password',
//            'password_hash',
            'last_login_date',
            [ 'label' => $model->getAttributeLabel('is_published'), 'value' => ( true == $model->is_published ) ? 'True' : 'False'],
            [ 'label' => $model->getAttributeLabel('updated_by'), 'value' => backend\models\Users::findOne($model->updated_by)->username],
            'updated_on',
            [ 'label' => $model->getAttributeLabel('created_by'), 'value' => backend\models\Users::findOne($model->created_by)->username],
            'created_on',
        ],
    ])
    ?>

</div>
