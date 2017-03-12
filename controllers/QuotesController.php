<?php

namespace app\controllers;

use app\models\Customers;
use app\models\Quotedetails;
use app\models\Quotepricing;
use Yii;
use app\models\Quotes;
use app\models\QuotesSearch;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;

/**
 * QuotesController implements the CRUD actions for Quotes model.
 */
class QuotesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@', 'admin'],
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
     * Lists all Quotes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuotesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // Get Active Customers for searching
        $activeCustomers = ArrayHelper::map($this->getActiveCustomers('shopNumber'), 'id', 'shopNumber');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'activeCustomers' => $activeCustomers,
        ]);
    }

    /**
     * Displays a single Quotes model.
     *
     * @param integer $id
     * @param int $revision
     *
     * @return mixed
     */
    public function actionView($id, $revision = 0)
    {
        $activeCustomers = ArrayHelper::map($this->getActiveCustomers(), 'id', 'name');
        $model = $this->findModel($id, $revision);

        return $this->render('view', [
            'quote' => $model,
            'quotePricing' => $model->getPricing(),
            'quoteDetails' => $model->getDetails(),
            'activeCustomers' => $activeCustomers,
        ]);
    }

    /**
     * Creates a new Quotes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $quote = new Quotes();
        $quotePricing = new Quotepricing();
        $quoteDetails = new Quotedetails();

        // Get Active Customers for searching
        $activeCustomers = ArrayHelper::map($this->getActiveCustomers(), 'id', 'name');

        if ($quote->load(Yii::$app->request->post()) && $quote->save()) {
            return $this->redirect([
                'view',
                'id' => $quote->id,
                $quote->revision
            ]);
        } else {
            return $this->render('create', [
                'quote' => $quote,
                'quotePricing' => $quotePricing,
                'quoteDetails' => $quoteDetails,
                'activeCustomers' => $activeCustomers,
            ]);
        }
    }

    /**
     * Updates an existing Quotes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionUpdate($id, $revision = 0)
    {
        $activeCustomers = ArrayHelper::map($this->getActiveCustomers(), 'id', 'name');
        $quote = $this->findModel($id, $revision);
        $quotePricing = Quotepricing::find()->where([
            'quote_id' => $quote->id,
            'revision' => $quote->revision
        ])->one();
        $quoteDetails = $quote->getDetails()->orderBy('lineItemOrder')->all();


        if ($quote->load(Yii::$app->request->post())) {
            var_dump(Yii::$app->request->post());
            die;
            return $this->redirect([
                'view',
                'id' => $quote->id,
                $quote->revision
            ]);
        } else {
            return $this->render('update', [
                'quote' => $quote,
                'quotePricing' => $quotePricing,
                'quoteDetails' => $quoteDetails,
                'activeCustomers' => $activeCustomers,
            ]);
        }
    }

    /**
     * Deletes an existing Quotes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionClone($id, $revision)
    {
        $cloneQuote;

        return $this->redirect(['update', 'id' => $this->id]);
    }

    /**
     * Finds the Quotes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     * @param int $revision
     *
     * @return Quotes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $revision = 0)
    {
        if (($model = Quotes::findOne([
                'id' => $id,
                'revision' => $revision
            ])) !== null
        ) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
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
            ->from('quotes')
            ->where(['like', $type, $q])
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
     * Returns all active customers ordered by name by default
     *
     * @param string $order
     *
     * @return array of Customers
     */
    protected function getActiveCustomers($order = 'name')
    {
        return Customers::find()->asArray()
            ->where(['active' => Customers::CUSTOMER_ACTIVE])
            ->orderBy($order)
            ->all();
    }
}
