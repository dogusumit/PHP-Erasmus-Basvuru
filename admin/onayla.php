<?php
include 'head.php';

if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
	if(isset($_POST['id']) && !empty($_POST['id']))
	{
		$id=$_POST['id'];
		mysqli_query($connection,"UPDATE basvurular SET durum='2' WHERE basvuru_id='$id'");
	}
}

$result=mysqli_query($connection,"SELECT * FROM basvurular WHERE durum=1");
if(mysqli_num_rows($result)<1)
{
	echo'<div class="row">
			<div class="col-xs-12 text-center">
				<div class="alert alert-info">
					<strong>Onay Bekleyen Başvuru Bulunmuyor!</strong>
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
      </tr>
    </thead>
    <tbody>';
	while ($yaz=mysqli_fetch_array($result))
	{
		echo '<tr class="active">
		        <td>'.$yaz['basvuru_tarihi'].'</td>
		        <td>'.$yaz['ogrno'].'</td>
		        <td>'.$yaz['kullanici_ad'].'</td>
		        <td>'.$yaz['gno'].'</td>
		        <td>Onay Bekliyor</td>
		        <td>Henüz Girilmedi</td>
				<td>
				<form method="POST">
				<input type="hidden" name="id" value="'.$yaz['basvuru_id'].'">
				<button class="glyphicon glyphicon-ok" title="Onayla" aria-hidden="true"></button>
				</form>
				</td><td>
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