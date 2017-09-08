<?php
ob_start();
session_start();
include("../ayar.php");
if(isset($_SESSION['kullanici_id']))
	{
		$kullanici_id=$_SESSION['kullanici_id'];
		$kullanici_rol=$_SESSION['kullanici_rol'];
		$kullanici_ad=$_SESSION['kullanici_ad'];
		if(strcmp($kullanici_rol,'user')==0)
			yonlendir('../ogrenci/index.php');
	}
else
	yonlendir('../giris.php');

if(isset($_GET['id']))
{
	$sorgu_id=$_GET['id'];
	$sorgu="SELECT * FROM basvurular WHERE basvuru_id='$sorgu_id'";
	$result=mysqli_query($connection,$sorgu);
	if(mysqli_num_rows($result)>0)
	{
		$_POST=mysqli_fetch_array($result);
	}
}

?>
<!DOCTYPE HTML>

<html lang="tr">

<head>

	<meta charset="UTF-8">

	<link rel="stylesheet" href="../css/snackbar.css" />

	<link rel="stylesheet" href="../css/a4.css" />

	<link rel="stylesheet" href="../css/login.css" />

	<link rel="stylesheet" href="../css/bootstrap.css" />

	<link rel="stylesheet" href="../css/bootstrap-theme.css" />

	<script type="text/javascript" src="js/jquery-1.11.1.js"></script>

	<script type="text/javascript" src="js/bootstrap.js"></script>

	<script type="text/javascript" src="../js/jquery.min.js"></script>
	
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>

	<title>Erasmus Başvuru Sistemi</title>

</head>
<body>
<div class="container" style="width: 100%">
<div class="page">
	<div class="row">
		<div class="col-xs-12 text-center">
			<img height="50" width="50" src="../images/iste.png" /><br>
			<strong>T.C.<br>
				İSKENDERUN TEKNİK ÜNİVERSİTESİ REKTÖRLÜĞÜ<br>
				ERASMUS KURUM KOORDİNATÖRLÜĞÜ<br>
				ERASMUS+ ERASMUS PROGRAMI/ÖĞRENİM VE STAJ<br>
				HAREKETLİLİĞİ BAŞVURU FORMU</strong>
		</div>
	</div>

	<div class="row" style="height:4cm;">	
		<div class="col-xs-6 pull-right">
			<?php
				$resim='../images/users/'.@$_POST['kullanici_id'].'.jpg';
				if(file_exists($resim))
				{
					echo '<img class="pull-right" style="height:4cm; width:3.5cm; border: 1px solid black;" src="'.$resim.'"/>';
				}
				else
				{
					echo '<img class="pull-right" style="height:4cm; width:3.5cm; border: 1px solid black;" src="" ><br>';
				}
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6">
			<strong>Kişisel Bilgiler</strong>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-xs-6" style="height:1cm;border: 1px solid black;">
			<strong style="position: absolute;top: 50%;transform: translateY(-50%);">Adı Soyadı</strong>
		</div>
		<div class="col-xs-6"  style="height:1cm;border: 1px solid black;">
			<span style="position: absolute;top: 50%;transform: translateY(-50%);"><?php echo @$_POST['kullanici_ad']; ?></span>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6" style="height:1cm;border: 1px solid black;">
			<strong style="position: absolute;top: 50%;transform: translateY(-50%);">Öğrenci Numarası</strong>
		</div>
		<div class="col-xs-6"  style="height:1cm;border: 1px solid black;">
			<?php 
				if(isset($_POST['ogrno']) && isset($_GET['duzenle']))
					echo '<input type="number" name="ogrno" class="form-control" value="'.$_POST['ogrno'].'" required>';
				elseif(isset($_POST['ogrno']))
					echo '<span style="position: absolute;top: 50%;transform: translateY(-50%);">'.$_POST['ogrno'].'</span>';
				else
					echo '<input type="number" name="ogrno" class="form-control" placeholder="Öğrenci Numarası" required>';
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6" style="height:1cm;border: 1px solid black;">
			<strong style="position: absolute;top: 50%;transform: translateY(-50%);">Fakülte</strong>
		</div>
		<div class="col-xs-6"  style="height:1cm;border: 1px solid black;">
			<?php
				if(isset($_POST['fakulte']) && isset($_GET['duzenle']))
					echo '<input type="text" name="fakulte" class="form-control" value="'.$_POST['fakulte'].'" required>';
				elseif(isset($_POST['fakulte']))
					echo '<span style="position: absolute;top: 50%;transform: translateY(-50%);">'.$_POST['fakulte'].'</span>';
				else
					echo '<input type="text" name="fakulte" class="form-control" placeholder="Fakülte" required>';
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6" style="height:1cm;border: 1px solid black;">
			<strong style="position: absolute;top: 50%;transform: translateY(-50%);">Bölümü</strong>
		</div>
		<div class="col-xs-6"  style="height:1cm;border: 1px solid black;">
			<?php
				if(isset($_POST['bolumu']) && isset($_GET['duzenle']))
					echo '<input type="text" name="bolumu" class="form-control" value="'.$_POST['bolumu'].'" required>';
				elseif(isset($_POST['bolumu']))
					echo '<span style="position: absolute;top: 50%;transform: translateY(-50%);">'.$_POST['bolumu'].'</span>';
				else
					echo '<input type="text" name="bolumu" class="form-control" placeholder="Bölümü" required>';
			?>
		</div>
	</div>
		<div class="row">
		<div class="col-xs-6" style="height:1cm;border: 1px solid black;">
			<strong style="position: absolute;top: 50%;transform: translateY(-50%);">Öğrenim Düzeyi</strong>
		</div>
		<div class="col-xs-6"  style="height:1cm;border: 1px solid black;">
			<?php 
				if(isset($_POST['duzey']) && isset($_GET['duzenle']))
					echo '
						<select class="form-control" name="duzey" required>
							<option selected hidden>'.$_POST['duzey'].'</option>
							<option>ÖnLisans</option>
							<option>Lisans</option>
							<option>Y.Lisans</option>
							<option>Doktora</option>
						</select>';
				elseif(isset($_POST['duzey']))
					echo '<span style="position: absolute;top: 50%;transform: translateY(-50%);">'.$_POST['duzey'].'</span>';
				else
					echo '
						<select class="form-control" name="duzey" required>
							<option>ÖnLisans</option>
							<option>Lisans</option>
							<option>Y.Lisans</option>
							<option>Doktora</option>
						</select>';
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6" style="height:1cm;border: 1px solid black;">
			<strong style="position: absolute;top: 50%;transform: translateY(-50%);">Genel Not Ortalaması(GNO)</strong>
		</div>
		<div class="col-xs-6"  style="height:1cm;border: 1px solid black;">
			<?php 
				if(isset($_POST['gno']) && isset($_GET['duzenle']))
					echo '<input type="number" step="any" name="gno" class="form-control" value="'.$_POST['gno'].'" required>';
				elseif(isset($_POST['gno']))
					echo '<span style="position: absolute;top: 50%;transform: translateY(-50%);">'.$_POST['gno'].'</span>';
				else
					echo '<input type="number" step="any" name="gno" class="form-control" placeholder="GNO" required>';
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6" style="height:1cm;border: 1px solid black;">
			<strong style="position: absolute;top: 50%;transform: translateY(-50%);">Öğrenim Yılı (Sınıfı ve Yarıyılı)</strong>
		</div>
		<div class="col-xs-6"  style="height:1cm;border: 1px solid black;">
			<?php 
				if(isset($_POST['ogrenimyili']) && isset($_GET['duzenle']))
					echo '
			<select class="form-control" name="ogrenimyili" required>
				<option selected hidden>'.$_POST['ogrenimyili'].'</option>
				<option>1. Sınıf Güz Yarıyılı</option>
				<option>1. Sınıf Bahar Yarıyılı</option>
				<option>2. Sınıf Güz Yarıyılı</option>
				<option>2. Sınıf Bahar Yarıyılı</option>
				<option>3. Sınıf Güz Yarıyılı</option>
				<option>3. Sınıf Bahar Yarıyılı</option>
				<option>4. Sınıf Güz Yarıyılı</option>
				<option>4. Sınıf Bahar Yarıyılı</option>
			</select>';
				elseif(isset($_POST['ogrenimyili']))
					echo '<span style="position: absolute;top: 50%;transform: translateY(-50%);">'.$_POST['ogrenimyili'].'</span>';
				else
					echo '
			<select class="form-control" name="ogrenimyili" required>
				<option>1. Sınıf Güz Yarıyılı</option>
				<option>1. Sınıf Bahar Yarıyılı</option>
				<option>2. Sınıf Güz Yarıyılı</option>
				<option>2. Sınıf Bahar Yarıyılı</option>
				<option>3. Sınıf Güz Yarıyılı</option>
				<option>3. Sınıf Bahar Yarıyılı</option>
				<option>4. Sınıf Güz Yarıyılı</option>
				<option>4. Sınıf Bahar Yarıyılı</option>
			</select>';
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6" style="height:1cm;border: 1px solid black;">
			<strong style="position: absolute;top: 50%;transform: translateY(-50%);">I. Öğretim veya II. Öğretim</strong>
		</div>
		<div class="col-xs-6"  style="height:1cm;border: 1px solid black;">
			<?php
				if(isset($_POST['orgun']) && isset($_GET['duzenle']))
					echo '
			<select class="form-control" name="orgun" required>
				<option selected hidden>'.$_POST['orgun'].'</option>
				<option>I. Öğretim</option>
				<option>II. Öğretim</option>
			</select>';
				elseif(isset($_POST['orgun']))
					echo '<span style="position: absolute;top: 50%;transform: translateY(-50%);">'.$_POST['orgun'].'</span>';
				else
					echo '
			<select class="form-control" name="orgun" required>
				<option>I. Öğretim</option>
				<option>II. Öğretim</option>
			</select>';
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6" style="height:1cm;border: 1px solid black;">
			<strong style="position: absolute;top: 50%;transform: translateY(-50%);">Doğum Tarihi / Yeri</strong>
		</div>
		<div class="col-xs-6"  style="height:1cm;border: 1px solid black;">
			<?php 
				if(isset($_POST['dogum']) && isset($_GET['duzenle']))
					echo '<input type="text" name="dogum" class="form-control" value="'.$_POST['dogum'].'" required>';
				elseif(isset($_POST['dogum']))
					echo '<span style="position: absolute;top: 50%;transform: translateY(-50%);">'.$_POST['dogum'].'</span>';
				else
					echo '<input type="text" name="dogum" class="form-control" placeholder="Doğum Tarihi / Yeri" required>';
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6" style="height:1cm;border: 1px solid black;">
			<strong style="position: absolute;top: 50%;transform: translateY(-50%);">İkamet Adresi</strong>
		</div>
		<div class="col-xs-6"  style="height:1cm;border: 1px solid black;">
			<?php 
				if(isset($_POST['adresi']) && isset($_GET['duzenle']))
					echo '<input type="text" name="adresi" class="form-control" value="'.$_POST['adresi'].'" required>';
				elseif(isset($_POST['adresi']))
					echo '<span style="position: absolute;top: 50%;transform: translateY(-50%);">'.$_POST['adresi'].'</span>';
				else
					echo '<input type="text" name="adresi" class="form-control" placeholder="İkamet Adresi" required>';
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6" style="height:1cm;border: 1px solid black;">
			<strong style="position: absolute;top: 50%;transform: translateY(-50%);">Telefon Numarası</strong>
		</div>
		<div class="col-xs-6"  style="height:1cm;border: 1px solid black;">
			<?php 
				if(isset($_POST['telefon']) && isset($_GET['duzenle']))
					echo '<input type="number" name="telefon" class="form-control" value="'.$_POST['telefon'].'" required>';
				elseif(isset($_POST['telefon']))
					echo '<span style="position: absolute;top: 50%;transform: translateY(-50%);">'.$_POST['telefon'].'</span>';
				else
					echo '<input type="number" name="telefon" class="form-control" placeholder="Telefon Numarası" required>';
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6" style="height:1cm;border: 1px solid black;">
			<strong style="position: absolute;top: 50%;transform: translateY(-50%);">E-posta</strong>
		</div>
		<div class="col-xs-6"  style="height:1cm;border: 1px solid black;">
			<?php 
				if(isset($_POST['eposta']) && isset($_GET['duzenle']))
					echo '<input type="email" name="eposta" class="form-control" value="'.$_POST['eposta'].'" required>';
				elseif(isset($_POST['eposta']))
					echo '<span style="position: absolute;top: 50%;transform: translateY(-50%);">'.$_POST['eposta'].'</span>';
				else
					echo '<input type="email" name="eposta" class="form-control" placeholder="E-posta" required>';
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6" style="height:2cm;border: 1px solid black;">
			<strong style="position: absolute;top: 50%;transform: translateY(-50%);">Daha önce Erasmus Programından yararlandınız mı? Cevabınız evet ise hangi öğrenim kademesinde yararlandınız?</strong>
		</div>
		<div class="col-xs-6"  style="height:2cm;border: 1px solid black;">
			<?php 
				if(isset($_POST['oncekierasmus']) && isset($_GET['duzenle']))
					echo '
						<select class="form-control" name="oncekierasmus" required>
							<option selected hidden>'.$_POST['oncekierasmus'].'</option>
							<option>Hayır</option>
							<option>ÖnLisans</option>
							<option>Lisans</option>
							<option>Y.Lisans</option>
							<option>Doktora</option>
						</select>';
				elseif(isset($_POST['oncekierasmus']))
					echo '<span style="position: absolute;top: 50%;transform: translateY(-50%);">'.$_POST['oncekierasmus'].'</span>';
				else
					echo '
						<select class="form-control" name="oncekierasmus" required>
							<option>Hayır</option>
							<option>ÖnLisans</option>
							<option>Lisans</option>
							<option>Y.Lisans</option>
							<option>Doktora</option>
						</select>';
			?>
		</div>
	</div>
	<div class="modal fade" id="myModal" role="dialog">
    	<div class="modal-dialog">
    		<div class="modal-content">
    			<iframe width="100%" height="500px" id="uni_link" src="uni_ayrinti.php"></iframe>
    		</div>
    		<div class="modal-footer">
          		<button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
        	</div>
     	</div>
	</div>
	<script type="text/javascript">
		function fonksiyon_universite(uni)
		{
			$('#myModal').modal();
			$('#uni_link').attr('src','uni_ayrinti.php?uni='+uni);
		}
	</script>
	<div class="row">
		<div class="col-xs-6" style="height:1cm;border: 1px solid black;">
			<strong style="position: absolute;top: 50%;transform: translateY(-50%);">Üniversite Tercih-1</strong>
		</div>
		<div class="col-xs-6"  style="height:1cm;border: 1px solid black;">
			<?php 
				if(isset($_POST['universite']) && isset($_GET['duzenle']))
				{
					echo '<select class="form-control" name="universite" onchange="fonksiyon_universite(this.value);" required >';
					echo '<option selected hidden>'.$_POST['universite'].'</option>';
					if ($result = mysqli_query($connection,'SELECT uni_ad FROM anlasmalar GROUP BY uni_ad;')) 
					{
					    while ($row = mysqli_fetch_assoc($result)) 
					    {
					        echo '<option>'.$row['uni_ad'].'</option>';
					    }
					    mysqli_free_result($result);
					}
					echo "</select>";
				}	
				elseif(isset($_POST['universite']))
					echo '<span style="position: absolute;top: 50%;transform: translateY(-50%);">'.$_POST['universite'].'</span>';
				else
				{
					echo '<select class="form-control" name="universite" onchange="fonksiyon_universite(this.value);" required >';
					if ($result = mysqli_query($connection,'SELECT uni_ad FROM anlasmalar GROUP BY uni_ad;')) 
					{
					    while ($row = mysqli_fetch_assoc($result)) 
					    {
					        echo '<option>'.$row['uni_ad'].'</option>';
					    }
					    mysqli_free_result($result);
					}
					echo "</select>";
				}
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6" style="height:1cm;border: 1px solid black;">
			<strong style="position: absolute;top: 50%;transform: translateY(-50%);">Üniversite Tercih-2</strong>
		</div>
		<div class="col-xs-6"  style="height:1cm;border: 1px solid black;">
			<?php 
				if(isset($_POST['universite2']) && isset($_GET['duzenle']))
				{
					echo '<select class="form-control" name="universite2" onchange="fonksiyon_universite(this.value);" required >';
					echo '<option selected hidden>'.$_POST['universite2'].'</option>';
					if ($result = mysqli_query($connection,'SELECT uni_ad FROM anlasmalar GROUP BY uni_ad;')) 
					{
					    while ($row = mysqli_fetch_assoc($result)) 
					    {
					        echo '<option>'.$row['uni_ad'].'</option>';
					    }
					    mysqli_free_result($result);
					}
					echo "</select>";
				}
				elseif(isset($_POST['universite2']))
					echo '<span style="position: absolute;top: 50%;transform: translateY(-50%);">'.$_POST['universite2'].'</span>';
				else
				{
					echo '<select class="form-control" name="universite2" onchange="fonksiyon_universite(this.value);" required >';
					if ($result = mysqli_query($connection,'SELECT uni_ad FROM anlasmalar GROUP BY uni_ad;')) 
					{
					    while ($row = mysqli_fetch_assoc($result)) 
					    {
					        echo '<option>'.$row['uni_ad'].'</option>';
					    }
					    mysqli_free_result($result);
					}
					echo "</select>";
				}
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6" style="height:1cm;border: 1px solid black;">
			<strong style="position: absolute;top: 50%;transform: translateY(-50%);">Hangi Programa Başvurmak İstediği*</strong>
		</div>
		<div class="col-xs-6"  style="height:1cm;border: 1px solid black;">
			<?php
				if(isset($_POST['program']) && isset($_GET['duzenle']))
					echo '
					<select class="form-control" name="program" required>
						<option selected hidden>'.$_POST['program'].'</option>
						<option>Öğrenim Hareketliliği</option>
						<option>Staj Hareketliliği</option>
					</select>';
				elseif(isset($_POST['program']))
					echo '<span style="position: absolute;top: 50%;transform: translateY(-50%);">'.$_POST['program'].'</span>';
				else
					echo '
					<select class="form-control" name="program" required>
						<option>Öğrenim Hareketliliği</option>
						<option>Staj Hareketliliği</option>
					</select>';
			?>
		</div>
	</div>	
</div>
<div class="page">
	<div class="row">
		<div class="col-xs-12 text-center">
			<img height="50" width="50" src="../images/iste.png" /><br>
			<strong>T.C.<br>
				İSKENDERUN TEKNİK ÜNİVERSİTESİ REKTÖRLÜĞÜ<br>
				ERASMUS KURUM KOORDİNATÖRLÜĞÜ<br>
				ERASMUS+ ERASMUS PROGRAMI/ÖĞRENİM VE STAJ<br>
				HAREKETLİLİĞİ BAŞVURU FORMU</strong>
		</div>
	</div>
	<br>
	<br>
	<br>
	<div class="row">
		<div class="col-xs-6"  style="height:1cm;border: 0px solid black;">
			<span style="position: absolute;top: 50%;transform: translateY(-50%);">
			<b>Erasmus+ Özel İhtiyaç Desteği:</b></span>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-xs-6" style="height:1.2cm;border: 1px solid black;">
			<strong style="position: absolute;top: 50%;transform: translateY(-50%);">
			Özel İhtiyaç desteğine ihtiyaç duyuyor musunuz?</strong>
		</div>
		<div class="col-xs-6"  style="height:1.2cm;border: 1px solid black;">
			<?php
			echo '
			<input type="checkbox" name="chk7" value="checked" '.@$_POST['chk7'].'>Evet
			<input type="checkbox" name="chk8" value="checked" '.@$_POST['chk8'].'>Hayır';
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6" style="height:1.5cm;border: 1px solid black;">
			<strong style="position: absolute;top: 50%;transform: translateY(-50%);">Özel İhtiyaç desteğine ihtiyaç duyuyor iseniz bunun türü nedir?</strong>
		</div>
		<div class="col-xs-6"  style="height:1.5cm;border: 1px solid black;">
			<?php
			echo '
			<input type="checkbox" name="chk9" value="checked" '.@$_POST['chk9'].'>Fiziksel
			<input type="checkbox" name="chk10" value="checked" '.@$_POST['chk10'].'>Zihinsel<br>
			<input type="checkbox" name="chk11" value="checked" '.@$_POST['chk11'].'>Sağlıkla ilgili özel ihtiyaçlar';
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6" style="height:2.5cm;border: 1px solid black;">
			<strong style="position: absolute;top: 50%;transform: translateY(-50%);">
			Özel Erişim İhtiyaçlarınız Nelerdir?</strong>
		</div>
		<div class="col-xs-6"  style="height:2.5cm;border: 1px solid black;">
			<?php
			echo '
			<input type="checkbox" name="chk12" value="checked" '.@$_POST['chk12'].'>Uygun Konaklama
			<input type="checkbox" name="chk13" value="checked" '.@$_POST['chk13'].'>Seyahat İçin Yardım<br>
			<input type="checkbox" name="chk14" value="checked" '.@$_POST['chk14'].'>Tıbbi Refakat
			<input type="checkbox" name="chk15" value="checked" '.@$_POST['chk15'].'>Destek Teçhizat<br>
			<input type="checkbox" name="chk16" value="checked" '.@$_POST['chk16'].'>Uygun Öğrenim Materyalleri
			<input type="checkbox" name="chk17" value="checked" '.@$_POST['chk17'].'>Refakatçi<br>
			<input type="checkbox" name="chk18" value="checked" '.@$_POST['chk18'].'>Diğer';
			?>
		</div>
	</div>
		<div class="row">
		<div class="col-xs-6" style="height:2cm;border: 1px solid black;">
			<strong style="position: absolute;top: 50%;transform: translateY(-50%);">Özel ihtiyaçlarınızı ve fiziksel, zihinsel veya sağlıkla ilgili durumunuza ilişkin olarak öngörülen ek masraflarınızı belirtiniz.</strong>
		</div>
		<div class="col-xs-6"  style="height:2cm;border: 1px solid black;">
			<?php
				if(isset($_POST['ekmasraf']) && isset($_GET['duzenle']))
					echo '<textarea style="height:1.95cm;resize: none;" name="ekmasraf" class="form-control" >'.$_POST['ekmasraf'].'</textarea>';
				elseif(isset($_POST['ekmasraf']))
					echo '<span style="position: absolute;top: 50%;transform: translateY(-50%);">'.$_POST['ekmasraf'].'</span>';
				else
					echo '<textarea style="height:1.95cm;resize: none;" name="ekmasraf" class="form-control"></textarea>';
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6"  style="height:3cm;border: 0px solid black;">
			<span style="position: absolute;top: 50%;transform: translateY(-50%);">
			<b>*Başvuruya eklenecek belgeler:</b><br>
			<b>Ek.1 </b>Not Durum Belgesi (Transkript)<br>
			<b>Ek.2 </b>Nüfus Cüzdanın önlü arkalı fotokopisi</span>
		</div>
	</div>
	<br>
	<br>
	<div class="row">
		<div class="col-xs-12">
			<span>*Hareketlilik türlerinden birinden yararlanmaya hak kazandığım takdirde, Erasmus+ programının kuralları, Erasmus ofisinin bilgilendirmeleri ve karşı kurumun başvuru şartları ve kurallarına riayet edeceğimi beyan ederim.</span>
		</div>
	</div>
	<br>
	<br>
	<div class="row">
		<div class="col-xs-12 text-right">
			<span>İmza</span>
		</div>
	</div>
</div>
</div><!-- /container -->
</body>
</html>