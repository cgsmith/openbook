<?php

use app\common\widgets\Sublink;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\widgets\DepDrop;
use kartik\widgets\Typeahead;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $quote app\models\Quotes */
/* @var $quotePricing app\models\Quotepricing */
/* @var $quoteDetails app\models\Quotedetails */
/* @var $activeCustomers app\models\activeCustomers */
/* @var $form yii\widgets\ActiveForm */

$this->registerCss('.ui-state-highlight { height: 34px; }');
$this->registerAssetBundle(yii\jui\JuiAsset::className());
// Sortable quote details
$this->registerJs('$( "#quote-details" ).sortable({
      placeholder: "ui-state-highlight"
    });
    $( "#quote-details" ).disableSelection();',View::POS_READY);
// Show remove button on quote details on hover
$this->registerJs(" $(document).on('mouseenter', '.quote-detail-row', function () {
        $(this).find(\":button\").show();
    }).on('mouseleave', '.quote-detail-row', function () {
        $(this).find(\":button\").hide();
    }).on('click', '#quote-detail-remove', function() {
        $(this).parent().remove();
    });", View::POS_READY);
?>

<div class="quotes-form">

    <div class="form-group">

        <?= Sublink::widget(['type' => 'quote', 'status' => !$quote->isNewRecord, 'id' => $quote->id, 'revision' => $quote->revision]); ?>

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

    <div class="row" id="quote-header">
        <?=Html::activeHiddenInput($quote, 'revision',['value'=>($quote->revision + 1)]); // Increment revision ?>
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
            ]);?>
        </div>
    </div>
    <div class="row" id="quote-details-header">
        <div class="col-xs-6 col-md-7"><strong><?=Yii::t('app','Instructions')?></strong></div>
        <div class="col-xs-6 col-md-2"><strong><?=Yii::t('app','Hours')?></strong></div>
        <div class="col-xs-6 col-md-2"><strong><?=Yii::t('app','Material')?></strong></div>
    </div>

    <div id="quote-details">
    <?php
    foreach ($quoteDetails as $index => $detail) {
        ?>
        <div class="row quote-detail-row" id="sortable">
            <div class="col-xs-6 col-md-7">
                <?=$form->field($detail,"[$index]instruction",['template'=>'{input}','validateOnChange'=>false]);?>
            </div>
            <div class="col-xs-6 col-md-2">
                <?=$form->field($detail,"[$index]hours",['template'=>'{input}'])->input('number');?>
            </div>
            <div class="col-xs-6 col-md-2">
                <?=$form->field($detail,"[$index]material",['template'=>'{input}'])->input('number', ['step'=>'0.01']);?>
            </div>
            <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="quote-detail-remove">
                <i class="glyphicon glyphicon-remove"></i>
            </button>
        </div>
    <?php } ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($quote->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $quote->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
