<?php
include 'head.php';
$msg='';
if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
	$tc_no=$_POST["tc_no"];
	$isim=$_POST["adim"];
	$email=$_POST["email"];
	$tel=$_POST["tel"];
	$sifre=$_POST["pasw"];
	$sor=mysqli_query($connection,"SELECT * FROM kullanici WHERE kullanici_tc='$tc_no' AND kullanici_email='$email'");
	if(!mysqli_num_rows($sor)){
		$ekle=mysqli_query($connection,"INSERT INTO kullanici VALUES (NULL,'$tc_no','$isim','$email','$sifre','$tel','user')");
		if($ekle){
			$msg='<p style="padding:5px 15px; -webkit-border-radius: 5px;-moz-border-radius: 5px;
			border-radius: 5px;background:#EDFECB; color:#030;margin-top:5px;">Yeni Üye Ekleme Başarılı</p>';
		}
	}
	else{
		$msg='<p style="padding:5px 15px; -webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;background:#FFECE6; color:#030;margin-top:5px;">Aynı TC nolu ve Emailden Birden Fazla Kayıt Olamaz</p>';
	}
}
?>
<body>
<div class="container" style="width: 100%">
	<nav class="navbar navbar-default navbar-static-top" role="navigation">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu"><span class="sr-only"></span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
		<a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home"></span></a>
		<div class="navbar-collapse collapse" id="menu-3">
			<ul class="nav navbar-nav">
				<li><a href="giris.php">Giriş Yap</a></li>
				<li class="active"><a href="kayit_ol.php">Kayıt Ol</a></li>
				<li><a href="sifremi_unuttum.php">Şifremi Unuttum</a></li>
			</ul>
		</div>
	</nav>
		<div class="card card-container">
			<img id="profile-img" class="profile-img-card" src="images/iste.png" />
			<p id="profile-name" class="profile-name-card"></p>
			<div id="remember">
				<label >
					<?php echo $msg;?>
				</label>
			</div>
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
			<form method="POST" class="form-signin" onSubmit="return checkPw(this)">
				<span id="reauth-email" class="reauth-email"></span>
				<input type="number" name="tc_no" class="form-control" placeholder="TC Kimlik Numarası" required autofocus maxlength="11">
				<input type="text" name="adim" class="form-control" placeholder="Ad Soyad" required>
				<input type="email" name="email" class="form-control" placeholder="E-Posta Adresi" required>
				<input type="number" name="tel" class="form-control" placeholder="Telefon Numarası" required>
				<input type="password" name="pasw" class="form-control" placeholder="Parola" required>
				<input type="password" name="pasw2" class="form-control" placeholder="Parola Doğrula" required>
				<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Kayıt Ol</button>
			</form>
</div><!-- /card-container -->
	</div><!-- /container -->
</body>
</html>