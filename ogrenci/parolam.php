<?php
include 'head.php';
if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
	$eski_pasw=$_POST["eski_pasw"];
	$pasw=$_POST["pasw"];
	$sorgu = "UPDATE kullanici SET kullanici_sifre='$pasw' WHERE kullanici_id='$kullanici_id' AND kullanici_sifre='$eski_pasw';";
	$guncelle=mysqli_query($connection,$sorgu);
	if(mysqli_affected_rows($connection)>0)
	{
		echo '<div class="row">
			<div class="col-xs-12 text-center">
				<div class="alert alert-success">
					<strong>Parolanız Başarıyla Güncellendi</strong>
				</div>
			</div>
			</div>';
	}
	else
	{
		echo '<div class="row">
			<div class="col-xs-12 text-center">
				<div class="alert alert-danger">
					<strong>Bilgilerinizi Kontrol Edin!</strong>
				</div>
			</div>
			</div>';
	}
}
?>

	<div class="card card-container">
		<img id="profile-img" class="profile-img-card" 
		src="../images/users/<?php echo $kullanici_id.'.jpg'; ?>" />
		<script type="text/javascript">
		</script>
			<form method="POST" class="form-signin" onSubmit="return checkPw(this)">
			<input type="password" name="eski_pasw" class="form-control" placeholder="Eski Parola" required>
			<input type="password" name="pasw" class="form-control" placeholder="Yeni Parola" required>
			<input type="password" name="pasw2" class="form-control" placeholder="Yeni Parola Doğrula" required>
			<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Kaydet</button>
		</form>
	</div><!-- /card-container -->
</div><!-- /container -->
</body>
			<script type="text/javascript">
				function checkPw(form) {
					pw1 = form.pasw.value;
					pw2 = form.pasw2.value;

					if (pw1 != pw2) {
						alert ("\nParolalar eşleşmiyor!")
						return false;
					}
					else return true;
				}
			</script>
</html>