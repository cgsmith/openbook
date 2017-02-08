<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Jobs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jobs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'quote_id')->textInput() ?>

    <?= $form->field($model, 'quote_rev')->textInput() ?>

    <?= $form->field($model, 'customer_shopnumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shopNumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dateReceived')->textInput() ?>

    <?= $form->field($model, 'dateDue')->textInput() ?>

    <?= $form->field($model, 'timeMaterial')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PONumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'patternShrink')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'finishStock')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'devonsnotes')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'color')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
