<?php
require 'inc/functions.php';

?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="inc/main.css">
<title>Ninja Squid</title>
</head>

<body>
<?php
if ($_GET['report'] == 'top_year_host'){
	$date = $_GET['year'];
	$query = top_host($date);
	$totalbytes = total_traffic($date);
	$totaltraffic = convertBytes($totalbytes['bytes']);
	$r = 1;
	?>
<div id="traffic">
<table>
 <tr>
  <td width=713 height=35 valign=Top colspan=5 class="head">
  <p><span class="head">Top 10 Host Report - <?php echo $date ?></span></p>
  <p><a href='index.php?year=<?php echo $_GET['year']?>&month=<?php echo $_GET['month']?>'>Home</a></p>
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
 <tr>
  <td colspan=2 width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Total Traffic</span></p>
  </td>
  <td width=570 height=35 valign=Top colspan=3 style='border:solid #B2E489 1.0pt'>
  <p style='text-align:right'><span><?php echo $totaltraffic; ?></span></p>
  </td>
 </tr>
</table>
</div>
<?php 
}
if ($_GET['report'] == 'top_year_user'){
	$date = $_GET['year'];
	$query = top_user($date);
	$totalbytes = total_traffic($date);
	$totaltraffic = convertBytes($totalbytes['bytes']);
	$r = 1;
	?>
<div id="traffic">
<table>
 <tr>
  <td width=713 height=35 valign=Top colspan=5 class="head">
  <p><span class="head">Top 10 Users Report - <?php echo $date ?></span></p>
  <p><a href='index.php?year=<?php echo $_GET['year']?>&month=<?php echo $_GET['month']?>'>Home</a></p>
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
 <tr>
  <td colspan=2 width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Total Traffic</span></p>
  </td>
  <td width=570 height=35 valign=Top colspan=3 style='border:solid #B2E489 1.0pt'>
  <p style='text-align:right'><span><?php echo $totaltraffic; ?></span></p>
  </td>
 </tr>
</table>
</div>
<?php 
}
if ($_GET['report'] == 'top_year_site'){
	$date = $_GET['year'];
	$query = top_sites($date);
	$totalbytes = total_traffic($date);
	$totaltraffic = convertBytes($totalbytes['bytes']);
	$r = 1;
	?>
<div id="traffic">
<table>
 <tr>
  <td width=713 height=35 valign=Top colspan=5 class="head">
  <p><span class="head">Top 10 Sites Report - <?php echo $date ?></span></p>
  <p><a href='index.php?year=<?php echo $_GET['year']?>&month=<?php echo $_GET['month']?>'>Home</a></p>
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
  <td width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Site</span></p>
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
 <tr>
  <td colspan=2 width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Total Traffic</span></p>
  </td>
  <td width=570 height=35 valign=Top colspan=3 style='border:solid #B2E489 1.0pt'>
  <p style='text-align:right'><span><?php echo $totaltraffic; ?></span></p>
  </td>
 </tr>
</table>
</div>
<?php 
}
if ($_GET['report'] == 'top_month_host'){
	$date = $_GET['year']."-".$_GET['month'];
	$query = top_host($date);
	$totalbytes = total_traffic($date);
	$totaltraffic = convertBytes($totalbytes['bytes']);
	$r = 1;
	?>
<div id="traffic">
<table>
 <tr>
  <td width=713 height=35 valign=Top colspan=5 class="head">
  <p><span class="head">Top 10 Host Report - <?php echo $date ?></span></p>
  <p><a href='index.php?year=<?php echo $_GET['year']?>&month=<?php echo $_GET['month']?>'>Home</a></p>
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
 <tr>
  <td colspan=2 width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Total Traffic</span></p>
  </td>
  <td width=570 height=35 valign=Top colspan=3 style='border:solid #B2E489 1.0pt'>
  <p style='text-align:right'><span><?php echo $totaltraffic; ?></span></p>
  </td>
 </tr>
</table>
</div>
<?php 
}
if ($_GET['report'] == 'top_month_user'){
	$date = $_GET['year']."-".$_GET['month'];
	$query = top_user($date);
	$totalbytes = total_traffic($date);
	$totaltraffic = convertBytes($totalbytes['bytes']);
	$r = 1;
	?>
<div id="traffic">
<table>
 <tr>
  <td width=713 height=35 valign=Top colspan=5 class="head">
  <p><span class="head">Top 10 Users Report - <?php echo $date ?></span></p>
  <p><a href='index.php?year=<?php echo $_GET['year']?>&month=<?php echo $_GET['month']?>'>Home</a></p>
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
 <tr>
  <td colspan=2 width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Total Traffic</span></p>
  </td>
  <td width=570 height=35 valign=Top colspan=3 style='border:solid #B2E489 1.0pt'>
  <p style='text-align:right'><span><?php echo $totaltraffic; ?></span></p>
  </td>
 </tr>
</table>
</div>
<?php 
}
if ($_GET['report'] == 'top_month_site'){
	$date = $_GET['year']."-".$_GET['month'];
	$query = top_sites($date);
	$totalbytes = total_traffic($date);
	$totaltraffic = convertBytes($totalbytes['bytes']);
	$r = 1;
	?>
<div id="traffic">
<table>
 <tr>
  <td width=713 height=35 valign=Top colspan=5 class="head">
  <p><span class="head">Top 10 Sites Report - <?php echo $date ?></span></p>
  <p><a href='index.php?year=<?php echo $_GET['year']?>&month=<?php echo $_GET['month']?>'>Home</a></p>
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
  <td width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Site</span></p>
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
 <tr>
  <td colspan=2 width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Total Traffic</span></p>
  </td>
  <td width=570 height=35 valign=Top colspan=3 style='border:solid #B2E489 1.0pt'>
  <p style='text-align:right'><span><?php echo $totaltraffic; ?></span></p>
  </td>
 </tr>
</table>
</div>
<?php 
}
?>
</body>

</html>



