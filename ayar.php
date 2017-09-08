<?php
$connection = mysqli_connect("localhost", "user", "pass") or die(mysql_error());
$db_select = mysqli_select_db($connection,"erasmus2") or die (mysql_error());

mysqli_set_charset($connection,"utf8");

function yonlendir($url){ 
if (!headers_sent()){ 
header('Location: '.$url); exit; 
}else{ 
echo '<script type="text/javascript">'; 
echo 'window.location.href="'.$url.'";'; 
echo '</script>'; 
echo '<noscript>'; 
echo '<meta http-equiv="refresh" content="0;url='.$url.'" />'; 
echo '</noscript>'; exit; 
} 
} 
?>
