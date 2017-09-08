<?php
ob_start();
include("../ayar.php");
$uni=@$_GET['uni'];
$result=mysqli_query($connection,"SELECT * FROM anlasmalar WHERE uni_ad='$uni';");
if(mysqli_num_rows($result)<1)
{
	$anlasma_no='';
	$alan_kodu='';
	$ulke="";
	$uni_link="";
	$uni_ad="";
	$fakulte="";
	$donem="";
	$irtibat_kisi="";
	$irtibat_email="";
	$irtibat_tel="";
	$karsi_irtibat_kisi="";
	$karsi_irtibat_email="";
	$karsi_irtibat_tel="";
}
else
{
	if($yaz=mysqli_fetch_array($result));
	{
		$anlasma_no=$yaz['anlasma_no'];
		$alan_kodu=$yaz['alan_kodu'];
		$ulke=$yaz['ulke'];
		$uni_link=$yaz['uni_link'];
		$uni_ad=$yaz['uni_ad'];
		$fakulte=$yaz['fakulte'];
		$donem=$yaz['donem'];
		$irtibat_kisi=$yaz['irtibat_kisi'];
		$irtibat_email=$yaz['irtibat_email'];
		$irtibat_tel=$yaz['irtibat_tel'];
		$karsi_irtibat_kisi=$yaz['karsi_irtibat_kisi'];
		$karsi_irtibat_email=$yaz['karsi_irtibat_email'];
		$karsi_irtibat_tel=$yaz['karsi_irtibat_tel'];
	}
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/Grid.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../css/Agreement.css" media="screen" />
<style type="text/css">
body
{
font-size:12px;
margin:0;
padding:0;
background-color:#F5FAFC;
border:0;
font-family:tahoma,verdana,arial,  helvetica, sans-serif;
}
.emailimage
{

display:inline-block;
vertical-align:middle;
}
</style>
</head>
<body>
<div style="border:0;">
<div>
<table cellspacing="0" border="0" id="grdAnlasmaAna" style="border-style:None;width:100%;border-collapse:collapse;">
<tr>
<td>
<div class="AnlasmaDiv" style="border:0;">
<table class="AgreementAnaTablo" border="0">

<tr>
<td  colspan="2"><span id="grdAnlasmaAna_ctl02_Label14" class="AnlasmaBilgiBaslik">Anlaşma Bilgisi</span><br /></td>
</tr>

<tr class="AgreementAlt">
<td  class="AgreementBasliklar"><span id="grdAnlasmaAna_ctl02_Label12">Anlaşma Numarası</span></td>
<td style="width:100%;">
<span id="grdAnlasmaAna_ctl02_Label18"><?php echo $anlasma_no; ?></span></td>
</tr>
<tr class="AgreementAlt">
<td  class="AgreementBasliklar"><span id="grdAnlasmaAna_ctl02_Label452">Alan Kodu</span></td>
<td><span id="grdAnlasmaAna_ctl02_Label3">
<?php echo $alan_kodu; ?></span>
</tr>
<tr class="AgreementAlt">
<td  class="AgreementBasliklar"><span id="grdAnlasmaAna_ctl02_Label13">Ülke</span></td>
<td style="width:100%;">
<span id="grdAnlasmaAna_ctl02_Label8"><?php echo $ulke; ?></span></td>
</tr>

<tr>
<td  class="AgreementBasliklar"><span id="grdAnlasmaAna_ctl02_lblPartner">Ortak Kurum</span></td>
<td><span id="grdAnlasmaAna_ctl02_Label1"><a target="_blank" href="<?php echo $uni_link; ?>"><?php echo $uni_ad; ?></a></span>
</td>
</tr>

<tr class="AgreementAlt">
<td  class="AgreementBasliklar"><span id="grdAnlasmaAna_ctl02_Label2">Fakülte / Y.O</span></td>
<td><span id="grdAnlasmaAna_ctl02_Label3">
<?php echo $fakulte; ?></span>
</tr>
<tr>
<td  class="AgreementBasliklar"><span id="grdAnlasmaAna_ctl02_Label4">Dönem</span></td>
<td><span id="grdAnlasmaAna_ctl02_Label5"><?php echo $donem; ?></span></td>
</tr>
<tr class="AgreementAlt">
<td  class="AgreementBasliklar"><span id="grdAnlasmaAna_ctl02_Label6">İrtibat</span></td>
<td valign="middle"><span id="grdAnlasmaAna_ctl02_Label7"><?php echo $irtibat_kisi; ?></span> / <?php echo $irtibat_email; ?> / <?php echo $irtibat_tel; ?>
</td>
</tr>

<tr>
<td  class="AgreementBasliklar"><span id="grdAnlasmaAna_ctl02_Label16">Karşı İrtibat</span></td>
<td valign="middle"><span id="grdAnlasmaAna_ctl02_Label17"><?php echo $karsi_irtibat_kisi; ?></span> / <?php echo $karsi_irtibat_email; ?> / <?php echo $karsi_irtibat_tel; ?>
</td>
</tr>

<tr>
<td  colspan="2"><br /><span id="grdAnlasmaAna_ctl02_lbll" class="AnlasmaBilgiBaslik">Öğrenim Hareketliliği</span><br /></td>
</tr>
<tr>
<td  colspan="2" style="text-align:center;">
	<div>
		<table class="grid" cellspacing="0" rules="all" border="1" id="grdAnlasmaAna_ctl02_grdOgrenciAnlasmalar" style="background-color:White;width:100%;border-collapse:collapse;text-align:center;" >
			<tr class="AnlasmaBilgiBaslik" style="background-color:#0055bb;width:100%;border-collapse:collapse;">
				<th scope="col">Bölüm</th><th scope="col">Lang</th><th scope="col">Tür</th><th scope="col">Ön.Lis. &#214;ğr.</th><th scope="col">Lis. &#214;ğr.</th><th scope="col">Y. Lis. &#214;ğr.</th><th scope="col">Dok. &#214;ğr.</th><th scope="col">Toplam Süre</th>
			</tr>
			<?php 
			$result=mysqli_query($connection,"SELECT * FROM anlasmalar WHERE uni_ad='$uni' AND anlasma_turu='Öğrenim Hareketliliği';");
			while($yaz=mysqli_fetch_array($result))
				{?>
			<tr class="grid">
			<td align="left">
				<span id="grdAnlasmaAna_ctl02_grdOgrenciAnlasmalar_ctl02_hlblBolum"><?php echo $yaz['bolum']; ?></span>
			</td><td>
			<?php echo $yaz['ing_seviye']; ?>
		</td><td>
		<span id="grdAnlasmaAna_ctl02_grdOgrenciAnlasmalar_ctl02_Label1"><?php echo $yaz['gid_gel']; ?></span>
	</td><td><?php echo $yaz['kont_onlis']; ?></td><td><?php echo $yaz['kont_l']; ?></td><td><?php echo $yaz['kont_yl']; ?></td><td><?php echo $yaz['kont_dok']; ?></td><td><?php echo $yaz['anlasma_suresi']; ?></td>
</tr>
<?php } ?>
</table>
</div> 
</td>
</tr>
<tr>
<td  colspan="2"><br /><span id="grdAnlasmaAna_ctl02_lbll" class="AnlasmaBilgiBaslik">Staj Hareketliliği</span><br /></td>
</tr>
<tr>
<td  colspan="2" style="text-align:center;">
	<div>
		<table class="grid" cellspacing="0" rules="all" border="1" id="grdAnlasmaAna_ctl02_grdOgrenciAnlasmalar" style="background-color:White;width:100%;border-collapse:collapse;text-align:center;" >
			<tr class="AnlasmaBilgiBaslik" style="background-color:#0055bb;width:100%;border-collapse:collapse;">
				<th scope="col">Bölüm</th><th scope="col">Lang</th><th scope="col">Tür</th><th scope="col">Lis. &#214;ğr.</th><th scope="col">Y. Lis. &#214;ğr.</th><th scope="col">Dok. &#214;ğr.</th><th scope="col">Toplam Süre</th>
			</tr>
			<?php 
			$result=mysqli_query($connection,"SELECT * FROM anlasmalar WHERE uni_ad='$uni' AND anlasma_turu='Staj Hareketliliği';");
			while($yaz=mysqli_fetch_array($result))
				{?>
			<tr class="grid">
			<td align="left">
				<span id="grdAnlasmaAna_ctl02_grdOgrenciAnlasmalar_ctl02_hlblBolum"><?php echo $yaz['bolum']; ?></span>
			</td><td>
			<?php echo $yaz['ing_seviye']; ?>
		</td><td>
		<span id="grdAnlasmaAna_ctl02_grdOgrenciAnlasmalar_ctl02_Label1"><?php echo $yaz['gid_gel']; ?></span>
	</td><td><?php echo $yaz['kont_l']; ?></td><td><?php echo $yaz['kont_yl']; ?></td><td><?php echo $yaz['kont_dok']; ?></td><td><?php echo $yaz['anlasma_suresi']; ?></td>
</tr>
<?php } ?>
</table>
</div> 
</td>
</tr>
</table>
</div> 
</body>
</html>
