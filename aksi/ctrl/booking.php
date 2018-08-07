<?php
include 'event.php';

class booking extends event {
	public function info($id, $struktur) {
		$q = $this->tabel("booking")->pilih($struktur)->dimana(["idbooking" => $id])->eksekusi();
		$r = $this->ambil($q);
		return $r[$struktur];
	}
	public function book($a, $b, $c, $nama, $d, $e) {
		$q = $this->tabel("booking")
				  ->tambah([
				  	"idbooking" => $a,
				  	"idevent" => $b,
					"iduser" => $c,
					"nama" => $nama,
				  	"qty" => $d,
				  	"status" => 0,
				  	"tgl" => $e,
				  	"tgl_book" => date('Y-m-d H:i:s'),
				  	"added" => time()
				  ])->eksekusi();
		// ngubah
		$ubah = $this->query("UPDATE event SET availableseat = availableseat - $d WHERE idevent = '$b'");
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

	public function guest($idevent, $hadir, $nama) {
		if($hadir == "") {
			$hadir = 0;
		}
		$q = $this->query("SELECT * FROM booking WHERE nama LIKE '%$nama%' AND idevent = '$idevent' AND hadir = '$hadir' ORDER BY nama ASC");
		if($this->hitung($q) == 0) {
			return "null";
		}else {
			while($r = $this->ambil($q)) {
				$hasil[] = $r;
			}
			return $hasil;
		}
	}

	public function allBook($idevent) {
		$q = $this->tabel("booking")->pilih()->dimana(["idevent" => $idevent])->eksekusi();
		if($this->hitung($q) == 0) {
			return "null";
		}else {
			while($r = $this->ambil($q)) {
				$hasil[] = $r;
			}
			return $hasil;
		}
	}

	// Payment
	public function confirm($id, $bukti) {
		$q = $this->tabel("booking")
				  ->ubah([
					  "bukti" => $bukti
				  ])
				  ->dimana([
					  "idbooking" => $id
				  ])->eksekusi();
	}

	// For Admin
	public function all() {
		$q = $this->query("SELECT * FROM booking WHERE bukti != '' AND status = 0");
		if($this->hitung($q) == 0) {
			return "null";
		}else {
			while($r = $this->ambil($q)) {
				$hasil[] = $r;
			}
			return $hasil;
		}
	}
	public function cawang($id) {
		$q = $this->tabel("booking")->ubah(["status" => 1])->dimana(["idbooking" => $id])->eksekusi();
		return $q;
	}

	public function hadir($id) {
		$q = $this->tabel("booking")->ubah(["hadir" => 1])->dimana(["idbooking" => $id])->eksekusi();
		return $q;
	}
}

$booking = new booking();

?>