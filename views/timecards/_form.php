<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Timecards */
/* @var $activeEmployees app\models\Employees */
/* @var $activeJobs app\models\Jobs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="timecards-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'employee_id')->dropDownList($activeEmployees,['prompt'=>Yii::t('app','Select Employee')]) ?>

    <?= $form->field($model, 'job_id')->dropDownList($activeJobs, ['prompt'=>Yii::t('app','Select Job')]) ?>

    <?= $form->field($model, 'dateWorked')->textInput() ?>

    <?= $form->field($model, 'hours')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'comments')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
