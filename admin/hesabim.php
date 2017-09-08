<?php
include 'head.php';
if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
	$tc_no=$_POST["tc_no"];
	$isim=$_POST["adim"];
	$email=$_POST["email"];
	$tel=$_POST["tel"];
	$sorgu = "UPDATE kullanici SET kullanici_tc='$tc_no',kullanici_adi_soyadi='$isim',kullanici_email='$email',kullanici_tel='$tel' WHERE kullanici_id='$kullanici_id';";
	$guncelle=mysqli_query($connection,$sorgu);
	if(mysqli_affected_rows($connection)>0)
	{
		echo '<div class="row">
			<div class="col-xs-12 text-center">
				<div class="alert alert-success">
					<strong>Bilgileriniz Başarıyla Güncellendi</strong>
				</div>
			</div>
			</div>';
	}
}
if(!empty($_FILES['resim']['tmp_name']))
{
	$target_file = basename($_FILES["resim"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["resim"]["tmp_name"]);
	    if($check !== false) {
	        $uploadOk = 1;
	    } else {
	        $uploadOk = 0;
	    }
	}
	if ($_FILES["resim"]["size"] > 50000000) {
	    $uploadOk = 0;
	}
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    $uploadOk = 0;
	}
	if ($uploadOk == 0) {
	}
	else {
	    if (move_uploaded_file($_FILES["resim"]["tmp_name"], $target_file)) {

	    } else {
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

$result=mysqli_query($connection,"SELECT * FROM kullanici WHERE kullanici_id='$kullanici_id'");
$yaz=mysqli_fetch_array($result);
$tc_no=$yaz["kullanici_tc"];
$isim=$yaz["kullanici_adi_soyadi"];
$email=$yaz["kullanici_email"];
$tel=$yaz["kullanici_tel"];
?>
	<div class="card card-container">
		<img id="profile-img" class="profile-img-card" 
		src="../images/users/<?php echo $kullanici_id.'.jpg'; ?>" />
		<script type="text/javascript">
		</script>
			<form method="POST" class="form-signin" enctype="multipart/form-data">
			<label for="file_input" id="file_label" class="btn form-control">Resim Seç</label>
			<input type="file" name="resim" accept="image/*" id="file_input" style="visibility:hidden;">
			<input type="number" name="tc_no" class="form-control" placeholder="TC Kimlik Numarası" required autofocus maxlength="11" value="<?php echo $tc_no; ?>">
			<input type="text" name="adim" class="form-control" placeholder="Ad Soyad" required value="<?php echo $isim; ?>">
			<input type="email" name="email" class="form-control" placeholder="E-Posta Adresi" required value="<?php echo $email; ?>">
			<input type="number" name="tel" class="form-control" placeholder="Telefon Numarası" required value="<?php echo $tel; ?>">
			<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Kaydet</button>
		</form>
	</div><!-- /card-container -->
</div><!-- /container -->
</body>
<script type="text/javascript">
$('#file_input').on("change", function(){ changeLabel(); });
function changeLabel()
{
	var filename = $('#file_input').val();
        if (filename.substring(3,11) == 'fakepath') {
            filename = filename.substring(12);
        }
	$('#file_label').text(filename);
}
</script>
</html>