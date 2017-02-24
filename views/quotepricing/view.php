<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Quotepricing */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Quotepricings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quotepricing-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'quote_id',
            'viewed',
            'emailed:email',
            'estimatedDelivery',
            'totalPrice',
            'totalHours',
            'totalMaterial',
            'margin',
            'shopRate',
            'patternOwner',
            'patternNumber',
            'dateIssued',
            'revision',
            'job_id',
            'category',
            'quotedby',
        ],
    ]) ?>

</div>
