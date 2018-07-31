<?php
include 'resto.php';

class event extends resto {
	public function info($id, $struktur) {
		$q = $this->tabel("event")
				  ->pilih()
				  ->dimana(["idevent" => $id])
				  ->eksekusi();
		$r = $this->ambil($q);
		return $r[$struktur];
	}
	public function create($a, $b, $idresto, $c, $d, $e, $f, $g, $h, $i, $j, $tglAkhir, $jPosted, $k, $seat, $l, $m) {
		$q = $this->tabel("event")
				  ->tambah([
				  	"idevent" => $a,
					"idhotel" => $b,
					"id_resto" => $idresto,
				  	"title" => $c,
				  	"tagline" => $d,
				  	"description" => $e,
				  	"logos" => $f,
				  	"covers" => $g,
				  	"region" => $h,
				  	"address" => $i,
				  	"tgl_mulai" => $j,
				  	"tgl_akhir" => $tglAkhir,
				  	"tgl_posted" => $jPosted,
					"category" => $k,
					"availableseat" => $seat,
					"quota" => $seat,
					"price" => $l,
					"hint" => 0,
				  	"added" => $m
				  ])
				  ->eksekusi();
		return $q;
	}
	public function my($id) {
		$q = $this->tabel("event")
				  ->pilih()
				  ->dimana(["idhotel" => $id, "id_resto" => 0])
				  ->eksekusi();
		if($this->hitung($q) == "") {
			return "kosong";
		}else {
			while($r = $this->ambil($q)) {
				$hasil[] = $r;
			}
			return $hasil;
		}
	}
	public function myForResto($id) {
		$q = $this->tabel("event")
				  ->pilih()
				  ->dimana(["id_resto" => $id])
				  ->eksekusi();
		if($this->hitung($q) == "") {
			return "kosong";
		}else {
			while($r = $this->ambil($q)) {
				$hasil[] = $r;
			}
			return $hasil;
		}
	}
	public function all($keyword = NULL, $tglMulai = NULL, $tglAkhir = NULL, $cat = NULL, $region = NULL) {
		date_default_timezone_set('Asia/Jakarta');
		$tglSkrg = date('Y-m-d');
		$tglMulaiDefault = date('Y-m-1');
		$tglAkhirDefault = date('Y-m-31');
		if($tglMulai == "" and $tglAkhir == "") {
			// lama $filterTgl = "tgl_mulai >= '$tglMulaiDefault' AND tgl_akhir <= '$tglAkhirDefault'";
			$filterTgl = "tgl_mulai >= '$tglMulaiDefault'";
		}else {
			if($tglMulai == "") {
				$tglMulai = $tglSkrg;
			}else if($tglAkhir == "") {
				$tglAkhir = '2025-12-31';
			}
			$filterTgl = "tgl_mulai >= '$tglMulai' AND tgl_akhir <= '$tglAkhir'";
		}
		// $sqlQuery = "SELECT * FROM event WHERE title LIKE '%$keyword%' AND category LIKE '%$cat%' AND $filterTgl ORDER BY added DESC";
		$sqlQuery = $this->query("SELECT * FROM event LEFT JOIN hotel ON event.idhotel = hotel.idhotel WHERE nama LIKE '%$keyword%' AND category LIKE '%$cat%' AND $filterTgl AND region LIKE '%$region%' ORDER BY event.added DESC");
		if($this->hitung($sqlQuery) == 0) {
			$sqlQuery = $this->query("SELECT * FROM event WHERE title LIKE '%$keyword%' AND category LIKE '%$cat%' AND $filterTgl ORDER BY event.added DESC");
		}
		if($this->hitung($sqlQuery) == 0) {
			return "null";
		}else {
			while($r = $this->ambil($sqlQuery)) {
				$hasil[] = $r;
			}
			return $hasil;
		}
	}
	public function delete($id) {
		$q = $this->tabel("event")->hapus()->dimana(["idevent" => $id])->eksekusi();
		$y = $this->tabel("booking")->hapus()->dimana(["idevent" => $id])->eksekusi();
		return $q;
	}
	public function ourEvent($id) {
		$q = $this->tabel("event")->pilih()->dimana(["idhotel" => $id])->eksekusi();
		if($this->hitung($q) == 0) {
			$q = $this->tabel("event")->pilih()->dimana(["id_resto" => $id])->eksekusi();
		}
		if($this->hitung($q) == 0) {
			return "null";
		}else {
			while($r = $this->ambil($q)) {
				$hasil[] = $r;
			}
			return $hasil;
		}
	}
	public function totMyEvent($id) {
		$q = $this->tabel("event")->pilih()->dimana(["idhotel" => $id])->eksekusi();
		return $this->hitung($q);
	}
	public function hint($idevent) {
		$q = $this->query("upDaTE event sET hint = hint + 1 wHERe idevent = '$idevent'");
		return $q;
	}
}

$event = new event();

?>