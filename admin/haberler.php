<?php
include 'head.php';
?>
<script type="text/javascript">
function showSnackbar() 
{
    var x = document.getElementById("snackbar");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
function changeLabel()
{
	var filename = $('#resim_input').val();
        if (filename.substring(3,11) == 'fakepath') {
            filename = filename.substring(12);
        }
	$('#resim').text(filename);
}
</script>
<div id="snackbar"><span>Haber Kaydedildi<span></div>
<div id="ekle_form">
<form method="POST" class="form-signin"  enctype="multipart/form-data">
	<input type="hidden" name="sorgu" id="sorgu" value="insert">
	<input type="hidden" name="haber_no" id="haber_no" value="0">
	<div class="row">
		<div class="col-xs-2 col-xs-offset-5">
			<input type="text" name="baslik" id="baslik" class="form-control" placeholder="Haber Başlığı" required autofocus>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-8 col-xs-offset-2">
			<textarea style="height:3cm;" name="icerik" id="icerik" placeholder="Haber İçeriği" class="form-control" required></textarea>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-2 col-xs-offset-4">
			<label for="resim_input" id="resim" class="btn btn-primary form-control">Resim Seç</label>
			<input type="file" name="resim" accept="image/*" id="resim_input" style="visibility:hidden;" onchange="changeLabel()" required>
		</div>
		<div class="col-xs-2">
			<button class="btn btn-primary form-control" id="buton1" type="submit">Haberi Yayınla</button>
		</div>
		<div class="col-xs-2">
			<a id="sil_href" href=""><span id="sil_buton" class="btn btn-primary" style="display: none;">Sil</span></a>
		</div>
	</div>		
</form>
</div>
<?php
if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
	if(!empty($_FILES['resim']['tmp_name']))
	{
		$target_dir = "../images/haberler/";
		$target_file = $target_dir . basename($_FILES["resim"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		    if($check !== false) {
		        $uploadOk = 1;
		    } else {
		        echo ("Seçtiğiniz dosya resim dosyası değil.");
		        $uploadOk = 0;
		    }
		}
		if (file_exists($target_file)) {
		    $actual_name = pathinfo($target_file,PATHINFO_FILENAME);
			$original_name = $actual_name;
			$extension = pathinfo($target_file, PATHINFO_EXTENSION);
			$i = 1;
			while(file_exists('..images/haberler/'.$actual_name.".".$extension))
			{           
			    $actual_name = (string)$original_name.$i;
			    $target_file = $actual_name.".".$extension;
			    $i++;
			}
		}
		if ($_FILES["resim"]["size"] > 50000000) {
		    echo ("Seçtiğiniz resim boyutu çok fazla.");
		    $uploadOk = 0;
		}
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo ("Sadece JPG, JPEG, PNG ve GIF dosyası seçebilirsiniz.");
		    $uploadOk = 0;
		}
		if ($uploadOk == 0) {
		    echo ("Resim yükleme problemi.");
		} else {
		    if (move_uploaded_file($_FILES["resim"]["tmp_name"], $target_file)) {
		    	//ok
		    } else {
		        echo ("Resim yükleme problemi.");
		        $target_file="error";
		    }
		}
	}
	$baslik=$_POST['baslik'];
	$icerik=$_POST['icerik'];
	$icerik=str_replace(array("\r\n","\r"),"<br>",$icerik);
	$tarih=date("H:i:s - d.m.Y");
	if ( strcmp($_POST['sorgu'],'insert')==0 )
	{
		$ekle=mysqli_query($connection,"INSERT INTO haberler VALUES (NULL, '$baslik', '$icerik', '$target_file', '$tarih')");
		if($ekle)
			echo '<script type="text/javascript">showSnackbar();</script>';
	}
	elseif ( strcmp($_POST['sorgu'],'update')==0 )
	{
		$sorgu_no=$_POST['haber_no'];
		if( !isset($target_file) || empty($target_file) )
			$sorgu="UPDATE haberler SET baslik='$baslik', icerik='$icerik', tarih='$tarih' WHERE haber_no=$sorgu_no";
		else
			$sorgu="UPDATE haberler SET baslik='$baslik', icerik='$icerik', resim='$target_file', tarih='$tarih' WHERE haber_no=$sorgu_no";
		$ekle=mysqli_query($connection,$sorgu);
		if($ekle)
			echo '<script type="text/javascript">showSnackbar();</script>';
	}
}

elseif(isset($_GET['goruntule']) && !empty($_GET['goruntule']))
{
	$sorgu_no=$_GET['goruntule'];
	$result=mysqli_query($connection,"SELECT * FROM haberler WHERE haber_no=$sorgu_no");
	if ($yaz=mysqli_fetch_assoc($result))
	{
		echo '<script type="text/javascript">
		function doldur() {
			';
		foreach ($yaz as $key => $value) {
			echo '$("#'.$key.'").val("'.str_replace(array("\r\n","\r"),"",$value).'");
			';
		}
		echo '$("#buton1").text("Güncelle");
		$("#sorgu").val("update");
		$("#resim_input").removeAttr("required");
		$("#sil_href").attr("href", "?sil='.$yaz['haber_no'].'");
		$("#sil_buton").show();
		$("#resim").text("Resim Değiştir");
		}
		</script>
		<script type="text/javascript">
		doldur();
		</script>';

	}
}

elseif(isset($_GET['sil']) && !empty($_GET['sil']))
{
	$sorgu_no=$_GET['sil'];
	$result=mysqli_query($connection,"DELETE FROM haberler WHERE haber_no=$sorgu_no");
	if ($result)
	{
		echo '<script type="text/javascript">
		$("#snackbar span").text("Haber Silindi");
		showSnackbar();
		</script>';
	}
}

?>

<div id="haberler_select">
<?php
	$result=mysqli_query($connection,"SELECT * FROM haberler");
	if(@mysqli_num_rows($result)<1)
	{
		echo'<div class="row">
				<div class="col-xs-12 text-center">
					<div class="alert alert-info">
						<strong>Mevcut Haber Bulunmuyor !</strong>
					</div>
				</div>
			</div>';
	}
	else
	{
		$i=0;
		echo '<div class="row">';
		while ($yaz=mysqli_fetch_array($result))
		{
			if($i==5)
			{
				echo '</div><div class="row">';
				$i=0;
			}

			echo '<div class="col-xs-3">
				    <div class="thumbnail">
				      <a href="?goruntule='.$yaz['haber_no'].'">
				      <div class="caption">
				       <p class="text-center">'.$yaz['tarih'].'</p>
				        <img src="'.$yaz['resim'].'" alt="'.$yaz['baslik'].'" style="width:100%" >
				       <p class="text-center"><b>'.$yaz['baslik'].'</b></p>
				          <p class="text-center">'.$yaz['icerik'].'</p>
				        </div>
				      </a>
				    </div>
				  </div>';
			$i++;
		}
		echo '</div>';
	}
?>
</div>
</div><!--container-->
</body>
</html>