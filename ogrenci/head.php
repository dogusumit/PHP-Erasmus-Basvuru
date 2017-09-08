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

	<link rel="stylesheet" href="../css/login.css" />

	<link rel="stylesheet" href="../css/bootstrap.css" />

	<link rel="stylesheet" href="../css/bootstrap-theme.css" />

	<script type="text/javascript" src="js/jquery-1.11.1.js"></script>

	<script type="text/javascript" src="js/bootstrap.js"></script>

	<script type="text/javascript" src="../js/jquery.min.js"></script>
	
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>

	<title>Erasmus Başvuru Sistemi</title>

</head>
<body>
<div class="container" style="width: 100%"> 
	<nav class="navbar navbar-default navbar-static-top" role="navigation">
		<a class="navbar-brand" href="../index.php"><span class="glyphicon glyphicon-home"></span></a>
		<div class="navbar-collapse collapse" id="menu-3">
			<ul class="nav navbar-nav">
				<li><a href="index.php">Başvurularım</a></li>
				<li><a href="basvuru_yap.php">Başvuru Yap</a></li>
				<li><a href="hesabim.php">Hesabım</a></li>
				<li><a href="parolam.php">Parolam</a></li>
				<li><a href="cikis.php">Çıkış</a></li>
			</ul>
		</div>
	</nav>