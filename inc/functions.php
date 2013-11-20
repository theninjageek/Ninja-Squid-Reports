<?php
require ("nsr.inc");
//MySQL Single Row Query:
function one_row_select($query){
	global $db;
	$result = $db->query($query);
	$row = @mysqli_fetch_array($result);
	return $row;
}
//Function to return Unique Dates:
function months_years(){
	global $db;
	$query = "Select DISTINCTROW(date) as date from traffic ORDER BY date";
	$result = $db->query($query);
	return $result;
}
//Function to return unique year for index menu:
function get_year()
{
	$date = months_years();
	while ($row = mysqli_fetch_array($date)){
		$rows[]= explode('-', $row['date']);
	}
	foreach ($rows as $row){
		$y[] = $row;
	}
	for ($e = 0; $e < count($y); $e++)
	{
		$duplicate = null;
		for ($ee = $e+1; $ee < count($y); $ee++)
		{
			if (strcmp($y[$ee][0],$y[$e][0]) === 0)
			{
				$duplicate = $ee;
				break;
			}
		}
		if (!is_null($duplicate))
			array_splice($y,$duplicate,1);
	}
	foreach ( $y as $k=>$v)
	{
		$y[$k] ['year'] = $y[$k][0];unset($y[$k][0]);
		$y[$k] ['months'] = $y[$k][1];unset($y[$k][1]);
		$y[$k] ['day'] = $y[$k][2];unset($y[$k][2]);
	}
	foreach ($y as $k)
	{
		extract($k);
		echo "<a href='index.php?year=".$year."&month=".$_GET['month']."'title='Select Year to Display'>".$year."</a> ";
	}
}
//Function to return unique month for index menu:
function get_month()
{
	$date = months_years();
	while ($row = mysqli_fetch_array($date)){
		$rows[]= explode('-', $row['date']);
	}
	foreach ($rows as $row){
		$y[] = $row;
	}
	for ($e = 0; $e < count($y); $e++)
	{
		$duplicate = null;
		for ($ee = $e+1; $ee < count($y); $ee++)
		{
			if (strcmp($y[$ee][1],$y[$e][1]) === 0)
			{
				$duplicate = $ee;
				break;
			}
		}
		if (!is_null($duplicate))
			array_splice($y,$duplicate,1);
	}
	foreach ( $y as $k=>$v)
	{
		$y[$k] ['year'] = $y[$k][0];unset($y[$k][0]);
		$y[$k] ['month'] = $y[$k][1];unset($y[$k][1]);
		$y[$k] ['day'] = $y[$k][2];unset($y[$k][2]);
	}
	foreach ($y as $k)
	{
		extract($k);
		echo "<a href='index.php?year=".$_GET['year']."&month=".$month."'title='Select Month to Display'>".$month."</a> ";
	}
}
//Function to count month traffic:
function count_traffic_month($month){
	global $db;
	$query = "SELECT date, COUNT(DISTINCTROW(site_id)) as siteID, COUNT(DISTINCTROW(user_id)) as userID, 
			COUNT(DISTINCTROW(host_id)) as hostID, SUM(traffic) as bytes from traffic where date LIKE '$month%'
			GROUP BY date";
	$result = $db->query($query);
	return $result;
}
//Function to calculate total traffic:
function total_traffic($date){
	$query = "SELECT SUM(traffic) as bytes from traffic where date LIKE '$date%'";
	$result = one_row_select($query);
	return $result;
}
//Coverts bytes to human readable format:
function convertBytes($bytes){
	$tb = 1099511627776;
	$gb = 1073741824;
	$mb = 1048576;
	$kb = 1023;
	if ($bytes >= $tb){
		$traffic = round(($bytes / $tb), 2)." TB";
	} 
	elseif (($bytes >= $gb) && ($bytes <= $tb)){
		$traffic = round(($bytes / $gb), 2)." GB";
	}
	elseif (($bytes >= $mb) && ($bytes <= $gb)){
		$traffic = round(($bytes / $mb), 2)." MB";
	}
	elseif (($bytes >= $kb) && ($bytes <= $mb)){
		$traffic = round(($bytes / $kb), 2)." KB";
	}
	else {
		$traffic = $bytes." B";
	}
	return $traffic;
}
//Function to count blocked sites for month:
function count_block_month($month){
	global $db;
	$query = "SELECT date, COUNT(id) as blocks, COUNT(DISTINCTROW(site_id)) as siteID, COUNT(DISTINCTROW(host_id)) as hostID, 
			COUNT(DISTINCTROW(category_id)) as categoryID from blocked WHERE date LIKE '$month%'
			GROUP BY date";
	$result = $db->query($query);
	return $result;
}
//Function to count total Blocks:
function total_block($date){
	$query = "SELECT COUNT(id) as id FROM blocked WHERE date LIKE '$date%'";
	$result = one_row_select($query);
	return $result['id'];
}
//Function to return each block for that day:
function block($date){
	global $db;
	$query = "SELECT blocked.date as date, blocked.time as time, site.site as site, hosts.hosts as host, category.category as category FROM blocked
			INNER JOIN site
			ON site.id=blocked.site_id
			INNER JOIN hosts
			ON hosts.id=blocked.host_id
			INNER JOIN category
			ON category.id=blocked.category_id
			WHERE blocked.date = '$date'
			ORDER BY host";
	$result = $db->query($query);
	return $result;
}
//Return Full list for day:
function date_full($date){
	global $db;
	$query = "SELECT traffic.date as date, traffic.time as time, users.user as user, hosts.hosts as host, category.result as result,
			site_traffic.target as site, traffic.traffic as bytes
			FROM traffic
			INNER JOIN hosts
			ON hosts.id=traffic.host_id
			INNER JOIN site_traffic
			ON site_traffic.id=traffic.site_traffic_id
			INNER JOIN users
			ON users.id=traffic.user_id
			INNER JOIN category
			ON category.id=traffic.category_id
			where traffic.date = '$date'
			ORDER BY time";
	$result = $db->query($query);
	return $result;
}
//Return host counts for day:
function date_host($date){
	global $db;
	$query = "SELECT traffic.date as date, COUNT(DISTINCTROW(traffic.user_id)) as user, hosts.hosts as host, COUNT(DISTINCTROW(traffic.site_id)) as sites, SUM(traffic.traffic) as bytes
			FROM traffic
			INNER JOIN hosts
			ON hosts.id=traffic.host_id
			where date = '$date'
			GROUP BY host
			ORDER BY bytes DESC";
	$result = $db->query($query);
	return $result;
}
//Returns user counts for day:
function date_user($date){
	global $db;
	$query = "SELECT traffic.date as date, users.user as user, COUNT(DISTINCTROW(traffic.host_id)) as host, COUNT(DISTINCTROW(traffic.site_id)) as sites, SUM(traffic.traffic) as bytes
			FROM traffic
			INNER JOIN hosts
			ON hosts.id=traffic.host_id
			INNER JOIN users
			ON users.id=traffic.user_id
			where date = '$date'
			GROUP BY user
			ORDER BY bytes DESC";
	$result = $db->query($query);
	return $result;
}
//Returns site counts for day:
function date_sites($date){
	global $db;
	$query = "SELECT traffic.date as date, site.site as site, SUM(traffic.traffic) as bytes, COUNT(DISTINCTROW(traffic.user_id)) as users, COUNT(DISTINCTROW(traffic.host_id)) as hosts
			FROM traffic
			INNER JOIN site
			ON site.id=traffic.site_id
			where date = '$date'
			GROUP BY site
			ORDER BY bytes DESC";
	$result = $db->query($query);
	return $result;
}
//Return Top Hosts:
function top_host($date){
	global $db;
	$query = "SELECT traffic.date as date, COUNT(DISTINCTROW(traffic.user_id)) as user, hosts.hosts as host, COUNT(DISTINCTROW(traffic.site_id)) as sites, SUM(traffic.traffic) as bytes
	FROM traffic
	INNER JOIN hosts
	ON hosts.id=traffic.host_id
	where date LIKE '$date%'
	GROUP BY host
	ORDER BY bytes DESC
	LIMIT 10";
	$result = $db->query($query);
	return $result;
}
//Returns Top user:
function top_user($date){
	global $db;
	$query = "SELECT traffic.date as date, users.user as user, COUNT(DISTINCTROW(traffic.host_id)) as host, COUNT(DISTINCTROW(traffic.site_id)) as sites, SUM(traffic.traffic) as bytes
	FROM traffic
	INNER JOIN hosts
	ON hosts.id=traffic.host_id
	INNER JOIN users
	ON users.id=traffic.user_id
	where date LIKE '$date%'
	GROUP BY user
	ORDER BY bytes DESC
	LIMIT 10";
	$result = $db->query($query);
	return $result;
}
//Returns Top sites:
function top_sites($date){
	global $db;
	$query = "SELECT traffic.date as date, site.site as site, SUM(traffic.traffic) as bytes, COUNT(DISTINCTROW(traffic.user_id)) as users, COUNT(DISTINCTROW(traffic.host_id)) as hosts
	FROM traffic
	INNER JOIN site
	ON site.id=traffic.site_id
	where date LIKE '$date%'
	GROUP BY site
	ORDER BY bytes DESC
	LIMIT 10";
	$result = $db->query($query);
	return $result;
}


?>