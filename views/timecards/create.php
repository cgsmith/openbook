<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Timecards */
/* @var $activeEmployees app\models\Employees */
/* @var $activeJobs app\models\Jobs */

$this->title = Yii::t('app', 'Create Timecards');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Timecards'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timecards-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'activeEmployees' => $activeEmployees,
        'activeJobs' => $activeJobs,
    ]) ?>

</div>
