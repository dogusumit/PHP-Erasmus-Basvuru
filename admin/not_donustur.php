<?php
function not_donustur($dortluk)
{
	$dortluk=str_replace(',','.',$dortluk);
	$dortluk=round($dortluk,2);
	$file = fopen("yok_not_tablosu.txt",'r');
	$dizi=[];
	while(!feof($file))
	{  
        $satir = fgets($file); 
        $tmp=explode (" ",$satir);
        $dizi[$tmp[0]]=$tmp[1];
	} 
	fclose($file);
	return $dizi["$dortluk"];
}
?>