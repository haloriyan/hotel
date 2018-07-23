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
		// ngubah
		$ubah = $this->query("UPDATE event SET avaibleseat = avaibleseat - 1 WHERE idevent = '$b'");
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
	public function myBooking($iduser) {
		$q = $this->tabel("booking")->pilih()->dimana(["iduser" => $iduser])->eksekusi();
		if($this->hitung($q) == 0) {
			return "null";
		}else {
			while($r = $this->ambil($q)) {
				$hasil[] = $r;
			}
			return $hasil;
		}
	}
}

$booking = new booking();

?>