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
<div id="snackbar"><span>Duyuru Kaydedildi<span></div>
<div id="ekle_form">
<form method="POST" class="form-signin">
	<input type="hidden" name="sorgu" id="sorgu" value="insert">
	<input type="hidden" name="duyuru_no" id="duyuru_no" value="0">
	<div class="row">
		<div class="col-xs-2 col-xs-offset-5">
			<input type="text" name="baslik" id="baslik" class="form-control" placeholder="Duyuru Başlığı" required autofocus>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-8 col-xs-offset-2">
			<textarea style="height:3cm;" name="icerik" id="icerik" placeholder="Duyuru İçeriği" class="form-control" required></textarea>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-2 col-xs-offset-5">
			<button class="btn btn-primary form-control" id="buton1" type="submit">Yayınla</button>
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
	$baslik=$_POST['baslik'];
	$icerik=$_POST['icerik'];
	$icerik=str_replace(array("\r\n","\r"),"<br>",$icerik);
	$tarih=date("H:i:s - d.m.Y");
	if ( strcmp($_POST['sorgu'],'insert')==0 )
	{
		$ekle=mysqli_query($connection,"INSERT INTO duyurular VALUES (NULL, '$baslik', '$icerik', '$tarih')");
		if($ekle)
			echo '<script type="text/javascript">showSnackbar();</script>';
	}
	elseif ( strcmp($_POST['sorgu'],'update')==0 )
	{
		$sorgu_no=$_POST['duyuru_no'];
		$sorgu="UPDATE duyurular SET baslik='$baslik', icerik='$icerik', tarih='$tarih' WHERE duyuru_no=$sorgu_no";
		$ekle=mysqli_query($connection,$sorgu);
		if($ekle)
			echo '<script type="text/javascript">showSnackbar();</script>';
	}
}

elseif(isset($_GET['goruntule']) && !empty($_GET['goruntule']))
{
	$sorgu_no=$_GET['goruntule'];
	$result=mysqli_query($connection,"SELECT * FROM duyurular WHERE duyuru_no=$sorgu_no");
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
		$("#sil_href").attr("href", "?sil='.$yaz['duyuru_no'].'");
		$("#sil_buton").show();
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
	$result=mysqli_query($connection,"DELETE FROM duyurular WHERE duyuru_no=$sorgu_no");
	if ($result)
	{
		echo '<script type="text/javascript">
		$("#snackbar span").text("Duyuru Silindi");
		showSnackbar();
		</script>';
	}
}

?>

<div id="duyurular_select">
<?php
	$result=mysqli_query($connection,"SELECT * FROM duyurular");
	if(@mysqli_num_rows($result)<1)
	{
		echo'<div class="row">
				<div class="col-xs-12 text-center">
					<div class="alert alert-info">
						<strong>Mevcut Duyuru Bulunmuyor !</strong>
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
				      <a href="?goruntule='.$yaz['duyuru_no'].'">
				      <div class="caption">
				        <p class="text-center"><b>'.$yaz['baslik'].'</b></p>
				       <p class="text-center">'.$yaz['tarih'].'</p>
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