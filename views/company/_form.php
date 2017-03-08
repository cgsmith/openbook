<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'citystzip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shoprate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'margin')->textInput() ?>

    <?= $form->field($model, 'nextpayroll')->textInput() ?>

    <?= $form->field($model, 'payrollsetting')->textInput() ?>

    <?= $form->field($model, 'payroll_emails')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vacation_reminder_emails')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'smtp_user')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'smtp_password')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'smtp_from')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'smtp_bcc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'smtp_port')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'smtp_server')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'smtp_testing')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
