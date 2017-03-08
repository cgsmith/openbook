<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PackingslistsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="packinglists-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'job_id') ?>

    <?= $form->field($model, 'dateShipped') ?>

    <?= $form->field($model, 'shipVia') ?>

    <?= $form->field($model, 'complete') ?>

    <?php // echo $form->field($model, 'shipTo') ?>

    <?php // echo $form->field($model, 'contact') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
