<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Instructions */

$this->title = Yii::t('app', 'Create Instructions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Instructions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instructions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
