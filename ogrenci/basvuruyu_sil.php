<?php
ob_start();
session_start();
include("../ayar.php");
if(isset($_SESSION['kullanici_id']))
	{
		$kullanici_id=$_SESSION['kullanici_id'];
		$kullanici_rol=$_SESSION['kullanici_rol'];
		$kullanici_ad=$_SESSION['kullanici_ad'];
	}
else
	yonlendir('../giris.php');
if (isset($_GET['id']))
{
	$sorgu_id=$_GET['id'];
	$sorgu = "DELETE FROM basvurular WHERE kullanici_id='$kullanici_id' AND basvuru_id='$sorgu_id';";
	$sil=mysqli_query($connection,$sorgu);
	if($sil)
		yonlendir('index.php');
	else
		echo 'MySql = '.mysqli_error($connection);
}
else
yonlendir('index.php');
?>