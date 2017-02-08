<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::t('app','Open Books'),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => Yii::t('app','Dashboard'), 'url' => ['/site/index'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => Yii::t('app','Quotes'), 'url' => ['/quotes/index'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => Yii::t('app','Jobs'), 'url' => ['/jobs/index'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => Yii::t('app','Invoices'), 'url' => ['/invoices/index'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => Yii::t('app','Timecards'), 'url' => ['/timecards/index'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => Yii::t('app','Customers'), 'url' => ['/customer/index'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => Yii::t('app','Open Orders'), 'url' => ['/site/index'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => Yii::t('app','Categories'), 'url' => ['/site/index'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => Yii::t('app','Settings'), 'url' => ['/settings/index'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => Yii::t('app','Search'), 'url' => ['/search/index'], 'visible' => !Yii::$app->user->isGuest],
             Yii::$app->user->isGuest ?
                ['label' => Yii::t('app','Login'), 'url' => ['/user/security/login']] :
                ['label' => Yii::t('app','Logout') . ' (' . Yii::$app->user->identity->username . ')',
                 'url' => ['/user/security/logout'],
                 'linkOptions' => ['data-method' => 'post']],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
