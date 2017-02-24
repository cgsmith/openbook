<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Quotepricing */

$this->title = Yii::t('app', 'Create Quotepricing');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Quotepricings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quotepricing-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
