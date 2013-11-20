<?php
require ("inc/functions.php");

//Let's generate some variable:

if (isset($_GET['year']) && isset($_GET['month'])){
	if ($_GET['year'] !=''){
		$month = $_GET['year']."-".$_GET['month'];
	}
	if ($_GET['month'] != ''){
		$month = $_GET['year']."-".$_GET['month'];
	}
}
else {
	$_GET['year'] = date('Y');
	$_GET['month'] = date('m');
	$month = date('Y-m');
}

$month2 = "2013-05";
$totalbytes = total_traffic($month);
$daycount = count_traffic_month($month);
$totaltraffic = convertBytes($totalbytes['bytes']);
$block_count = count_block_month($month2);
$totalblocks = total_block($month2);

//Let's Generate the HTML part:
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="inc/main.css">
<title>Ninja Squid</title>
</head>

<body>
<div id="header">
<table>
 <tr>
  <td>
  <p><span>Ninja Squid Access / Block Reports</span></p>
 </td>
 </tr>
</table>
</div>
<div id="button">
<a href="month_report.php?year=<?php echo $_GET['year']?>&month=<?php echo $_GET['month']?>"><img width=161 height=42 src="inc/image347.png" alt="Rounded Rectangle: Monthly Report&#13;" v:shapes="_x0000_s1113"></a>
</div>
<div id="top10">
<table>
 <tr>
  <td class="head" width=288 height=32 valign=Top colspan=3>
  <p><span class="head">Top 10 Reports</span></p>
  </td>
 </tr>
 <tr>
  <td width=96 height=35 valign=Top class="head2">
  <p><span class="head2">Host</span></p>
  </td>
  <td width=96 height=35 valign=Top class="head2">
  <p><span class="head2">Users</span></p>
  </td>
  <td width=96 height=35 valign=Top class="head2">
  <p><span class="head2">Sites</span></p>
  </td>
 </tr>
 <tr>
  <td width=96 height=35 valign=Top bgcolor="#B2E489">
  <p><span><a href="top_reports.php?year=<?php echo $_GET['year']?>&month=<?php echo $_GET['month']?>&report=top_year_host" title="Top 10 Hosts for the Year">Top 10 Year</a></span></p>
  </td>
  <td width=96 height=35 valign=Top bgcolor="#B2E489">
  <p><span><a href="top_reports.php?year=<?php echo $_GET['year']?>&month=<?php echo $_GET['month']?>&report=top_year_user" title="Top 10 Users for the Year">Top 10 Year</span></p>
  </td>
  <td width=96 height=35 valign=Top bgcolor="#B2E489">
  <p><span><a href="top_reports.php?year=<?php echo $_GET['year']?>&month=<?php echo $_GET['month']?>&report=top_year_site" title="Top 10 Sites for the Year">Top 10 Year</a></span></p>
  </td>
 </tr>
 <tr>
  <td width=96 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><a href="top_reports.php?year=<?php echo $_GET['year']?>&month=<?php echo $_GET['month']?>&report=top_month_host" title="Top 10 Hosts for the Month">Top 10 Month</a></span></p>
  </td>
  <td width=96 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><a href="top_reports.php?year=<?php echo $_GET['year']?>&month=<?php echo $_GET['month']?>&report=top_month_user" title="Top 10 Users for the Month">Top 10 Month</a></span></p>
  </td>
  <td width=96 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><a href="top_reports.php?year=<?php echo $_GET['year']?>&month=<?php echo $_GET['month']?>&report=top_month_site" title="Top 10 Sites for the Month">Top 10 Month</a></span></p>
  </td>
 </tr>
</table>
</div>
<div id="calendar">
<table>
 <tr>
  <td width=288 height=35 valign=Top>
  <p><span>Calendar</span></p>
  </td>
 </tr>
 <tr>
  <td width=288 height=35 valign=Top bgcolor="#B2E489" style='border:solid #B2E489 1.0pt'>
  <p><span><?php get_year() ?></span></p>
  </td>
 </tr>
 <tr>
  <td width=288 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php get_month() ?></span></p>
  </td>
 </tr>
</table>
</div>

<div id="traffic">
<table >
 <tr>
  <td width=713 height=35 valign=Top colspan=5 class="head">
  <p><span class="head">Traffic Usage</span></p>
  </td>
 </tr>
 <tr>
  <td width=143 height=34 valign=Top bgcolor="#B2E489" style='border:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Date</span></p>
  </td>
  <td width=142 height=34 valign=Top bgcolor="#B2E489" style='border:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Hosts</span></p>
  </td>
  <td width=143 height=34 valign=Top bgcolor="#B2E489" style='border:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Users</span></p>
  </td>
  <td width=143 height=34 valign=Top bgcolor="#B2E489" style='border:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Sites</span></p>
  </td>
  <td width=142 height=34 valign=Top bgcolor="#B2E489" style='border:solid #B2E489 1.0pt'>
  <p><span  style='text-decoration:underline'>Traffic</span></p>
  </td>
 </tr>
 <?php while ($row = mysqli_fetch_array($daycount)){?>
 <tr>
  <td width=143 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><a href="detail.php?date=<?php echo $row['date'] ?>&report=day_full" title="CAUTION: this will display full report for the day and can be huge!"><?php echo $row['date'] ?></a></span></p>
  </td>
  <td width=142 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><a href="detail.php?date=<?php echo $row['date'] ?>&report=day_host" title="Display Day Report on Usage by Host"><?php echo $row['hostID'] ?></a></span></p>
  </td>
  <td width=143 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><a href="detail.php?date=<?php echo $row['date'] ?>&report=day_user" title="Display Day Report on Usage by User"><?php echo $row['userID'] ?></a></span></p>
  </td>
  <td width=143 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><a href="detail.php?date=<?php echo $row['date'] ?>&report=day_site" title="Display Day Report on Usage by Site"><?php echo $row['siteID'] ?></a></span></p>
  </td>
  <td width=142 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo convertBytes($row['bytes']) ?></span></p>
  </td>
 </tr>
 <?php } ?>
 <tr>
  <td width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Total Traffic:</span></p>
  </td>
  <td width=570 height=35 valign=Top colspan=4 style='border:solid #B2E489 1.0pt'>
  <p style='text-align:right'><span><?php echo $totaltraffic ?></span></p>
  </td>
 </tr>
</table>


<table >
 <tr>
  <td width=713 height=35 valign=Top colspan=5 class="head">
  <p><span class="head">Blocked Sites</span></p>
  </td>
 </tr>
 <tr>
  <td width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Date</span></p>
  </td>
  <td width=142 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Hosts</span></p>
  </td>
  <td width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Categories</span></p>
  </td>
  <td width=143 height=35 valign=Top bgcolor="#B2E489" sstyle='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Sites</span></p>
  </td>
  <td width=142 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Blocks</span></p>
  </td>
 </tr>
 <?php while ($row = mysqli_fetch_array($block_count)){?>
 <tr>
  <td width=143 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><a href="detail.php?date=<?php echo $row['date'] ?>&report=block" title="Display Detailed Block Report for the day"><?php echo $row['date'] ?></a></span></p>
  </td>
  <td width=142 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $row['hostID'] ?></span></p>
  </td>
  <td width=143 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $row['categoryID'] ?></span></p>
  </td>
  <td width=143 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $row['siteID'] ?></span></p>
  </td>
  <td width=142 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $row['blocks'] ?></span></p>
  </td>
 </tr>
 <?php } ?>
 <tr>
  <td width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Total Blocks</span></p>
  </td>
  <td width=570 height=35 valign=Top colspan=4 style='border:solid #B2E489 1.0pt'>
  <p style='text-align:right'><span><?php echo $totalblocks ?></span></p>
  </td>
 </tr>
</table>
</div>


</body>

</html>
