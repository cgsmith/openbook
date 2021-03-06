<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t( 'app', 'Customers' );
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-index">

	<h1><?= Html::encode( $this->title ) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a( Yii::t( 'app', 'Create Customers' ), [ 'create' ], [ 'class' => 'btn btn-success' ] ) ?>
	</p>
	<?= GridView::widget( [
		'dataProvider' => $dataProvider,
		'filterModel'  => $searchModel,
		'columns'      => [
			'shopNumber',
			'name',
			//'billingContact',
			//'billingEmail:email',
			'address1',
			'address2',
			'city',
			'state',
			'zip',
			[
				'class'    => 'yii\grid\ActionColumn',
				'template' => '{view} {open} {update} {delete}',
				'buttons'  => [
					'view'   => function ( $url, $model ) {
						return Html::a( '<span class="glyphicon glyphicon-eye-open">' . '</span>', $url, [
							'title' => Yii::t( 'yii', 'View' ),
						] );
					},
					'open'   => function ( $url, $model ) {
						return Html::a( '<span class="glyphicon glyphicon-folder-open">' . '</span>', $url, [
							'title' => Yii::t( 'app', 'Open Orders' ),
						] );
					},
					'update' => function ( $url, $model ) {
						return Html::a( '<span class="glyphicon glyphicon-pencil">' . '</span>', $url, [
							'title' => Yii::t( 'yii', 'Update' ),
						] );
					},
					'delete' => function ( $url, $model ) {
						return Html::a( '<span class="glyphicon glyphicon-trash">'  . '</span>', $url, [
							'title'        => Yii::t( 'yii', 'Delete' ),
							'data-confirm' => Yii::t( 'yii', 'Are you sure to delete this item?' ),
							'data-method'  => 'post',
						] );
					},
				],

			],
		],
	] ); ?>
</div>
