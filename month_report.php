<?php
require 'inc/functions.php';

$year = $_GET['year'];
$month = $_GET['month'];
$date = $year."-".$month;

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
  <p><span>Monthly Usage/Block Report - <?php echo $date ?></span></p>
 </td>
 </tr>
</table>
</div>

<p><span style='font-size:12.0pt;font-family:"Times New Roman";font-weight:bold;position:absolute;top:53pt;left:173pt'>Traffic usage</span></p>
<p><span style='position:absolute;top:67pt;left:35pt;'><img src="graph.php?date=<?php echo $date ?>&graph=traffic" /></span>

<p><span style='font-size:12.0pt;font-family:"Times New Roman";font-weight:bold;position:absolute;top:53pt;left:667px'>Blocked Sites</span></p>
<span style='position:absolute;top:65pt;left:567px'><img src="graph.php?date=<?php echo $date ?>&graph=block" /></span>

<div id="traffic">
<table style='top:250pt;left:10pt'>
<td>
<?php 

	$query = top_host($date);
	$totalbytes = total_traffic($date);
	$totaltraffic = convertBytes($totalbytes['bytes']);
	$r = 1;
	?>
	
<table style='postition:absolute;width:360.0pt;left:42.95pt'>
 <tr>
  <td width=713 height=35 valign=Top colspan=5 class="head">
  <p><span class="head">Top 10 Host</span></p>
  </td>
 </tr>
 <tr>
  <td width=35 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>#</span></p>
  </td>
  <td width=142 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Sites</span></p>
  </td>
  <td width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Users</span></p>
  </td>
  <td width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Host</span></p>
  </td>
  <td width=142 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Traffic</span></p>
  </td>
 </tr>
 <?php while ($row = mysqli_fetch_array($query)){?>
 <tr>
  <td width=35 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $r++ ?></span></p>
  </td> 
  <td width=142 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $row['sites'] ?></span></p>
  </td>
  <td width=143 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $row['user'] ?></span></p>
  </td>
  <td width=143 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $row['host'] ?></span></p>
  </td>
  <td width=142 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo convertBytes($row['bytes']) ?></span></p>
  </td>
 </tr>
 <?php } ?>
</table>

<?php 
	$query = top_user($date);
	$totalbytes = total_traffic($date);
	$totaltraffic = convertBytes($totalbytes['bytes']);
	$r = 1;
	?>

<table style='width:460.0pt;left:237.73pt'>
 <tr>
  <td width=713 height=35 valign=Top colspan=5 class="head">
  <p><span class="head">Top 10 Users</span></p>
  </td>
 </tr>
 <tr>
  <td width=35 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>#</span></p>
  </td>
  <td width=142 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Sites</span></p>
  </td>
  <td width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Hosts</span></p>
  </td>
  <td width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>User</span></p>
  </td>
  <td width=142 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Traffic</span></p>
  </td>
 </tr>
 <?php while ($row = mysqli_fetch_array($query)){?>
 <tr>
  <td width=35 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $r++ ?></span></p>
  </td> 
  <td width=142 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $row['sites'] ?></span></p>
  </td>
  <td width=143 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $row['host'] ?></span></p>
  </td>
  <td width=143 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $row['user'] ?></span></p>
  </td>
  <td width=142 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo convertBytes($row['bytes']) ?></span></p>
  </td>
 </tr>
 <?php } ?>
</table>

<?php 
	$query = top_sites($date);
	$totalbytes = total_traffic($date);
	$totaltraffic = convertBytes($totalbytes['bytes']);
	$r = 1;
	?>
<table style='width:460.0pt;position:absolute;top:1pt;left:428.62pt'>
 <tr>
  <td width=713 height=35 valign=Top colspan=5 class="head">
  <p><span class="head">Top 10 Sites</span></p>
  </td>
 </tr>
 <tr>
  <td width=35 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>#</span></p>
  </td>
  <td width=142 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Users</span></p>
  </td>
  <td width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Hosts</span></p>
  </td>
  <td width=643 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Site</span></p>
  </td>
  <td width=242 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Traffic</span></p>
  </td>
 </tr>
 <?php while ($row = mysqli_fetch_array($query)){?>
 <tr>
  <td width=35 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $r++ ?></span></p>
  </td> 
  <td width=142 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $row['users'] ?></span></p>
  </td>
  <td width=143 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $row['hosts'] ?></span></p>
  </td>
  <td width=143 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $row['site'] ?></span></p>
  </td>
  <td width=142 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo convertBytes($row['bytes']) ?></span></p>
  </td>
 </tr>
 <?php } ?>
</table>

<?php 

$totalbytes = total_traffic($date);
$daycount = count_traffic_month($date);
$totaltraffic = convertBytes($totalbytes['bytes']);
$block_count = count_block_month($date);
$totalblocks = total_block($date);
?>

<table style='left:42.95pt;position:relative'>
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
  <p><span><?php echo $row['date'] ?></span></p>
  </td>
  <td width=142 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $row['hostID'] ?></span></p>
  </td>
  <td width=143 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $row['userID'] ?></span></p>
  </td>
  <td width=143 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $row['siteID'] ?></span></p>
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

<table  style='left:42.95pt'>
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
  <td width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Sites</span></p>
  </td>
  <td width=142 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Blocks</span></p>
  </td>
 </tr>
 <?php while ($row = mysqli_fetch_array($block_count)){?>
 <tr>
  <td width=143 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $row['date'] ?></span></p>
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
<p><a href='index.php?year=<?php echo $_GET['year']?>&month=<?php echo $_GET['month']?>'>Home</a></p>
</td>
</table>
</div>
</body>

</html>