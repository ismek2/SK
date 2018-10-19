<?php 

function turkceKarakterTemizle($param){
	$tr = array("ç","Ç","ğ","Ğ","İ","ı","ü","Ü","ö","Ö","ş","Ş"," ");
	$ing = array("c","C","g","G","I","i","u","U","o","O","s","S","");
	return str_replace($tr, $ing, $param);
}

function uniqIdUret(){
	$zaman = time();
	$rastgeleSayi=rand(1,10000);
	$uniqid = uniqid();
	$kimlik = $zaman."".$rastgeleSayi."".$uniqid;
	return $kimlik;
}

function seoUrlOlustur($text){
	$tr = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#');
	$ing = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', '', '');
	$text = strtolower(str_replace($tr, $ing, $text));
	$text = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $text);
	$text = trim(preg_replace('/\s+/', ' ', $text));
	$text = str_replace(' ', '-', $text);
	return $text;
}

function pisset(){
	if ( $_POST ) {
		return true;
	}else{
		return false;
	}
}

function gisset(){
	if ( $_GET ) {
		return true;
	}else{
		return false;
	}
}

function post($value){
	if (isset($_POST[$value])) {
		return trim($_POST[$value]);
	}else{
		return false;
	}
}

function get($value){
	if (isset($_GET[$value])) {
		return trim($_GET[$value]);
	}else{
		return false;
	}
}

function git($value){
	header("location:$value");
	exit();
}

function sureliGit($url,$sure=1){
	header("refresh:$sure;$url");
}