<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Quotepricing */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quotepricing-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'quote_id')->textInput() ?>

    <?= $form->field($model, 'viewed')->textInput() ?>

    <?= $form->field($model, 'emailed')->textInput() ?>

    <?= $form->field($model, 'estimatedDelivery')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'totalPrice')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'totalHours')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'totalMaterial')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'margin')->textInput() ?>

    <?= $form->field($model, 'shopRate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'patternOwner')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'patternNumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dateIssued')->textInput() ?>

    <?= $form->field($model, 'revision')->textInput() ?>

    <?= $form->field($model, 'job_id')->textInput() ?>

    <?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quotedby')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
