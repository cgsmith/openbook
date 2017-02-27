<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
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

    <div class="form-group">

        <?php
            if (!$quote->isNewRecord) {
                echo Html::submitButton(Yii::t('app', 'Edit Current Revision'), ['class' => 'btn btn-primary']);
                // Dropdown of edit and edit current revision?
                echo Html::submitButton(Yii::t('app', 'Edit'), ['class' => 'btn btn-primary']);
                echo Html::submitButton(Yii::t('app', 'Clone'), ['class' => 'btn btn-primary']);
                echo Html::submitButton(Yii::t('app', 'Add to Pending'), ['class' => 'btn btn-primary']);
                echo Html::submitButton(Yii::t('app', 'Email Quote'), ['class' => 'btn btn-primary']);
                echo Html::submitButton(Yii::t('app', 'Convert to Job'), ['class' => 'btn btn-primary']);
                echo Html::submitButton(Yii::t('app', 'Print'), ['class' => 'btn btn-primary']);
                echo Html::submitButton(Yii::t('app', 'Delete'), ['class' => 'btn btn-primary']);

        }
        ?>

    </div>
    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'horizontalCssClasses' => [
                'label' => 'col-sm-2',
                'offset' => 'col-sm-offset-2',
                'wrapper' => 'col-sm-4',
            ],
        ],
    ]); ?>

    <div class="col-md-6">

    <?php
    // Customer
    echo $form->field($quote, 'customer_id', ['attribute'=>Yii::t('app','Customer')])->dropDownList($activeCustomers, [
        'id'=>'customer-id',
        'prompt'=>Yii::t('app','Select Customer')
    ]);?></div>
    <div class="col-md-6">

    <?php

    // Contact
    echo $form->field($quote, 'contact_id')->widget(DepDrop::classname(), [
        'options'=>['id'=>'subcat-id'],
        'pluginOptions'=>[
            'depends'=>['customer-id'],
            'placeholder'=>'Select...',
            'url'=> Url::to(['/contacts/subcat'])
        ]
    ]);?></div>
    <div class="col-md-6">

        <?php


        // I'll need to find a way to make these widgets easier in the long run
    echo $form->field($quotePricing, 'patternNumber')->widget(Typeahead::classname(), [
        'scrollable' => true,
        'dataset' => [
            [
                'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                'display' => 'value',
                'remote' => [
                    'url' => Url::to(['quotepricing/remote-list']) . '?type=patternNumber&q=%QUERY',
                    'wildcard' => '%QUERY'
                ]
            ]
        ]
    ]);
        ?></div>
    <div class="col-md-6">

        <?php

    echo $form->field($quotePricing, 'patternOwner')->widget(Typeahead::classname(), [
        'scrollable' => true,
        'dataset' => [
            [
                'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                'display' => 'value',
                'remote' => [
                    'url' => Url::to(['quotepricing/remote-list']) . '?type=patternOwner&q=%QUERY',
                    'wildcard' => '%QUERY'
                ]
            ]
        ]
    ]);
        ?></div>
    <div class="col-md-6">

        <?php

    echo $form->field($quote, 'category')->widget(Typeahead::classname(), [
        'scrollable' => true,
        'dataset' => [
            [
                'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                'display' => 'value',
                'remote' => [
                    'url' => Url::to(['quotes/remote-list']) . '?type=category&q=%QUERY',
                    'wildcard' => '%QUERY'
                ]
            ]
        ]
    ]);
        ?></div>

        <?php


    // Instruction List
    /*echo $form->field($quoteDetails, 'instruction')->widget(DepDrop::classname(), [
        'options'=>['id'=>'subcat-id','multiple'=>50,],
        'pluginOptions'=>[
            'depends'=>['customer-id'],
            'placeholder'=>'Select customer...',
            'url'=> Url::to(['quotedetails/subcat']),
        ]
    ]);*/

    ?>

    <div class="form-group">
        <?= Html::submitButton($quote->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $quote->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
