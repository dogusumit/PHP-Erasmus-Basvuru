<?php
include 'head.php';

if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
	if(isset($_POST['id']) && !empty($_POST['id']))
	{
		if(isset($_POST['yetki'])  && !empty($_POST['yetki']))
		{
			$id=$_POST['id'];
			$yetki=$_POST['yetki'];
			mysqli_query($connection,"UPDATE kullanici SET kullanici_rol='$yetki' WHERE kullanici_id='$id'");
		}
	}
}

$result=mysqli_query($connection,"SELECT * FROM kullanici WHERE kullanici_id<>'$kullanici_id' AND kullanici_rol='admin'");
if(mysqli_num_rows($result)<1)
{
	echo'<div class="row">
			<div class="col-xs-12 text-center">
				<div class="alert alert-active">
					<strong>Sizin Dışınızda Admin Bulunmuyor!</strong>
				</div>
			</div>
		</div>';
}
else
{
	echo'<div class="row">
			<div class="col-xs-12 text-center">
				<div class="alert alert-active">
					<strong>ADMİNLER</strong>
				</div>
			</div>
		</div>';
	echo '<table class="table">
    <thead>
      <tr>
        <th>Kullanıcı Adı</th>
        <th>TC No</th>
        <th>email</th>
        <th>Telefon</th>
        <th>Yetkilendirme İşlemi</th>
      </tr>
    </thead>
    <tbody>';
	while ($yaz=mysqli_fetch_array($result))
	{
		echo '<tr class="active">
		        <td>'.$yaz['kullanici_adi_soyadi'].'</td>
		        <td>'.$yaz['kullanici_tc'].'</td>
		        <td>'.$yaz['kullanici_email'].'</td>
		        <td>'.$yaz['kullanici_tel'].'</td>
				<td>
				<form method="POST">
				<input type="hidden" name="id" value="'.$yaz['kullanici_id'].'">
				<input type="hidden" name="yetki" value="user">
				<button class="btn-primary" title="Yetkisini İptal Et" aria-hidden="true">Yetkisini İptal Et</button>
				</form>
				</td></tr>';
	}
	
	echo '</tbody></table>';
}

$result=mysqli_query($connection,"SELECT * FROM kullanici WHERE kullanici_id<>'$kullanici_id' AND kullanici_rol='user'");
if(mysqli_num_rows($result)<1)
{
	echo'<div class="row">
			<div class="col-xs-12 text-center">
				<div class="alert alert-active">
					<strong>Mevcut Kullanıcı Bulunmuyor!</strong>
				</div>
			</div>
		</div>';
}
else
{
	echo'<div class="row">
			<div class="col-xs-12 text-center">
				<div class="alert alert-active">
					<strong>KULLANICILAR</strong>
				</div>
			</div>
		</div>';
	echo '<table class="table">
    <thead>
      <tr>
        <th>Kullanıcı Adı</th>
        <th>TC No</th>
        <th>email</th>
        <th>Telefon</th>
        <th>Yetkilendirme İşlemi</th>
      </tr>
    </thead>
    <tbody>';
	while ($yaz=mysqli_fetch_array($result))
	{
		echo '<tr class="active">
		        <td>'.$yaz['kullanici_adi_soyadi'].'</td>
		        <td>'.$yaz['kullanici_tc'].'</td>
		        <td>'.$yaz['kullanici_email'].'</td>
		        <td>'.$yaz['kullanici_tel'].'</td>
				<td>
				<form method="POST">
				<input type="hidden" name="id" value="'.$yaz['kullanici_id'].'">
				<input type="hidden" name="yetki" value="admin">
				<button class="btn-primary" title="Admin Yetkisi Ver" aria-hidden="true">Admin Yetkisi Ver</button>
				</form>
				</td></tr>';
	}
	
	echo '</tbody></table>';
}

?>
</div><!-- /container -->
</body>
</html>