<?php
#############################################################################
# 						Ninja Squid Log Parser								#
# Copyright 2013, Lionel Wolfaardt ninjageek@theninjageek.co.za				#
# 																			#
# This Parser is used in conjunction with Ninja Squid Report 				#
# and is used for parsing the Squid log files into a MySQL database 		#
# either locally or remotely.  												#
# The php file is run via the command line either manually or via cron on 	#
# the Squid system															#
#																			#
# The first part of the file is used for the config options.				#
# The second part is the actual code.										#
#############################################################################

// Config section - Edit to your enviroment
// Log file locations:
$squidlog = "access.log";
$blocklog = "block.log";

// MySQL connection details
$server = "localhost";
$user = 'root';
$pass = '';
$database = 'ninjasquid';

//MySQL connection string
$db = new mysqli($server, $user, $pass, $database);

if ($db->connect_errno) {
	printf("connection Failed: %s\n", $db->connect_error);
	exit();
}

//CODE Section - Do Not Edit:
//Define some functions:
function one_row_select($query){
	global $db;
	$result = $db->query($query);
	$row = @mysqli_fetch_array($result);
	return $row;
}
function insert($query){
	global $db;
	$result = $db->query($query);
	$InsertID = mysqli_insert_id($db);
	return $InsertID;
}

while (($timezone_diff = (time() - time()))%10);
set_time_limit(0);
function getTimestamp($stampname) {
	global $db;
	$query  = "SELECT $stampname from timestamp";
	$timestamp = one_row_select($query);
	return $timestamp[$stampname];

}
function updateTimestamp($stampname, $time) {
	global $db;
	$query="UPDATE timestamp SET $stampname = '$time'";
	one_row_select($query);
}

while (($timezone_diff = (time() - time()))%10);
set_time_limit(0);


//Proccess SQUID logs:
$file_squid = fopen($squidlog, "r");
$buff_squid = fgets($file_squid);
$array_squid = preg_split("/\s+/", $buff_squid);

$beginTime = getTimestamp("squidfirst");
$endTime = getTimestamp("squidlast");

if ($array_squid[0] == $beginTime && $beginTime != ''){
	fseek($file_squid, $endTime);
}
else {
	fseek($file_squid, 0);
	updateTimestamp("squidlast", 0);
	updateTimestamp("squidfirst", $array_squid[0]);
}
while ((!feof($file_squid)) && ($squidlog != ''))
{
	$buff_squid = fgets($file_squid);
	$array_squid = preg_split("/\s+/", $buff_squid);

	

		//build variables from array:
		$squid_date = date('Y-m-d', $array_squid[0]+$timezone_diff);
		$squid_time = date('H:i:s', $array_squid[0]+$timezone_diff);
		$squid_host = $array_squid[2];
		$result_code =  explode('/', $array_squid[3]);
		$squid_result = $result_code[0];
		$squid_bytes = $array_squid[4];
		$squid_target = $array_squid[6];
		$squid_user = substr($array_squid[7], 0, 50);

		$squid_url = parse_url($squid_target);
		$squid_site = $squid_url['host'];



		//Populate Database:
		//Populate Site Table:
		$query = "SELECT id FROM site WHERE site = '$squid_site'";
		$result = one_row_select($query);
		if ($result['id'] == '') {
			$query = "INSERT INTO site(site) VALUES ('$squid_site')";
			$site_id = insert($query);
		}
		else {
			$site_id = $result['id'];
		}
		//Populate user table:
		$query = "SELECT id FROM users WHERE user = '$squid_user'";
		$result = one_row_select($query);
		if ($result['id'] == ''){
			$query = "INSERT INTO users(user) VALUES ('$squid_user')";
			$user_id = insert($query);
		}
		else {
			$user_id = $result['id'];
		}
		//Populate hosts table:
		$query = "SELECT id FROM hosts WHERE hosts = '$squid_host'";
		$result = one_row_select($query);
		if ($result['id'] == ''){
			$query = "INSERT INTO hosts(hosts) VALUES ('$squid_host')";
			$host_id = insert($query);
		}
		else {
			$host_id = $result['id'];
		}
		//Populate category table:
		$query = "SELECT id FROM category WHERE result = '$squid_result'";
		$result = one_row_select($query);
		if ($result['id'] == ''){
			$query = "INSERT INTO category(result) VALUES ('$squid_result')";
			$result_id = insert($query);
		}
		else {
			$result_id = $result['id'];
		}
		//Populate site_traffic Table:
		$query = "INSERT INTO site_traffic(site_id, bytes, target, date, time, user_id, host_id) VALUES (
		'$site_id',
		'$squid_bytes',
		'$squid_target',
		'$squid_date',
		'$squid_time',
		'$user_id',
		'$host_id')";
		$site_traffic_id = insert($query);

		//Populate traffic Table:
		$query = "INSERT INTO traffic(site_id, traffic, date, time, user_id, host_id, category_id, site_traffic_id) VALUES (
		'$site_id',
		'$squid_bytes',
		'$squid_date',
		'$squid_time',
		'$user_id',
		'$host_id',
		'$result_id',
		'$site_traffic_id')";
		$insertID = insert($query);
		
		updateTimestamp("squidlast", ftell($file_squid));

}

//Process Block Logs:
$file_block = fopen($blocklog, "r");

while ((!feof($file_block)) && ($blocklog != '')){
	$buff_block = fgets($file_block);
	$array_block = preg_split("/\s+/", $buff_block);
	
	//convert block date to actually date:
	$date =  $array_block[0];
	$time = $array_block[1];
	
	$dateInfo = date_parse_from_format('Y-m-d', $date);
	$timeInfo = date_parse_from_format('H:i:s', $time);
	$unixTimestamp = mktime(
			$timeInfo['hour'], $timeInfo['minute'], $timeInfo['second'],
			$dateInfo['month'], $dateInfo['day'], $dateInfo['year']
	);
	$block_date = date('Y-m-d', $unixTimestamp+$timezone_diff);
	$block_time = date('H:i:s', $unixTimestamp+$timezone_diff);
	
	$block_ip = explode('/', $array_block[5]);
	$block_hosts = $block_ip[0];
	
	$category = explode('/', $array_block[3]);
	$block_category = $category[1];
	
	$block_target = addslashes($array_block[4]);
	$block_url = parse_url($block_target);
	$block_site = $block_url['host'];
	
	//Populate Database:
	
	//Populate category table:
	$query = "SELECT id FROM category WHERE category = '$block_category'";
	$result = one_row_select($query);
	if ($result['id'] == ''){
		$query = "INSERT INTO category(category) VALUES ('$block_category')";
		$category_id = insert($query);
	}
	else {
		$category_id = $result['id'];
	}
	
	//Populate Site Table:
	$query = "SELECT id FROM site WHERE site = '$block_site'";
	$result = one_row_select($query);
	if ($result['id'] == '') {
		$query = "INSERT INTO site(site) VALUES ('$block_site')";
		$block_site_id = insert($query);
	}
	else {
		$block_site_id = $result['id'];
	}
	
	//Populate hosts table:
	$query = "SELECT id FROM hosts WHERE hosts = '$block_hosts'";
	$result = one_row_select($query);
	if ($result['id'] == ''){
		$query = "INSERT INTO hosts(hosts) VALUES ('$block_hosts')";
		$block_host_id = insert($query);
	}
	else {
		$block_host_id = $result['id'];
	}
	
	//Populate blocked table:
	$query = "SELECT id FROM blocked WHERE site_id = '$block_site_id'
	and date = '$block_date'
	and time = '$block_time'
	and host_id = '$block_host_id'
	and category_id = '$category_id'";
	$result = one_row_select($query);
	if ($result['id'] == ''){
		$query = "INSERT into blocked(site_id, date, time, host_id, category_id) VALUES (
		'$block_site_id',
		'$block_date',
		'$block_time',
		'$block_host_id',
		'$category_id')";
		$BlockID = insert($query);

	}

}

?>