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

    <p>
        <?= Html::a(Yii::t('app', 'New Quote'), ['create'], ['class' => 'btn btn-success']) ?>
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
	            'value' => function ($model) {
                	return ($model->revision > 0) ? $model->id  . ' R' . $model->revision : $model->id;
	            }
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
            [
            	'class' => 'yii\grid\ActionColumn',
	            'buttons' => [
	            	'view' => function ($url, $model) {
	                    $url .= ($model->revision > 0) ? '&revision=' . $model->revision : '';
			            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
				            'title' => Yii::t('yii', 'View'),
			            ]);
				    },
	            	'update' => function ($url, $model) {
	                    $url .= ($model->revision > 0) ? '&revision=' . $model->revision : '';
			            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
				            'title' => Yii::t('yii', 'Update'),
			            ]);
				    },
	            ]
            ],
        ],
    ]); ?>
</div>
