<?php
include 'head.php';
include 'not_donustur.php';
include 'kontDondur.php';

if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
	if(isset($_POST['id']) && !empty($_POST['id']))
	{
		if(isset($_POST['yetki'])  && !empty($_POST['yetki']))
		{
			$id=$_POST['id'];
			$yetki=$_POST['yetki'];
			mysqli_query($connection,"UPDATE kullanici SET yetki='$yetki' WHERE kullanici_id='$id'");
		}
	}
}
$result=mysqli_query($connection,"SELECT * FROM basvurular WHERE durum='3'");
while ($yaz=@mysqli_fetch_array($result))
{
	$erasmus_puani=(floatval(not_donustur($yaz['gno']))+floatval($yaz['ingilizce_puani']))/2.0;
	$tmp_id=$yaz['basvuru_id'];
	mysqli_query($connection,"UPDATE basvurular SET erasmus_puani=$erasmus_puani WHERE basvuru_id='$tmp_id'");
}
$result=mysqli_query($connection,"SELECT uni_ad,kont_onlis,kont_l,kont_yl,kont_dok FROM anlasmalar");
$kontenjanlar=[];
while ($yaz=@mysqli_fetch_assoc($result))
{
	$kontenjanlar[$yaz['uni_ad']]["kont_onlis"]=$yaz['kont_onlis'];
	$kontenjanlar[$yaz['uni_ad']]["kont_l"]=$yaz['kont_l'];
	$kontenjanlar[$yaz['uni_ad']]["kont_yl"]=$yaz['kont_yl'];
	$kontenjanlar[$yaz['uni_ad']]["kont_dok"]=$yaz['kont_dok'];
}
$result=mysqli_query($connection,"SELECT * FROM basvurular WHERE durum='3' ORDER BY erasmus_puani DESC");
if(mysqli_num_rows($result)<1)
{
	echo'<div class="row">
			<div class="col-xs-12 text-center">
				<div class="alert alert-active">
					<strong>Yerleştirme Bekleyen Başvuru Bulunmuyor!</strong>
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
        <th>İngilizce Notu</th>
        <th>Erasmus Notu</th>
        <th>Tercih-1</th>
        <th>Tercih-2</th>
        <th>Sonuç</th>
      </tr>
    </thead>
    <tbody>';
	while ($yaz=mysqli_fetch_array($result))
	{
		$kont_tur=kontDondur($yaz['duzey']);
		if($kontenjanlar[ $yaz['universite'] ][$kont_tur] > 0)
		{
			$sonuc=$yaz['universite'];
			$kontenjanlar[ $yaz['universite'] ][$kont_tur]--;
		}
		elseif($kontenjanlar[ $yaz['universite2'] ][$kont_tur] > 0)
		{
			$sonuc=$yaz['universite2'];
			$kontenjanlar[ $yaz['universite2'] ][$kont_tur]--;
		}
		else
		{
			$sonuc='Yerleşemedi';
		}
		echo '<tr class="active">
		        <td>'.$yaz['basvuru_tarihi'].'</td>
		        <td>'.$yaz['ogrno'].'</td>
		        <td>'.$yaz['kullanici_ad'].'</td>
		        <td>'.$yaz['gno'].'</td>
		        <td>'.$yaz['ingilizce_puani'].'</td>
				<td>'.$yaz['gno'].' => '.not_donustur($yaz['gno']).'<br>('.not_donustur($yaz['gno']).' + 
				'.$yaz['ingilizce_puani'].') / 2 = '.$yaz['erasmus_puani'].'
				</td>
				<td>'.$yaz['universite'].'</td>
				<td>'.$yaz['universite2'].'</td>
				<td>'.$sonuc.'</td>
				<td>
				<button class="glyphicon glyphicon-search" title="Görüntüle" aria-hidden="true" onclick="openModal('.$yaz['basvuru_id'].')"></button>
			</td></tr>';
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