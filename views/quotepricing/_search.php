<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\QuotepricingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quotepricing-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'quote_id') ?>

    <?= $form->field($model, 'viewed') ?>

    <?= $form->field($model, 'emailed') ?>

    <?= $form->field($model, 'estimatedDelivery') ?>

    <?php // echo $form->field($model, 'totalPrice') ?>

    <?php // echo $form->field($model, 'totalHours') ?>

    <?php // echo $form->field($model, 'totalMaterial') ?>

    <?php // echo $form->field($model, 'margin') ?>

    <?php // echo $form->field($model, 'shopRate') ?>

    <?php // echo $form->field($model, 'patternOwner') ?>

    <?php // echo $form->field($model, 'patternNumber') ?>

    <?php // echo $form->field($model, 'dateIssued') ?>

    <?php // echo $form->field($model, 'revision') ?>

    <?php // echo $form->field($model, 'job_id') ?>

    <?php // echo $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'quotedby') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
