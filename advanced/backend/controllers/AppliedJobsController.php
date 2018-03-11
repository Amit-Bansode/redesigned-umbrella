<?php

namespace backend\controllers;

use Yii;
use backend\models\AppliedJobs;
use backend\models\AppliedJobsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * AppliedJobsController implements the CRUD actions for AppliedJobs model.
 */
class AppliedJobsController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AppliedJobs models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new AppliedJobsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AppliedJobs model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {

        $model = AppliedJobs::find()
                ->with(['customers', 'jobPost', 'applicationStatus'])
                ->andFilterWhere([ 'id' => $id])
                ->one();

        $model->documents_uploaded = Yii::$app->common->getUploadedFiles($model->customers->unique_id);

        return $this->render('view', [
                    'model' => $model,
        ]);
    }

    /**
     * Creates a new AppliedJobs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new AppliedJobs();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing AppliedJobs model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = AppliedJobs::find()
                ->with(['customers', 'jobPost', 'applicationStatus'])
                ->andFilterWhere([ 'id' => $id])
                ->one();

        if( $model->application_status_id != '3' ) {
            $model->is_locked = TRUE;
            $model->locked_on = date('Y-m-d H:i:s');
        }
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $arrobjApplicationStatuses = \backend\models\ApplicationStatuses::find()->all();

        $arrMixAppliactionStatus = ArrayHelper::map($arrobjApplicationStatuses, 'id', 'status');

        $model->documents_uploaded = Yii::$app->common->getUploadedFiles($model->customers->unique_id);

        return $this->render('update', [
                    'model' => $model,
                    'application_statues' => $arrMixAppliactionStatus
        ]);
    }

    /**
     * Deletes an existing AppliedJobs model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AppliedJobs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AppliedJobs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = AppliedJobs::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
