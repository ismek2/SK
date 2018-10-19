<?php
/**
*
*/
class Db extends PDO
{
	private $sql; // insert into kisi_tablosu set kisi_ad=?,kisi_soyad=?
	private $array; // array("mustafa","durna")
	private $sonEklenenId; // 12
	private $adet;
	private $error;
	function __construct($sunucu,$veritabani,$kullanici,$sifre,$charset="utf8")
	{
		try {
			parent::__construct("mysql:host=$sunucu;dbname=$veritabani;charset=$charset",$kullanici,$sifre);
		} catch ( Exception $hata) {
			die("bağlantı hatası..");
		}
	}
	public function select($param='')
	{
		if (trim($param)==1) {
			$sorgu=parent::prepare($this->sql);
			$sorgu->execute($this->array);
			if ($sorgu->rowCount()>0) {
				$this->adet = $sorgu->rowCount();
				return $sorgu->fetch(PDO::FETCH_ASSOC);
			} else {
				return false;
			}
		} else {
			$sorgu=parent::prepare($this->sql);
			$sorgu->execute($this->array);
			if ($sorgu->rowCount()>0) {
				$this->adet = $sorgu->rowCount();
				return $sorgu->fetchAll(PDO::FETCH_ASSOC);
			} else {
				return false;
			}
		}
	}
	public function query($query)
	{
		$this->sql = $query;
		return $this;
	}
	public function data($data)
	{
		$this->array = $data;
		return $this;
	}
	public function insert()
	{
		try{
			$sorgu = parent::prepare($this->sql); // insert into kisi_tablosu set kisi_ad=?,kisi_soyad=?
			$sorgu->execute($this->array);  // array("mustafa","durna")
			$this->sonEklenenId=parent::lastInsertId();  // 12
			if ($this->sonEklenenId>0) {
				return true;
			} else {
				return false;
			}
		}catch( Exception $hata){
			$this->error=$hata;
			return false;
		}
	}
	public function update()
	{
		try{
			$sorgu = parent::prepare($this->sql);
			$sorgu->execute($this->array);
			if ($sorgu->rowCount()) {
				return true;
			} else {
				return false;
			}
		}catch( Exception $hata){
			$this->error=$hata;
			return false;
		}
	}
	public function delete()
	{
		try{
			$sorgu = parent::prepare($this->sql);
			$sorgu->execute($this->array);
			if ($sorgu->rowCount()) {
				return true;
			} else {
				return false;
			}
		}catch( Exception $hata){
			$this->error=$hata;
			return false;
		}
	}
	public function count()
	{
		return $this->adet;
	}
	public function last_insert_id()
	{
		return $this->sonEklenenId;
	}
	public function error()
	{
		return $this->error;
	}
}