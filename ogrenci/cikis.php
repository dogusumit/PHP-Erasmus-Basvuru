<?php
ob_start();
session_start();
include("../ayar.php");
unset($_SESSION['kullanici_id']);
unset($_SESSION['kullanici_rol']);
unset($_SESSION['kullanici_ad']);
session_destroy();
yonlendir('../giris.php');
?>