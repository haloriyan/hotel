<?php
include 'event.php';

class booking extends event {
	public function info($id, $struktur) {
		$q = $this->tabel("booking")->pilih()->dimana(["idbooking" => $id])->eksekusi();
		$r = $this->ambil($q);
		return $r[$struktur];
	}
	public function book($a, $b, $c, $d, $e) {
		$q = $this->tabel("booking")
				  ->tambah([
				  	"idbooking" => $a,
				  	"idevent" => $b,
				  	"iduser" => $c,
				  	"qty" => $d,
				  	"status" => 0,
				  	"tgl" => $e,
				  	"tgl_book" => date('Y-m-d'),
				  	"added" => time()
				  ])->eksekusi();
		return $q;
	}
	public function cek($idevent, $iduser) {
		$q = $this->tabel("booking")->pilih()->dimana(["idevent" => $idevent, "iduser" => $iduser])->eksekusi();
		if($this->hitung($q) != 0) {
			return "ada";
		}else {
			return "tiada";
		}
	}
}

$booking = new booking();

?>