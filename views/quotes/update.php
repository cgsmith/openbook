<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $quote app\models\Quotes */
/* @var $quotePricing app\models\Quotepricing */
/* @var $quoteDetails app\models\Quotedetails */
/* @var $activeCustomers app\models\Customers */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Quotes',
]) . $quote->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Quotes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $quote->id, 'url' => ['view', 'id' => $quote->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="quotes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'quote' => $quote,
        'quotePricing' => $quotePricing,
        'quoteDetails' => $quoteDetails,
        'activeCustomers' => $activeCustomers,
    ]) ?>

</div>
