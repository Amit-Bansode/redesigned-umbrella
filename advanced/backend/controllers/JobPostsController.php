<?php

namespace backend\controllers;

use Yii;
use backend\models\JobPosts;
use backend\models\JobPostsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JobPostsController implements the CRUD actions for JobPosts model.
 */
class JobPostsController extends Controller {

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
     * Lists all JobPosts models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new JobPostsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JobPosts model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $model = $this->findModel($id);
        $model->documents_required = \backend\models\DocumentsRequired::getDocumentsByJobPostIds($id);
        $model->documents_required = implode(', ', $model->documents_required);
        return $this->render('view', [
                    'model' => $model,
        ]);
    }

    /**
     * Creates a new JobPosts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new JobPosts();
        $model->unique_job_number = Yii::$app->common->createUniqueJobId(1);
        $arrMixDocuments = [];

        $arrMixDocuments = $this->getDocuments();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $boolsIsView = TRUE;
            foreach ($model->documents_required AS $intDocumentId) {

                $objcloneDocumentsRequired = new \backend\models\DocumentsRequired();
                $objcloneDocumentsRequired->document_id = $intDocumentId;
                $objcloneDocumentsRequired->job_post_id = $model->id;

                if (FALSE == $objcloneDocumentsRequired->save()) {
                    $boolsIsView = FALSE;
                    $model->delete();
                    $model->addError('documents_required', 'Unable to insert documents required.');
                }
            }
            if ($boolsIsView) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $arrMixJobGoverning = $this->getJobGoverning();
        
        return $this->render('create', [
                    'model' => $model,
                    'documents' => $arrMixDocuments,
                    'job_governing' => $arrMixJobGoverning
        ]);
    }

    /**
     * Updates an existing JobPosts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $arrMixDocumentsRequired = \backend\models\DocumentsRequired::getDocumentsByJobPostIds($model->id);
        $boolsIsView = TRUE;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $arrIntPreviousValues = array_keys($arrMixDocumentsRequired);

            if ( 0 < count($arrIntPreviousValues) && FALSE == \backend\models\DocumentsRequired::deleteAll(['job_post_id' => $model->id])) {
                $boolsIsView = FALSE;
                $model->addError('documents_required', 'Failed to update documents.');
            }

            if (TRUE == $boolsIsView) {
                foreach ($model->documents_required AS $intDocumentId) {

                    $objcloneDocumentsRequired = new \backend\models\DocumentsRequired();
                    $objcloneDocumentsRequired->document_id = $intDocumentId;
                    $objcloneDocumentsRequired->job_post_id = $model->id;

                    if (FALSE == $objcloneDocumentsRequired->save()) {
                        $boolsIsView = FALSE;
                        $model->addError('documents_required', 'Unable to insert documents required.');
                    }
                }
            }

            if (TRUE == $boolsIsView) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        
        $model->documents_required = array_keys($arrMixDocumentsRequired);
        $arrminJobGoverning = $this->getJobGoverning();

        $arrMixDocuments = $this->getDocuments();

        return $this->render('update', [
                    'model' => $model,
                    'documents' => $arrMixDocuments,
                    'job_governing' => $arrminJobGoverning
        ]);
    }

    /**
     * Deletes an existing JobPosts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $model->is_deleted = TRUE;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the JobPosts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JobPosts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = JobPosts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    private function getDocuments() {
        $arrMixDocuments = [];
        $arrObjDocuments = \backend\models\Documents::findAll(['is_published' => TRUE]);
        foreach ($arrObjDocuments as $objDocument) {
            $arrMixDocuments[$objDocument->id] = $objDocument->document_name;
        }

        return $arrMixDocuments;
    }
    
    private function getJobGoverning() {
        $arrmixJobGoverning = [];
        $arrObjJobGoverning = \backend\models\JobGoverning::findAll(['is_published' => 1]);
        
        foreach ( $arrObjJobGoverning AS $objJobGoverning ) {
            $arrmixJobGoverning[$objJobGoverning->id] = $objJobGoverning->governing_name;
        }
        
        return $arrmixJobGoverning;
    }

}
