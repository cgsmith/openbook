<?php

namespace app\controllers;

use Yii;
use app\models\Quotepricing;
use app\models\QuotepricingSearch;
use yii\db\Query;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;

/**
 * QuotepricingController implements the CRUD actions for Quotepricing model.
 */
class QuotepricingController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
	        'access' => [
		        'class'      => AccessControl::className(),
		        'ruleConfig' => [
			        'class' => AccessRule::className(),
		        ],
		        'rules'      => [
			        [
				        'allow' => true,
				        'roles' => [ 'admin', '@' ],
			        ],
		        ],
	        ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

	/**
	 * Fetch list of categories for quote pricing
	 *
	 * @param null $type
	 * @param null $q
	 *
	 * @return string
	 */
    public function actionRemoteList($type = null, $q = null)
    {
    	// Bail if type or query is null
    	if ($type == null || $q == null) {
		    return Json::encode([]);
	    }

    	$query = new Query();
	    $query->select($type)
		      ->distinct()
	          ->from('quotepricing')
	          ->where(['like',$type,$q])
	          ->orderBy($type);
	    $command = $query->createCommand();
	    $data = $command->queryAll();
	    $out = [];
	    foreach ($data as $d) {
		    $out[] = ['value' => $d[$type]];
	    }
	    echo Json::encode($out);
    }

    /**
     * Lists all Quotepricing models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuotepricingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Quotepricing model.
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
     * Creates a new Quotepricing model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Quotepricing();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Quotepricing model.
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
     * Deletes an existing Quotepricing model.
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
     * Finds the Quotepricing model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Quotepricing the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Quotepricing::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
