<?php
ob_start();
session_start();
include("ayar.php");
if(isset($_SESSION['kullanici_id']))
	{
		if(strcmp($_SESSION['kullanici_rol'],'admin')==0)
			yonlendir('admin/index.php');
		else if(strcmp($_SESSION['kullanici_rol'],'user')==0)
			yonlendir('ogrenci/index.php');
	}
?>
<!DOCTYPE HTML>

<html lang="tr">

<head>

	<meta charset="UTF-8">

	<link rel="stylesheet" href="css/bootstrap.css" />

	<link rel="stylesheet" href="css/bootstrap-theme.css" />

	<link rel="stylesheet" href="css/login.css" />

	<script type="text/javascript" src="js/jquery-1.11.1.js"></script>

	<script type="text/javascript" src="js/bootstrap.js"></script>

	<title>Erasmus Başvuru Sistemi</title>

</head>