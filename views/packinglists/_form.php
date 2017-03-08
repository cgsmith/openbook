<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Packinglists */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="packinglists-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'job_id')->textInput() ?>

    <?= $form->field($model, 'dateShipped')->textInput() ?>

    <?= $form->field($model, 'shipVia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'complete')->textInput() ?>

    <?= $form->field($model, 'shipTo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
