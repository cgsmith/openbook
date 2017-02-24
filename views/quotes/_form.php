<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use kartik\widgets\Typeahead;

/* @var $this yii\web\View */
/* @var $quote app\models\Quotes */
/* @var $quotePricing app\models\Quotepricing */
/* @var $quoteDetails app\models\Quotedetails */
/* @var $activeCustomers app\models\activeCustomers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quotes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    // Customer
    echo $form->field($quote, 'customer_id', ['attribute'=>Yii::t('app','Customer')])->dropDownList($activeCustomers, [
        'id'=>'customer-id',
        'prompt'=>Yii::t('app','Select Customer')
    ]);

    // Contact
    echo $form->field($quote, 'contact_id')->widget(DepDrop::classname(), [
        'options'=>['id'=>'subcat-id'],
        'pluginOptions'=>[
            'depends'=>['customer-id'],
            'placeholder'=>'Select...',
            'url'=> Url::to(['/contacts/subcat'])
        ]
    ]);

    echo $form->field($quotePricing, 'category')->widget(Typeahead::classname(), [
        'options' => ['placeholder' => ''],
        'scrollable' => true,
        'dataset' => [
            [
                'prefetch' => Url::to(['quotepricing/category-list']),
                'limit' => 10
            ]
        ]
    ]);

    ?>

    <?= $form->field($quote, 'notes')->textarea(['rows' => 6]) ?>


    <?= $form->field($quote, 'category')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($quote->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $quote->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
