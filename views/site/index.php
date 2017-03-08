<?php

/* @var $this yii\web\View */

use yii\web\View;

/**
 * Identifies chart for the SiteController to build.
 *
 * Zero-indexed array definition
 * 0 = chart type
 * 1 = Title for translation
 * 2 = Horizontal label for translation
 * 3 = columns
 */
$charts = [
	[
		'chart'           => 'monthly',
		'title'           => 'Monthly Performance (Booked Jobs)',
		'horizontal-axis' => 'Month',
	],
	[
		'chart'           => 'quarterly',
		'title'           => 'Quarterly Sales',
		'horizontal-axis' => 'Quarter',
	],
	[
		'chart'           => 'open',
		'title'           => 'Open Orders by Month',
		'horizontal-axis' => 'Month',
	],
	[
		'chart'           => 'ytd',
		'title'           => 'Year to Date',
		'horizontal-axis' => 'Year',
	],
	[
		'chart'           => 'openhrs',
		'title'           => 'Year to Date (Open Hours)',
		'horizontal-axis' => 'Hours',
	],
	[
		'chart'           => 'outstanding',
		'title'           => 'Outstanding Invoices',
		'horizontal-axis' => 'Invoices',
	],
];

$year = 2017; //Year for charts
$time = time();

$this->title = 'Dashboard';
$this->registerJsFile( 'https://www.gstatic.com/charts/loader.js', [
	'position' => View::POS_HEAD,
	'depends'  => \yii\web\JqueryAsset::className(),
	// Does not specifically require jquery but the $.ajax commands below do
] );
$this->registerJs('
google.charts.load(\'current\', {
	callback: drawCharts,
	packages: [\'corechart\']
	});
function drawCharts() {
			  var jsonData = $.ajax({
						url: "site/get-data?chart='.$charts[0]['chart'].'&year='.$year.'&cid='.$time.'",
						dataType: "json",
						async: false
				}).responseText;
			  var jsonDataQ = $.ajax({
						url: "site/get-data?chart='.$charts[1]['chart'].'&year='.$year.'&cid='.$time.'",
						dataType: "json",
						async: false
				}).responseText;
				
			  var jsonData2 = $.ajax({
						url: "site/get-data?chart='.$charts[2]['chart'].'&year='.$year.'&cid='.$time.'",
						dataType: "json",
						async: false
				}).responseText;
				
			  var jsonData3 = $.ajax({
						url: "site/get-data?chart='.$charts[3]['chart'].'&year='.$year.'&cid='.$time.'",
						dataType: "json",
						async: false
				}).responseText;
				
			  var jsonData4 = $.ajax({
						url: "site/get-data?chart='.$charts[4]['chart'].'&year='.$year.'&cid='.$time.'",
						dataType: "json",
						async: false
				}).responseText;
				
			  var jsonData5 = $.ajax({
						url: "site/get-data?chart='.$charts[5]['chart'].'&year='.$year.'&cid='.$time.'",
						dataType: "json",
						async: false
				}).responseText;
				
        var data = new google.visualization.DataTable(jsonData);
        var dataq = new google.visualization.DataTable(jsonDataQ);
        var data2 = new google.visualization.DataTable(jsonData2);
        var data3 = new google.visualization.DataTable(jsonData3);
        var data4 = new google.visualization.DataTable(jsonData4);
        var data5 = new google.visualization.DataTable(jsonData5);
				
				var formatter = new google.visualization.NumberFormat({prefix: \'$\', negativeColor: \'red\', negativeParens: true});
						formatter.format(data,1); // Apply formatter to first column
						formatter.format(data,2); // Apply formatter to second column
                        formatter.format(dataq,1); // Apply formatter to first column
						formatter.format(dataq,2); // Apply formatter to second column
						formatter.format(data2,1); // Apply formatter to first column					
						formatter.format(data3,1); // Apply formatter to first column
						formatter.format(data3,2); // Apply formatter to second column
						formatter.format(data3,3); // Apply formatter to third column	
						formatter.format(data5,1); // Apply formatter to first column
						formatter.format(data5,2); // Apply formatter to second column
						formatter.format(data5,3); // Apply formatter to third column
						formatter.format(data5,4); // Apply formatter to fourth column
					
        var chart = new google.visualization.ColumnChart(document.getElementById(\'chart_div\'));
        chart.draw(data, {width: 600, height: 350, title: \''.Yii::t('app',$charts[0]['title']).'\',
                          hAxis: {title: \''.Yii::t('app',$charts[0]['horizontal-axis']).'\', titleTextStyle: {color: \'red\'}}
                         });
        
        var chartq = new google.visualization.ColumnChart(document.getElementById(\'chart_div-q\'));
                          chartq.draw(dataq, {width: 600, height: 350, title: \''.Yii::t('app',$charts[1]['title']).'\',
                          hAxis: {title: \''.Yii::t('app',$charts[1]['horizontal-axis']).'\', titleTextStyle: {color: \'red\'}}
                         });
												 
        var chart2 = new google.visualization.ColumnChart(document.getElementById(\'chart_div2\'));
				chart2.draw(data2, {width: 600, height: 350, title: \''.Yii::t('app',$charts[2]['title']).'\',
				 
										 colors:[\'green\'],
														hAxis: {title: \''.Yii::t('app',$charts[2]['horizontal-axis']).'\',
										 titleTextStyle: {color: \'red\'}}
												 });
												 
        var chart3 = new google.visualization.ColumnChart(document.getElementById(\'chart_div3\'));
				chart3.draw(data3, {width: 600, height: 350, 
										 title: \''.Yii::t('app',$charts[3]['title']).'\',
										 colors:[\'blue\',\'red\',\'green\'],
										 hAxis: {title: \''.Yii::t('app',$charts[3]['horizontal-axis']).'\'}
										});
										
        var chart4 = new google.visualization.ColumnChart(document.getElementById(\'chart_div4\'));
				chart4.draw(data4, {width: 600, height: 350, title: \''.Yii::t('app',$charts[4]['title']).'\',
														hAxis: {title: \''.Yii::t('app',$charts[4]['horizontal-axis']).'\', titleTextStyle: {color: \'red\'}}
												 });
												 
        var chart5 = new google.visualization.ColumnChart(document.getElementById(\'chart_div5\'));
				chart5.draw(data5, {width: 600, height: 350, title: \''.Yii::t('app',$charts[5]['title']).'\',
														hAxis: {title: \''.Yii::t('app',$charts[5]['horizontal-axis']).'\', titleTextStyle: {color: \'red\'}}
												 });
	}
', View::POS_BEGIN );
?>

<div class="site-index">

	<div class="body-content">
		<div class="row">
			<div class="col-lg-4" id="chart_div"></div>
			<div class="col-lg-4" id="chart_div-q"></div>
			<div class="col-lg-4" id="chart_div2"></div>
		</div>
		<div class="row">
			<div class="col-lg-4" id="chart_div3"></div>
			<div class="col-lg-4" id="chart_div4"></div>
			<div class="col-lg-4" id="chart_div5"></div>
		</div>
	</div>
</div>
