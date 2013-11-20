<?php
require 'inc/functions.php';
$link = explode('-',$_GET['date']);
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="inc/main.css">
<title>Ninja Squid</title>
</head>

<body>
<?php 

if ($_GET['report'] == 'day_full'){
	$date = $_GET['date'];
	$full = date_full($date);
	$totalbytes = total_traffic($date);
	$totaltraffic = convertBytes($totalbytes['bytes']);	
	?>
<div id="traffic">
<table width=100% style='left:100pt'>
 <tr>
  <td width=713 height=35 valign=Top colspan=5 class="head">
  <p><span class="head">Traffic Usage Full Report - <?php echo $date ?></span></p>
  <p><a href='index.php?year=<?php echo $link[0]?>&month=<?php echo $link[1]?>'>Home</a></p>
  </td>
 </tr>
 <tr>
  <td width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Date</span></p>
  </td>
  <td width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Time</span></p>
  </td>
  <td width=142 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>User</span></p>
  </td>
  <td width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Host</span></p>
  </td>
  <td width=143 height=35 valign=Top bgcolor="#B2E489" sstyle='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Result</span></p>
  </td>
    <td width=143 height=35 valign=Top bgcolor="#B2E489" sstyle='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>URL</span></p>
  </td>
  <td width=142 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Traffic</span></p>
  </td>
 </tr>
 <?php while ($row = mysqli_fetch_array($full)){?>
 <tr>
  <td width=143 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $row['date'] ?></a></span></p>
  </td>
  <td width=143 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $row['time'] ?></a></span></p>
  </td>
  <td width=142 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $row['user'] ?></span></p>
  </td>
  <td width=143 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $row['host'] ?></span></p>
  </td>
  <td width=143 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $row['result'] ?></span></p>
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
  <td width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Total Traffic</span></p>
  </td>
  <td width=570 height=35 valign=Top colspan=6 style='border:solid #B2E489 1.0pt'>
  <p style='text-align:right'><span><?php echo $totaltraffic; ?></span></p>
  </td>
 </tr>
</table>
</div>
<?php 
}
if ($_GET['report'] == 'day_host'){
	$date = $_GET['date'];
	$host = date_host($date);
	$totalbytes = total_traffic($date);
	$totaltraffic = convertBytes($totalbytes['bytes']);
	$r = 1;
	?>
<div id="traffic">
<table>
 <tr>
  <td width=713 height=35 valign=Top colspan=5 class="head">
  <p><span class="head">Traffic Usage Per Host Report - <?php echo $date ?></span></p>
  <p><a href='index.php?year=<?php echo $link[0]?>&month=<?php echo $link[1]?>'>Home</a></p>
  </td>
 </tr>
 <tr>
  <td width=35 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>#</span></p>
  </td>
  <td width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Date</span></p>
  </td>
  <td width=142 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Sites</span></p>
  </td>
  <td width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Users</span></p>
  </td>
  <td width=143 height=35 valign=Top bgcolor="#B2E489" sstyle='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Host</span></p>
  </td>
  <td width=142 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Traffic</span></p>
  </td>
 </tr>
 <?php while ($row = mysqli_fetch_array($host)){?>
 <tr>
  <td width=35 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $r++ ?></a></span></p>
  </td> 
  <td width=143 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span>
  <?php echo $row['date'] ?></a></span></p>
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
  <td width=570 height=35 valign=Top colspan=4 style='border:solid #B2E489 1.0pt'>
  <p style='text-align:right'><span><?php echo $totaltraffic; ?></span></p>
  </td>
 </tr>
</table>
</div>
<?php 
}
if ($_GET['report'] == 'day_user'){
	$date = $_GET['date'];
	$user = date_user($date);
	$totalbytes = total_traffic($date);
	$totaltraffic = convertBytes($totalbytes['bytes']);
	$r = 1;	?>
<div id="traffic">
<table>
 <tr>
  <td width=713 height=35 valign=Top colspan=5 class="head">
  <p><span class="head">Traffic Usage Per User Report - <?php echo $date ?></span></p>
  <p><a href='index.php?year=<?php echo $link[0]?>&month=<?php echo $link[1]?>'>Home</a></p>
  </td>
 </tr>
 <tr>
  <td width=35 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>#</span></p>
  </td>
  <td width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Date</span></p>
  </td>
  <td width=142 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Sites</span></p>
  </td>
  <td width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Hosts</span></p>
  </td>
  <td width=143 height=35 valign=Top bgcolor="#B2E489" sstyle='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>User</span></p>
  </td>
  <td width=142 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Traffic</span></p>
  </td>
 </tr>
 <?php while ($row = mysqli_fetch_array($user)){?>
 <tr>
  <td width=35 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $r++ ?></a></span></p>
  </td> 
  <td width=143 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span>
  <?php echo $row['date'] ?></a></span></p>
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
  <td width=570 height=35 valign=Top colspan=4 style='border:solid #B2E489 1.0pt'>
  <p style='text-align:right'><span><?php echo $totaltraffic; ?></span></p>
  </td>
 </tr>
</table>
</div>
<?php 
}
if ($_GET['report'] == 'day_site'){
	$date = $_GET['date'];
	$site = date_sites($date);
	$totalbytes = total_traffic($date);
	$totaltraffic = convertBytes($totalbytes['bytes']);
	$r = 1;	?>
<div id="traffic">
<table>
 <tr>
  <td width=713 height=35 valign=Top colspan=5 class="head">
  <p><span class="head">Traffic Usage Per Site Report - <?php echo $date ?></span></p>
  <p><a href='index.php?year=<?php echo $link[0]?>&month=<?php echo $link[1]?>'>Home</a></p>
  </td>
 </tr>
 <tr>
  <td width=35 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>#</span></p>
  </td>
  <td width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Date</span></p>
  </td>
  <td width=142 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Users</span></p>
  </td>
  <td width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Hosts</span></p>
  </td>
  <td width=143 height=35 valign=Top bgcolor="#B2E489" sstyle='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Site</span></p>
  </td>
  <td width=142 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Traffic</span></p>
  </td>
 </tr>
 <?php while ($row = mysqli_fetch_array($site)){?>
 <tr>
  <td width=35 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $r++ ?></a></span></p>
  </td> 
  <td width=143 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span>  <?php echo $row['date'] ?></a></span></p>
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
  <td width=570 height=35 valign=Top colspan=4 style='border:solid #B2E489 1.0pt'>
  <p style='text-align:right'><span><?php echo $totaltraffic; ?></span></p>
  </td>
 </tr>
</table>
</div>
<?php 
}
if ($_GET['report'] == 'block'){
	$date = $_GET['date'];
	$totalblock = total_block($date);
	$block = block($date);
	?>
<div id="traffic">
<table>
 <tr>
  <td width=713 height=35 valign=Top colspan=5 class="head">
  <p><span class="head">Blocked Sites Report - <?php echo $date ?></span></p>
  <p><a href='index.php?year=<?php echo $link[0]?>&month=<?php echo $link[1]?>'>Home</a></p>
  </td>
 </tr>
 <tr>
  <td width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Date</span></p>
  </td>
  <td width=142 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Time</span></p>
  </td>
  <td width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Category</span></p>
  </td>
  <td width=143 height=35 valign=Top bgcolor="#B2E489" sstyle='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Site</span></p>
  </td>
  <td width=142 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Host</span></p>
  </td>
 </tr>
 <?php while ($row = mysqli_fetch_array($block)){?>
 <tr>
  <td width=143 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $row['date'] ?></a></span></p>
  </td>
  <td width=142 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $row['time'] ?></span></p>
  </td>
  <td width=143 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $row['category'] ?></span></p>
  </td>
  <td width=143 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $row['site'] ?></span></p>
  </td>
  <td width=142 height=35 valign=Top style='border:solid #B2E489 1.0pt'>
  <p><span><?php echo $row['host'] ?></span></p>
  </td>
 </tr>
 <?php } ?>
 <tr>
  <td width=143 height=35 valign=Top bgcolor="#B2E489" style='border-bottom:solid #B2E489 1.0pt'>
  <p><span style='text-decoration:underline'>Total Blocks</span></p>
  </td>
  <td width=570 height=35 valign=Top colspan=4 style='border:solid #B2E489 1.0pt'>
  <p style='text-align:right'><span><?php echo $totalblock ?></span></p>
  </td>
 </tr>
</table>
</div>
<?php 
}
?>
</body>

</html>





