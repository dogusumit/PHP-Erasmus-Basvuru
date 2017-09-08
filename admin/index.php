<?php
include 'head.php';

$result=mysqli_query($connection,"SELECT * FROM basvurular");
if(mysqli_num_rows($result)<1)
{
	echo'<div class="row">
			<div class="col-xs-12 text-center">
				<div class="alert alert-info">
					<strong>Mevcut Başvuru Bulunmuyor!</strong>
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
			        <td>Henüz Girilmedi</td>
					<td><button class="glyphicon glyphicon-search" title="Görüntüle" aria-hidden="true" onclick="openModal('.$yaz['basvuru_id'].')"></button>
					<a href="basvuruyu_yazdir.php?id='.$yaz['basvuru_id'].'" ><button class="glyphicon glyphicon-print" title="Yazdır" aria-hidden="true"></button></a>
				</td></tr>';
		}
		elseif($yaz['durum']==2)
		{
			echo '<tr class="warning">
			        <td>'.$yaz['basvuru_tarihi'].'</td>
			        <td>'.$yaz['ogrno'].'</td>
			        <td>'.$yaz['kullanici_ad'].'</td>
			        <td>'.$yaz['gno'].'</td>
			        <td>İngilizce Sınavı Bekliyor</td>
			        <td>Henüz Girilmedi</td>
					<td><button class="glyphicon glyphicon-search" title="Görüntüle" aria-hidden="true" onclick="openModal('.$yaz['basvuru_id'].')"></button>
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
			        <td>Yerleştirme Sonucu Bekliyor</td>
			        <td>'.$yaz['ingilizce_puani'].'</td>
					<td><button class="glyphicon glyphicon-search" title="Görüntüle" aria-hidden="true" onclick="openModal('.$yaz['basvuru_id'].')"></button>
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
			        <td>'.$yaz['ingilizce_puani'].'</td>
					<td><button class="glyphicon glyphicon-search" title="Görüntüle" aria-hidden="true" onclick="openModal('.$yaz['basvuru_id'].')"></button>
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
			        <td>'.$yaz['ingilizce_puani'].'</td>
					<td><button class="glyphicon glyphicon-search" title="Görüntüle" aria-hidden="true" onclick="openModal('.$yaz['basvuru_id'].')"></button>
					<a href="basvuruyu_yazdir.php?id='.$yaz['basvuru_id'].'" ><button class="glyphicon glyphicon-print" title="Yazdır" aria-hidden="true"></button></a>
				</td></tr>';	
		}
		else
		{
			continue;
		}
	}
	
	echo '</tbody></table>';
}
?>
	   <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 80%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
        <iframe width="100%" height="100%" id="idIframe" src="modal.php"></iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
	<script type="text/javascript">
		function openModal(id)
		{
			    var size = {width: $(window).width() , height: $(window).height() }
    /*CALCULATE SIZE*/
    var offset = 20;
    var offsetBody = 150;
    $('#myModal').css('height', size.height - offset );
    $('.modal-body').css('height', size.height - (offset + offsetBody));
    $('#myModal').css('top', 0);
			$('#myModal').modal();
			$('#idIframe').attr('src','modal.php?id='+id);
		}
	</script>
</div><!-- /container -->
</body>
</html>