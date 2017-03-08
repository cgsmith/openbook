<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CompanySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'address') ?>

    <?= $form->field($model, 'citystzip') ?>

    <?= $form->field($model, 'phone') ?>

    <?= $form->field($model, 'fax') ?>

    <?php // echo $form->field($model, 'shoprate') ?>

    <?php // echo $form->field($model, 'margin') ?>

    <?php // echo $form->field($model, 'nextpayroll') ?>

    <?php // echo $form->field($model, 'payrollsetting') ?>

    <?php // echo $form->field($model, 'payroll_emails') ?>

    <?php // echo $form->field($model, 'vacation_reminder_emails') ?>

    <?php // echo $form->field($model, 'smtp_user') ?>

    <?php // echo $form->field($model, 'smtp_password') ?>

    <?php // echo $form->field($model, 'smtp_from') ?>

    <?php // echo $form->field($model, 'smtp_bcc') ?>

    <?php // echo $form->field($model, 'smtp_port') ?>

    <?php // echo $form->field($model, 'smtp_server') ?>

    <?php // echo $form->field($model, 'smtp_testing') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
