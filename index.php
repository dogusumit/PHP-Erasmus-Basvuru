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

<body>
<div class="container" style="width: 100%">

<?php
ob_start();
include("ayar.php");

$result=mysqli_query($connection,"SELECT * FROM haberler ORDER BY tarih DESC");
if(@mysqli_num_rows($result) > 1)
{
	echo'
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">';
   echo '<li data-target="#myCarousel" data-slide-to="0" class="active"></li>';
  for($i=1;$i<=mysqli_num_rows($result);$i++)
  {
    echo '<li data-target="#myCarousel" data-slide-to="'.$i.'"></li>';
  }
  echo '</ol>';
  echo '
    <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
  ';
  $class="item active";
  while( $yaz=mysqli_fetch_assoc($result) )
  {
  	echo '<div class="'.$class.'">
      <img src="'.str_replace("..", ".", $yaz['resim']).'" alt="'.$yaz['baslik'].'">
    </div>';
     $class="item";
  }
echo '
  </div>

	  <!-- Left and right controls -->
	  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
	    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
	    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a>
	</div>
	';
}
?>

</div><!-- /container -->
</body>
</html>