<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\QuotesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $activeCustomers app\models\Customers */

$this->title = Yii::t('app', 'Quotes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quotes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Quotes'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
        	[
        		'attribute' => 'dateIssued',
		        'value' => 'pricing.dateIssued',
		        'format' => 'date',
            ],
            [
                'label' => Yii::t('app','Quote #'),
                'attribute' => 'id',
            ],
            [
                'label' => Yii::t('app','Customer'),
                'attribute' => 'customer_id',
                'filter' => $activeCustomers,
                'format' => 'raw',
	            'value' => function ($data) {
                	return Html::a(
                		$data->customers->shopNumber,
		                'customers/view?id='.$data->customer_id
	                );
	            }
            ],
	        [
	        	'attribute' => 'patternNumber',
		        'value' => 'pricing.patternNumber'
	        ],
	        [
	        	'attribute' => 'patternOwner',
		        'value' => 'pricing.patternOwner'
	        ],
	        'pricing.totalPrice:currency',
            // 'category',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
