<?php 

// echo "<pre>";
// print_r($_FILES["dosya"]);
// echo "</pre>";

// Array
// (
//     [name] => toşhiba  . portage. apple mac pisi0.jpg
//     [type] => image/jpeg
//     [tmp_name] => Z:\xampp\tmp\php19AE.tmp
//     [error] => 0
//     [size] => 163241
// )

class Uploads
{

	private $dosya;
	private $dosyaAdi;

	function __construct($file){
		$this->dosya=$file;
	}

	public function sadeceAd(){
		$adUzanti = explode(".", $this->dosya["name"]);
		/**
		 * [0]toşhiba  
		 * [1]portage
		 * [2]apple mac pisi0
		 * [3]jpg
		 */
		$sadeceAd = "";
		for ($i=0; $i<count($adUzanti)-1; $i++) { 
			$sadeceAd .= $adUzanti[$i];
		}
		// $sadeceAd="toşhiba  portage  apple mac pisi0"
		return $sadeceAd;
	}

	public function sadeceUzanti(){
		$adUzanti = explode(".", $this->dosya["name"]);
		/**
		 * [0]toşhiba  
		 * [1]portage
		 * [2]apple mac pisi0
		 * [3]jpg
		 */
		$sadeceUzanti=$adUzanti[count($adUzanti)-1];
		// $sadeceUzanti="jpg"
		return $sadeceUzanti;		
	}
	public function yeniAdOlustur($text){
		$tr = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#');
		$ing = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', '', '');
		$text = strtolower(str_replace($tr, $ing, $text));
		$text = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $text);
		$text = trim(preg_replace('/\s+/', ' ', $text));
		$text = str_replace(' ', '-', $text);
		// $text = $text ."_".$this->uniqIdOlustur();
		$text .= "_".$this->uniqIdOlustur();
		return $text;
	}

	public function uniqIdOlustur(){
		return uniqid();
	}

	public function yukle($yol=""){
		$ad = $this->sadeceAd();
		$uzanti = $this->sadeceUzanti();
		$yeniAd = $this->yeniAdOlustur($ad);
		$yeniDosyaAdi = $yeniAd.".".$uzanti;

		if ( $yol=="") {
			$yuklenecekDosya = $yeniDosyaAdi;
		}else{
			$yuklenecekDosya = $yol ."/". $yeniDosyaAdi;
		}

		$yuklenenDosya = move_uploaded_file($this->dosya["tmp_name"], $yuklenecekDosya);
		if ( $yuklenenDosya ) {
			$this->dosyaAdi=$yuklenecekDosya;
			return true;
		}else{
			return false;
		}
	}

	public function dosyaAdi(){
		return $this->dosyaAdi;
	}


}