<?php
include 'head.php';
$result=mysqli_query($connection,"SELECT * FROM basvurular WHERE kullanici_id='$kullanici_id'");
if(mysqli_num_rows($result)<1)
{
	echo'<div class="row">
			<div class="col-xs-12 text-center">
				<div class="alert alert-info">
					<strong>Mevcut Başvurunuz Bulunmuyor!</strong>
				</div>
			</div>
		</div>';
}
else
{
	echo '<table class="table">
	    <thead>
	      <tr>
	        <th>Başvuru Tarihi</th>
	        <th>Öğrenci No</th>
	        <th>Ad Soyad</th>
	        <th>GNO</th>
	        <th>Başvuru Durumu</th>
	        <th>İngilizce Notu</th>
	        <th></th>
	      </tr>
	    </thead>
	    <tbody>';
	while ($yaz=mysqli_fetch_array($result))
	{
		if($yaz['durum']==1)
		{
			echo '<tr class="active">
				        <td>'.$yaz['basvuru_tarihi'].'</td>
				        <td>'.$yaz['ogrno'].'</td>
				        <td>'.$yaz['kullanici_ad'].'</td>
				        <td>'.$yaz['gno'].'</td>
				        <td>Onay Bekliyor</td>
				        <td>Henüz Girilmedi</td>';
		echo '<td>
			<a href="?goruntule='.$yaz['basvuru_id'].'"><button class="glyphicon glyphicon-search" title="Görüntüle" aria-hidden="true"></button></a>
			<a href="basvuruyu_yazdir.php?id='.$yaz['basvuru_id'].'" ><button class="glyphicon glyphicon-print" title="Yazdır" aria-hidden="true"></button></a>
			<a href="?duzenle='.$yaz['basvuru_id'].'"><button class="glyphicon glyphicon-pencil" title="Düzenle" aria-hidden="true"></button></a>
			<a><button onclick="sil('.$yaz['basvuru_id'].')" class="glyphicon glyphicon-trash"  title="Sil" aria-hidden="true"></button></a>
			</td></tr>';
		}
		elseif($yaz['durum']==2)
		{
			echo '<tr class="warning">
			        <td>'.$yaz['basvuru_tarihi'].'</td>
			        <td>'.$yaz['ogrno'].'</td>
			        <td>'.$yaz['kullanici_ad'].'</td>
			        <td>'.$yaz['gno'].'</td>
			        <td>Onaylandı,İngilizce Sınavına Giriniz</td>
			        <td>Henüz Girilmedi</td>';
		echo '<td>
			<a href="?goruntule='.$yaz['basvuru_id'].'"><button class="glyphicon glyphicon-search" title="Görüntüle" aria-hidden="true"></button></a>
			<a href="basvuruyu_yazdir.php?id='.$yaz['basvuru_id'].'" ><button class="glyphicon glyphicon-print" title="Yazdır" aria-hidden="true"></button></a>
		</td></tr>';
		}
		elseif($yaz['durum']==3)
		{
			echo '<tr class="info">
			        <td>'.$yaz['basvuru_tarihi'].'</td>
			        <td>'.$yaz['ogrno'].'</td>
			        <td>'.$yaz['kullanici_ad'].'</td>
			        <td>'.$yaz['gno'].'</td>
			        <td>Yerleştirme Sonucu Bekliniz</td>
			        <td>'.$yaz['ingilizce_puani'].'</td>';
		echo '<td>
			<a href="?goruntule='.$yaz['basvuru_id'].'"><button class="glyphicon glyphicon-search" title="Görüntüle" aria-hidden="true"></button></a>
			<a href="basvuruyu_yazdir.php?id='.$yaz['basvuru_id'].'" ><button class="glyphicon glyphicon-print" title="Yazdır" aria-hidden="true"></button></a>
		</td></tr>';		
		}
		elseif($yaz['durum']==4)
		{
			echo '<tr class="success">
			        <td>'.$yaz['basvuru_tarihi'].'</td>
			        <td>'.$yaz['ogrno'].'</td>
			        <td>'.$yaz['kullanici_ad'].'</td>
			        <td>'.$yaz['gno'].'</td>
			        <td>Yerleşti : '.$yaz['yerlestigi_uni'].'</td>
			        <td>'.$yaz['ingilizce_puani'].'</td>';
		echo '<td>
			<a href="?goruntule='.$yaz['basvuru_id'].'"><button class="glyphicon glyphicon-search" title="Görüntüle" aria-hidden="true"></button></a>
			<a href="basvuruyu_yazdir.php?id='.$yaz['basvuru_id'].'" ><button class="glyphicon glyphicon-print" title="Yazdır" aria-hidden="true"></button></a>
		</td></tr>';		
		}
		elseif($yaz['durum']==5)
		{
			echo '<tr class="danger">
			        <td>'.$yaz['basvuru_tarihi'].'</td>
			        <td>'.$yaz['ogrno'].'</td>
			        <td>'.$yaz['kullanici_ad'].'</td>
			        <td>'.$yaz['gno'].'</td>
			        <td>Yerleşemedi</td>
			        <td>'.$yaz['ingilizce_puani'].'</td>';
		echo '<td>
			<a href="?goruntule='.$yaz['basvuru_id'].'"><button class="glyphicon glyphicon-search" title="Görüntüle" aria-hidden="true"></button></a>
			<a href="basvuruyu_yazdir.php?id='.$yaz['basvuru_id'].'" ><button class="glyphicon glyphicon-print" title="Yazdır" aria-hidden="true"></button></a>
		</td></tr>';
		}
		else
		{
			continue;
		}
	}
	echo '</tbody></table>';
	if(isset($_GET['goruntule']))
	{
		$sorgu_id=$_GET['goruntule'];
		$sorgu="SELECT * FROM basvurular WHERE kullanici_id='$kullanici_id' AND basvuru_id='$sorgu_id'";
		$result=mysqli_query($connection,$sorgu);
		if(mysqli_num_rows($result)>0)
		{
			$_POST=mysqli_fetch_array($result);
			include ('basvuru_formu.php');
		}
	}
	if(isset($_GET['duzenle']))
	{
		$sorgu_id=$_GET['duzenle'];
		$sorgu="SELECT * FROM basvurular WHERE kullanici_id='$kullanici_id' AND basvuru_id='$sorgu_id'";
		$result=mysqli_query($connection,$sorgu);
		if(mysqli_num_rows($result)>0)
		{
			$_POST=mysqli_fetch_array($result);
			echo '<form action="basvuruyu_guncelle.php?id='.$_GET['duzenle'].'" method="POST" enctype="multipart/form-data">
			<div class="row">
		<div class="col-xs-6 text-center">
			<button class="btn btn-primary" type="submit">Başvuruyu Kaydet</button>
		</div>
		<div class="col-xs-6 text-center">
		<label for="file_input" id="file_label" class="btn btn-primary">Resim Seç</label>
		<input type="file" name="resim" accept="image/*" id="file_input" style="visibility:hidden;">
		</div>
	</div>';
			include ('basvuru_formu.php');
			echo '</form></body></html>';
		}
	}
}
?>
<script>
function sil(id){
    if(confirm("Başvuruyu silmek istediğinize emin misiniz?")){
        window.location.href = "basvuruyu_sil.php?id="+id;
    }
    else{
        return false;
    }
}
</script>
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
</div>
</body>
</html>