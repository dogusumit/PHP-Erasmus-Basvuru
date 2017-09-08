<?php
include 'head.php';
?>
<script type="text/javascript">
	function showSnackbar() {
    var x = document.getElementById("snackbar");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>
<script type="text/javascript">
	function goster() {
    $("#ekle_form").show();
    $("#ekle_buton").hide();
}
	function gizle() {
    $("#ekle_form").hide();
    $("#ekle_buton").show();
}
</script>
<div id="snackbar"><span>Anlaşma Kaydedildi<span></div>
<div id="ekle_buton">
	<button class="btn btn-primary" onclick="goster()">Anlaşma Ekle</button>
</div>
<div id="ekle_form" style="display: none">
<form method="POST" class="form-signin">
	<input type="hidden" name="sorgu" id="sorgu" value="insert">
	<input type="hidden" name="anlasma_no" id="anlasma_no" value="0">
	<div class="row">
		<div class="col-xs-2">
			<input type="text" name="ulke" id="ulke" class="form-control" placeholder="Ülke" required autofocus>
		</div>
		<div class="col-xs-2">
			<input type="text" name="uni_ad" id="uni_ad" class="form-control" placeholder="Üniversite" required >
		</div>
		<div class="col-xs-2">
			<input type="text" name="uni_link" id="uni_link" class="form-control" placeholder="Üniversite Link" >
		</div>
		<div class="col-xs-2">
			<input type="text" name="alan_kodu" id="alan_kodu" class="form-control" placeholder="Alan Kodu" >
		</div>
		<div class="col-xs-2">
			<input type="text" name="fakulte" id="fakulte" class="form-control" placeholder="Fakülte" >
		</div>
		<div class="col-xs-2">
			<input type="text" name="donem" id="donem" class="form-control" placeholder="Dönem" >
		</div>
	</div>
	<div class="row">
		<div class="col-xs-2">
			<input type="text" name="irtibat_kisi" id="irtibat_kisi" class="form-control" placeholder="İrtibat Kişi" >
		</div>
		<div class="col-xs-2">
			<input type="text" name="irtibat_email" id="irtibat_email" class="form-control" placeholder="İrtibat email" >
		</div>
		<div class="col-xs-2">
			<input type="text" name="irtibat_tel" id="irtibat_tel" class="form-control" placeholder="İrtibat tel" >
		</div>
		<div class="col-xs-2">
			<input type="text" name="karsi_irtibat_kisi" id="karsi_irtibat_kisi" class="form-control" placeholder="Karşı İrtibat Kişi" >
		</div>
		<div class="col-xs-2">
			<input type="text" name="karsi_irtibat_email" id="karsi_irtibat_email" class="form-control" placeholder="Karşı İrtibat email" >
		</div>
		<div class="col-xs-2">
			<input type="text" name="karsi_irtibat_tel" id="karsi_irtibat_tel" class="form-control" placeholder="Karşı İrtibat tel" >
		</div>
	</div>
	<div class="row">
		<div class="col-xs-2">
			<input type="text" name="bolum" id="bolum" class="form-control" placeholder="Bölüm" >
		</div>
		<div class="col-xs-2">
			<input type="text" name="ing_seviye" id="ing_seviye" class="form-control" placeholder="İngilizce Seviyesi" >
		</div>
		<div class="col-xs-2">
			<input type="number" name="kont_onlis" id="kont_onlis" class="form-control" placeholder="ÖnLisans Kontenjan" >
		</div>
		<div class="col-xs-2">
			<input type="number" name="kont_l" id="kont_l" class="form-control" placeholder="Lisans Kontenjan" >
		</div>
		<div class="col-xs-2">
			<input type="number" name="kont_yl" id="kont_yl" class="form-control" placeholder="Y.Lisans Kontenjan" >
		</div>
		<div class="col-xs-2">
			<input type="number" name="kont_dok" id="kont_dok" class="form-control" placeholder="Doktora Kontenjan" >
		</div>

	</div>
	<div class="row">
		<div class="col-xs-2">
			<input type="text" name="anlasma_suresi" id="anlasma_suresi" class="form-control" placeholder="Toplam Süre" >
		</div>
		<div class="col-xs-2">
			<select name="anlasma_turu" id="anlasma_turu" class="form-control">
			  <option value="Öğrenim Hareketliliği">Öğrenim Hareketliliği</option> 
			  <option value="Staj Hareketliliği">Staj Hareketliliği</option>
			</select>
		</div>
		<div class="col-xs-2">
			<select name="gid_gel" id="gid_gel" class="form-control">
			  <option value="Giden Öğrenci">Giden Öğrenci</option> 
			  <option value="Gelen Öğrenci">Gelen Öğrenci</option>
			</select>
		</div>
		<div class="col-xs-2">
        	<input type="date" name="anlasma_tarihi" id="anlasma_tarihi" class="form-control" value="<?php echo date('Y-m-d'); ?>" />
        </div>
		<div class="col-xs-2">
			<button class="btn btn-lg btn-primary btn-block btn-signin form-control" id="buton1" type="submit">Kaydet</button>
		</div>
		<div class="col-xs-2">
			<span class="btn btn-primary" onclick="gizle()">Gizle</span>
		</div>
	</div>		
</form>
</div>
<?php
if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
	$alan_kodu=$_POST['alan_kodu'];
	$ulke=$_POST['ulke'];
	$uni_link=$_POST['uni_link'];
	$uni_ad=$_POST['uni_ad'];
	$fakulte=$_POST['fakulte'];
	$donem=$_POST['donem'];
	$irtibat_kisi=$_POST['irtibat_kisi'];
	$irtibat_email=$_POST['irtibat_email'];
	$irtibat_tel=$_POST['irtibat_tel'];
	$karsi_irtibat_kisi=$_POST['karsi_irtibat_kisi'];
	$karsi_irtibat_email=$_POST['karsi_irtibat_email'];
	$karsi_irtibat_tel=$_POST['karsi_irtibat_tel'];
	$bolum=$_POST['bolum'];
	$ing_seviye=$_POST['ing_seviye'];
	$gid_gel=$_POST['gid_gel'];
	$kont_onlis=$_POST['kont_onlis'];
	$kont_l=$_POST['kont_l'];
	$kont_yl=$_POST['kont_yl'];
	$kont_dok=$_POST['kont_dok'];
	$anlasma_suresi=$_POST['anlasma_suresi'];
	$anlasma_turu=$_POST['anlasma_turu'];
	$anlasma_tarihi=$_POST['anlasma_tarihi'];
	if ( strcmp($_POST['sorgu'],'insert')==0 )
	{
		$ekle=mysqli_query($connection,"INSERT INTO anlasmalar VALUES (NULL, '$alan_kodu', '$ulke', '$uni_link', '$uni_ad', '$fakulte', '$donem', '$irtibat_kisi', '$irtibat_email', '$irtibat_tel', '$karsi_irtibat_kisi', '$karsi_irtibat_email', '$karsi_irtibat_tel', '$bolum', '$ing_seviye', '$gid_gel', '$kont_onlis', '$kont_l', '$kont_yl', '$kont_dok', '$anlasma_suresi', '$anlasma_turu', '$anlasma_tarihi')");
		if($ekle)
			echo '<script type="text/javascript">showSnackbar();</script>';
	}
	elseif ( strcmp($_POST['sorgu'],'update')==0 )
	{
		$sorgu_no=$_POST['anlasma_no'];
		$ekle=mysqli_query($connection,"UPDATE anlasmalar SET alan_kodu='$alan_kodu', ulke='$ulke', uni_link='$uni_link', uni_ad='$uni_ad', fakulte='$fakulte', donem='$donem', irtibat_kisi='$irtibat_kisi', irtibat_email='$irtibat_email', irtibat_tel='$irtibat_tel', karsi_irtibat_kisi='$karsi_irtibat_kisi', karsi_irtibat_email='$karsi_irtibat_email', karsi_irtibat_tel='$karsi_irtibat_tel', bolum='$bolum', ing_seviye='$ing_seviye', gid_gel='$gid_gel', kont_onlis='$kont_onlis', kont_l='$kont_l', kont_yl='$kont_yl', kont_dok='$kont_dok', anlasma_suresi='$anlasma_suresi', anlasma_turu='$anlasma_turu', anlasma_tarihi='$anlasma_tarihi' WHERE anlasma_no=$sorgu_no");
		if($ekle)
			echo '<script type="text/javascript">showSnackbar();</script>';
	}
}

elseif(isset($_GET['goruntule']) && !empty($_GET['goruntule']))
{
	$sorgu_no=$_GET['goruntule'];
	$result=mysqli_query($connection,"SELECT * FROM anlasmalar WHERE anlasma_no=$sorgu_no");
	if ($yaz=mysqli_fetch_assoc($result))
	{
		echo '<script type="text/javascript">
		function doldur() {
			';
		foreach ($yaz as $key => $value) {
			echo '$("#'.$key.'").val("'.$value.'");
			';
		}
		echo '$("#buton1").text("Güncelle");
		$("#sorgu").val("update");
		}
		</script>
		<script type="text/javascript">
		doldur();
		goster();
		</script>';

	}
}

elseif(isset($_GET['sil']) && !empty($_GET['sil']))
{
	$sorgu_no=$_GET['sil'];
	$result=mysqli_query($connection,"DELETE FROM anlasmalar WHERE anlasma_no=$sorgu_no");
	if ($result)
	{
		
		echo '<script type="text/javascript">
		$("#snackbar span").text("Anlaşma Silindi");
		showSnackbar();
		</script>';

	}
}

?>

<div id="anlasmalar_select">
<?php
	$result=mysqli_query($connection,"SELECT * FROM anlasmalar");
	if(mysqli_num_rows($result)<1)
	{
		echo'<div class="row">
				<div class="col-xs-12 text-center">
					<div class="alert alert-info">
						<strong>Mevcut Anlaşma Bulunmuyor!</strong>
					</div>
				</div>
			</div>';
	}
	else
	{
			echo '<table class="table">
				    <thead>
				      <tr>
				        <th>Anlaşma No</th>
				        <th>Ülke</th>
				        <th>Üniversite</th>
				        <th>Bölüm</th>
				        <th>Anlaşma Türü</th>
				        <th>Öğrenci</th>
				        <th>Anlaşma Tarihi</th>
				      </tr>
				    </thead>
				    <tbody>';
		while ($yaz=mysqli_fetch_array($result))
		{
			echo '<tr class="active">
			<td>'.$yaz['anlasma_no'].'</td>
			<td>'.$yaz['ulke'].'</td>
			<td>'.$yaz['uni_ad'].'</td>
			<td>'.$yaz['bolum'].'</td>
			<td>'.$yaz['anlasma_turu'].'</td>
			<td>'.$yaz['gid_gel'].'</td>
			<td>'.$yaz['anlasma_tarihi'].'<td>
			<td>
			<a href="?goruntule='.$yaz['anlasma_no'].'"><button class="glyphicon glyphicon-search" title="Görüntüle" aria-hidden="true"></button></a>
			<a href="?sil='.$yaz['anlasma_no'].'"><button class="glyphicon glyphicon-trash" title="Sil" aria-hidden="true"></button></a>
			</td></tr>';
		}
	
	echo '</tbody></table>';
	}
?>
</div>
</div><!--container-->
</body>
</html>