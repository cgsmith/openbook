<?php

namespace app\controllers;

use app\models\Company;
use app\models\Customers;
use app\models\Quotedetails;
use app\models\Quotepricing;
use Yii;
use app\models\Quotes;
use app\models\QuotesSearch;
use yii\base\Model;
use yii\db\Expression;
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
        $quotePricing = $quote->getPricing()->one();
        $quoteDetails = $quote->getDetails()->orderBy('lineItemOrder')->all();

        // Update the quote if we are posting - first validate
        if ($postData = Yii::$app->request->post()) {
            unset($quoteDetails, $quotePricing); // If we are posting we're going to blow the post data away
            $quote->load($postData); // Load the quote with form data
            $quote->save();

            // @todo: link to company
            $company = Company::findOne(['id' => 1]); // get shoprate and margin info
            // Save Quote Details
            $i = 0;
            $totalHours = 0;
            $totalMaterial = 0;
            $shopRate = $company->getAttribute('shoprate');
            $shopMargin = ($company->getAttribute('margin') / 100) + 1;
            foreach ($postData['Quotedetails'] as $postDataQuoteDetail) {
                $i++; // used to track individual instructions
                $quoteDetails[$i] = new Quotedetails();
                $quoteDetails[$i]->setAttributes($postDataQuoteDetail);
                $quoteDetails[$i]->setAttribute('quote_id', $quote->id);
                $quoteDetails[$i]->setAttribute('revision', $quote->revision);
                $totalHours += $quoteDetails[$i]->hours;
                $totalMaterial += $quoteDetails[$i]->material;
                $quoteDetails[$i]->save();
            }
            $totalPrice = (($totalHours * $shopRate) + $totalMaterial) * ($shopMargin);

            // Save quote pricing
            $quotePricing = new Quotepricing();
            $quotePricing->load($postData);
            $quotePricing->setAttribute('totalHours', $totalHours);
            $quotePricing->setAttribute('totalMaterial', $totalMaterial);
            $quotePricing->setAttribute('totalPrice', $totalPrice);
            $quotePricing->setAttribute('shopRate', $shopRate);
            $quotePricing->setAttribute('revision', $quote->revision);
            $quotePricing->setAttribute('margin', $company->getAttribute('margin')); // saved as shop margin in quotePricing table
            $quotePricing->setAttribute('dateIssued', (new Expression('NOW()'))); // Current date for new quote
            $quotePricing->save();

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


    public function actionClone($id, $revision = 0)
    {
        $quote = $this->findModel($id, $revision);
        $quotePricing = $quote->pricing;
        $quoteDetails = $quote->details;

        // Insert new quote
        $cloneQuote = new Quotes();
        $cloneQuote->setAttributes($quote->attributes);
        $cloneQuote->setAttributes(['job_id' => 0, 'revision' => 0]); // Set job and revision to 0 since we are cloning
        $cloneQuote->save();

        // Insert new pricing
        $cloneQuotePricing = new Quotepricing();
        $attributesToChange = ['quote_id'=>$cloneQuote->id, 'emailed' => null, 'viewed' => null, 'job_id' => 0, 'revision' => 0, 'dateIssued' => date('Y-m-d'), 'estimatedDelivery' => ''];
        $cloneQuotePricing->setAttributes($quotePricing->attributes);
        $cloneQuotePricing->setAttributes($attributesToChange);
        $cloneQuotePricing->save();

        // Insert details
        foreach ($quoteDetails as $quoteDetail) {
            $cloneQuoteDetail = new Quotedetails();
            $cloneQuoteDetail->setAttributes($quoteDetail->attributes);
            $cloneQuoteDetail->setAttributes(['quote_id'=>$cloneQuote->id,'revision'=>0]);
            $cloneQuoteDetail->save();
        }
        Yii::$app->getSession()->setFlash('success', ['body' => Yii::t('app','Quote successfully cloned')]);
        return $this->redirect(['update', 'id' => $cloneQuote->id]);
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
