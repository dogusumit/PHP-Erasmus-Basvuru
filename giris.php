<?php
include 'head.php';
$msg='<p style="padding:5px 15px; -webkit-border-radius: 5px;-moz-border-radius: 5px;
border-radius: 5px;background:#EDFECB; color:#030; margin-top:5px;">Erasmus Başvuru Sistemine Hoşgeldiniz</p>';
if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
	$email=trim($_POST["email"]);
	$sifre=trim($_POST["pasw"]);

	$msg=$email;

	$sor=mysqli_query($connection,"SELECT * FROM kullanici WHERE kullanici_email='$email' AND kullanici_sifre='$sifre'");
	if(!mysqli_num_rows($sor)){
		$msg='<p style="padding:5px 15px; -webkit-border-radius: 5px;-moz-border-radius: 5px;
		border-radius: 5px;margin-top:5px;background:#FFECE6;color:#030;margin-top:5px;">E-Posta Adresiniz veya Şifre Yanlış</p>';
	}
	else{
		$msg='<div class="alert alert-info" role="alert"><b>Erasmus Başvuru Sistemine Hoşgeldiniz</b></div>';
		$yaz=mysqli_fetch_array($sor);
		$_SESSION['kullanici_id']=$yaz["kullanici_id"];
		$_SESSION['kullanici_rol']=$yaz["kullanici_rol"];
		$_SESSION['kullanici_ad']=$yaz["kullanici_adi_soyadi"];
		if(strcmp($_SESSION['kullanici_rol'],'admin')==0)
			yonlendir('admin/index.php');
		else if(strcmp($_SESSION['kullanici_rol'],'user')==0)
			yonlendir('ogrenci/index.php');;
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
				<li class="active"><a href="giris.php">Giriş Yap</a></li>
				<li><a href="kayit_ol.php">Kayıt Ol</a></li>
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
			<form method="POST" class="form-signin">
				<input type="email" name="email" class="form-control" placeholder="Email address" required autofocus>
				<input type="password" name="pasw" class="form-control" placeholder="Password" required>
				<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Giriş Yap</button>
			</form><!-- /form -->
			<a href="sifremi_unuttum.php" class="forgot-password">
				Şifreni unuttun mu?
			</a>
		</div><!-- /card-container -->
	</div><!-- /container -->
</body>
</html>