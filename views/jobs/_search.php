<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JobsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jobs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'quote_id') ?>

    <?= $form->field($model, 'quote_rev') ?>

    <?= $form->field($model, 'customer_shopnumber') ?>

    <?= $form->field($model, 'shopNumber') ?>

    <?php // echo $form->field($model, 'dateReceived') ?>

    <?php // echo $form->field($model, 'dateDue') ?>

    <?php // echo $form->field($model, 'timeMaterial') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'PONumber') ?>

    <?php // echo $form->field($model, 'patternShrink') ?>

    <?php // echo $form->field($model, 'finishStock') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'notes') ?>

    <?php // echo $form->field($model, 'devonsnotes') ?>

    <?php // echo $form->field($model, 'color') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
