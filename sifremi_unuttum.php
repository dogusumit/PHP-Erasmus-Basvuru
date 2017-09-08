<?php
include 'head.php';
$msg='';
if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{		
	$tcno=trim($_POST["tc_no"]);
	$eposta=trim($_POST["email"]);
	$sor=mysqli_query($connection,"SELECT * FROM kullanici WHERE  kullanici_email='$eposta' AND kullanici_tc='$tcno'");
	$yazgi=mysqli_fetch_array($sor);
	if(!mysqli_num_rows($sor))
	{
		$msg='Verdiğiniz Bilgiler Yanlış!';
	}
	else
	{
		include "class.phpmailer.php";
		include "class.pop3.php";
		include "class.smtp.php";
		$sablon = '<table width="468" height="320" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td height="106" colspan="3" align="center"><span style="font-family:Tahoma; font-size:12px; color:#000;">Kullanici Bilgileriniz Asagidaki Sekildedir.Lutfen Asagidaki Bilgilere Gore Giris Yapiniz..</span></td>
		</tr>
		<tr>
			<td width="100" height="22" align="left">Kullanici Adiniz</td>
			<td width="5" align="center">:</td>
			<td width="281" align="left"><b>'. $yazgi["kullanici_adi_soyadi"] .'</b></td>
		</tr>
		<tr>
			<td height="21" align="left">Kullanici Sifreniz</td>
			<td align="center">:</td>
			<td align="left"><b>'. $yazgi["kullanici_sifre"] .'</b></td>
		</tr>
		<tr>
			<td height="13" colspan="3" align="left"><p>İSTE Erasmus Basvuru Sistemi<br>  
				<br>
				<br>
			</p></td>
		</tr>

	</table>';
	$mail=
	new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth=true;
	$mail->SMTPSecure = 'ssl';
	$mail->Host = 'smtp.gmail.com';
	$mail->Port =465;
	$mail->Username="*****@gmail.com";
	$mail->Password="*****";
	$mail->SetFrom('iste.edu.tr');
	$mail->FromName='ISTE';
	$mail->CharSet="iso-8859-9";
	$mail->AddAddress($eposta);
	$mail->Subject='Sifreni Hatirla';
	$mail->IsHTML(true);
	$mail->Body=$sablon;
	if($mail->Send()) 
	{ 
		$msg='Şifreniz e-posta adresinize başarılı bir şekilde yollanmıştır.';
	}
	else 
	{ 
		$msg="Mailer Hata: " . $mail->ErrorInfo;
	}
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
				<li><a href="kayit_ol.php">Kayıt Ol</a></li>
				<li class="active"><a href="sifremi_unuttum.php">Şifremi Unuttum</a></li>
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
			<form method="POST" class="form-signin" onSubmit="return checkPw(this)">
				<span id="reauth-email" class="reauth-email"></span>
				<input type="number" name="tc_no" class="form-control" placeholder="TC Kimlik Numaranız" required autofocus maxlength="11">
				<input type="email" name="email" class="form-control" placeholder="Kayıtlı E-Posta Adresiniz" required>
				<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Şifremi Gönder</button>
			</form>
		</div><!-- /card-container -->
	</div><!-- /container -->
</body>
</html>