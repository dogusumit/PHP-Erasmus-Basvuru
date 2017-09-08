<?php
//durum=1:onay bekliyor,2:onaylandi ing sinava gir,3:yerlestirme bekliyor,4:yerleşti,5:yerleşemedi
ob_start();
session_start();
date_default_timezone_set('Europe/Istanbul');
include("../ayar.php");
if(isset($_SESSION['kullanici_id']))
	{
		$kullanici_id=$_SESSION['kullanici_id'];
		$kullanici_rol=$_SESSION['kullanici_rol'];
		$kullanici_ad=$_SESSION['kullanici_ad'];
	}
else
	yonlendir('../giris.php');
if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
	if(isset($_FILES['resim']))
	{
		$target_file = basename($_FILES["resim"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["resim"]["tmp_name"]);
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		if ($_FILES["resim"]["size"] > 50000000) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    echo "Sorry, only JPG, JPEG, PNG, GIF files are allowed.";
		    $uploadOk = 0;
		}
		if ($uploadOk == 0) {
		    echo("Sorry, your file was not uploaded.");
		}
		else {
		    if (move_uploaded_file($_FILES["resim"]["tmp_name"], $target_file)) {
		        echo "The file ". basename( $_FILES["resim"]["name"]). " has been uploaded.";
		    } else {
		        echo("Sorry, there was an error uploading your file.");
		    }
		}
		$originalImage = $target_file;
		$outputImage='../images/users/'.$kullanici_id.'.jpg';
		$exploded = explode('.',$originalImage);
	    $ext = $exploded[count($exploded) - 1]; 
	    if (preg_match('/jpg|jpeg/i',$ext))
	        $imageTmp=imagecreatefromjpeg($originalImage);
	    else if (preg_match('/png/i',$ext))
	        $imageTmp=imagecreatefrompng($originalImage);
	    else if (preg_match('/gif/i',$ext))
	        $imageTmp=imagecreatefromgif($originalImage);
	    else if (preg_match('/bmp/i',$ext))
	        $imageTmp=imagecreatefrombmp($originalImage);
	    imagejpeg($imageTmp, $outputImage, 70);
	    imagedestroy($imageTmp);
	    unlink($originalImage);
	}

	$indisler=array('ogrno','fakulte','bolumu','duzey','gno','ogrenimyili','orgun','dogum','adresi','telefon','eposta','oncekierasmus','universite','universite2','program','chk7','chk8','chk9','chk10','chk11','chk12','chk13','chk14','chk15','chk16','chk17','chk18','ekmasraf');

	$sorgu = 'INSERT INTO basvurular (kullanici_id,kullanici_ad,durum,yerlestigi_uni,ingilizce_puani,erasmus_puani,basvuru_tarihi';
	foreach ($indisler as $indis) 
	{
		$sorgu .= ",$indis";
	}
	$sorgu .= ") VALUES ('$kullanici_id','$kullanici_ad','1','null','null','null','".date("H:i:s - d.m.Y")."'";

	foreach ($indisler as $indis) 
	{
		$a=@$_POST[$indis] or 'null';
		$sorgu .= ",'$a'";
	}
	$sorgu .= ");";
	$ekle=mysqli_query($connection,$sorgu);
	if($ekle)
		yonlendir('index.php');
	else
		echo 'MySql = '.mysqli_error($connection);
}
?>