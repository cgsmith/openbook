<?php

namespace app\controllers;

use app\models\Employees;
use app\models\Jobs;
use Yii;
use app\models\Timecards;
use app\models\TimecardsSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TimecardsController implements the CRUD actions for Timecards model.
 */
class TimecardsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
     * Lists all Timecards models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TimecardsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Timecards model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Timecards model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Timecards();

	    // Get Active Employees for Timecard
	    $employees = Employees::find()
	                        ->where(['active'=>Employees::EMPLOYEE_ACTIVE])
	                        ->orderBy('name')
	                        ->all();

	    // Show the employee ID after their name - not sure if there is an anonymous function to do this.
	    foreach ($employees as $employee) {
	    	$employee->name = $employee->name . ' #' . $employee->id;
	    }

	    // Get Active Jobs for Timecard
	    $jobs = Jobs::find()
		                ->where(['status'=>Jobs::JOBS_OPEN])
		                ->orderBy('shopNumber')
		                ->all();
	    foreach ($jobs as $job) {
	    	$job->description = $job->shopNumber . $job->id . ' - ' . $job->description;
	    }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'activeEmployees' => ArrayHelper::map($employees, 'id', 'name'),
                'activeJobs' => ArrayHelper::map($jobs, 'id', 'description'),
            ]);
        }
    }

    /**
     * Updates an existing Timecards model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Timecards model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Timecards model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Timecards the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Timecards::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
