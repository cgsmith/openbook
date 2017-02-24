<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\QuotepricingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Quotepricings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quotepricing-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Quotepricing'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'quote_id',
            'viewed',
            'emailed:email',
            'estimatedDelivery',
            // 'totalPrice',
            // 'totalHours',
            // 'totalMaterial',
            // 'margin',
            // 'shopRate',
            // 'patternOwner',
            // 'patternNumber',
            // 'dateIssued',
            // 'revision',
            // 'job_id',
            // 'category',
            // 'quotedby',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
