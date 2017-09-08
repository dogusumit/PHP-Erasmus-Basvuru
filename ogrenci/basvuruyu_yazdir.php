<?php
ob_start();
session_start();
include("../ayar.php");
if(isset($_SESSION['kullanici_id']))
	{
		$kullanici_id=$_SESSION['kullanici_id'];
		$kullanici_rol=$_SESSION['kullanici_rol'];
		$kullanici_ad=$_SESSION['kullanici_ad'];
		if(strcmp($kullanici_rol,'admin')==0)
			yonlendir('../admin/index.php');
	}
else
	yonlendir('../giris.php');

?>
<!DOCTYPE HTML>

<html lang="tr">

<head>

	<meta charset="UTF-8">

	<link rel="stylesheet" href="../css/a4.css" />

	<link rel="stylesheet" href="../css/bootstrap.css" />

	<link rel="stylesheet" href="../css/bootstrap-theme.css" />

	<script type="text/javascript" src="../js/jquery-1.11.1.js"></script>

	<script type="text/javascript" src="../js/bootstrap.js"></script>

	<script type="text/javascript" src="../js/jquery.min.js"></script>
	
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>

	<title>Erasmus Başvuru Sistemi</title>

</head>
<body onload="window.print();window.history.back();">
<?php
if (isset($_GET['id']))
{
	$sorgu_id=$_GET['id'];
	$sorgu="SELECT * FROM basvurular WHERE kullanici_id='$kullanici_id' AND basvuru_id='$sorgu_id'";
	$result=mysqli_query($connection,$sorgu);
	if(mysqli_num_rows($result)>0)
	{
		$_POST=mysqli_fetch_array($result);
		include ('basvuru_formu.php');
	}
}
else
yonlendir('index.php');
?>