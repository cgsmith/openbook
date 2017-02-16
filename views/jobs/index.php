<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JobsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Jobs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jobs-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Jobs'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
                'attribute' => 'dateReceived',
                'value' => 'dateReceived',
                'format' => 'date',
            ],
            [
                'label' => Yii::t('app','Customer'),
                'attribute' => 'quotes.customer_id',
                'filter' => $activeCustomers,
                'format' => 'raw',
                'value' => function ($data) {

                    return Html::a(
                        $data->shopNumber,
                        'customers/view?id='//.$data->customer_id
                    );
                }
            ],
            [
                'label' => Yii::t('app','Job #'),
                'attribute' => 'id',
            ],
            'PONumber',
            'customer_shopnumber',
            'pricing.patternNumber',
            'pricing.patternOwner',
            'pricing.totalPrice',
            'pricing.totalHours',
            'status',
            'id',
            // 'dateReceived',
            // 'dateDue',
            // 'timeMaterial:datetime',
            // 'status',
            // 'PONumber',
            // 'patternShrink',
            // 'finishStock',
            // 'description:ntext',
            // 'notes:ntext',
            // 'devonsnotes:ntext',
            // 'color',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
