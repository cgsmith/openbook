<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Companies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Company'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'address',
            'citystzip',
            'phone',
            'fax',
            // 'shoprate',
            // 'margin',
            // 'nextpayroll',
            // 'payrollsetting',
            // 'payroll_emails:email',
            // 'vacation_reminder_emails:email',
            // 'smtp_user',
            // 'smtp_password',
            // 'smtp_from',
            // 'smtp_bcc',
            // 'smtp_port',
            // 'smtp_server',
            // 'smtp_testing',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
