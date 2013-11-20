<?php
require 'inc/functions.php';
require_once 'inc/phpgraphlib.php';

$date = $_GET['date'];
$month2 = "2013-05";


$daycount = count_traffic_month($date);
$block_count = count_block_month($month2);

if ($_GET['graph'] == 'traffic'){
	
	$graph = new PHPGraphLib(550,350);
	$t_dataArray = array();
	while ($row = mysqli_fetch_array($daycount)) {
		$date = explode('-',$row['date']);
		$day = $date[2];
		$bytes = $row['bytes'];
		$traffic = $traffic = round(($bytes / 1048576), 2);
		$t_dataArray[$day]=$traffic;
	}
	
	$graph->addData($t_dataArray);
	$graph->setGradient("lime", "green");
	$graph->setBarOutlineColor("black");
	$graph->setDataValues(true);
	$graph->createGraph();
}
if ($_GET['graph'] == 'block'){
	$graph = new PHPGraphLib(550,350);
	$dataArray = array();
	
	while ($row = mysqli_fetch_array($block_count)) {
		$date = explode('-',$row['date']);
		$day = $date[2];
		$block = $row['blocks'];
		$dataArray[$day]=$block;
	}
	
	$graph->addData($dataArray);
	$graph->setGradient("lime", "green");
	$graph->setBarOutlineColor("black");
	$graph->setDataValues(true);
	$graph->createGraph();
}

?>