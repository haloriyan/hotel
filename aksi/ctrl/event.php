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
	public function create($a, $b, $idresto, $c, $d, $e, $f, $g, $h, $i, $j, $tglAkhir, $jPosted, $k, $l, $m) {
		$q = $this->tabel("event")
				  ->tambah([
				  	"idevent" => $a,
					"idhotel" => $b,
					"id_resto" => $idresto,
				  	"title" => $c,
				  	"tagline" => $d,
				  	"description" => $e,
				  	"logo" => $f,
				  	"cover" => $g,
				  	"region" => $h,
				  	"address" => $i,
				  	"tgl_mulai" => $j,
				  	"tgl_akhir" => $tglAkhir,
				  	"tgl_posted" => $jPosted,
				  	"category" => $k,
				  	"price" => $l,
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
	public function all($keyword = NULL, $tglMulai = NULL, $tglAkhir = NULL, $cat = NULL, $urut = NULL) {
		date_default_timezone_set('Asia/Jakarta');
		$tglSkrg = date('Y-m-d');
		$tglMulaiDefault = date('Y-m-1');
		$tglAkhirDefault = date('Y-m-30');
		if($tglMulai == "" and $tglAkhir == "") {
			$filterTgl = "tgl_mulai >= '$tglMulaiDefault' AND tgl_akhir <= '$tglAkhirDefault'";
		}else {
			if($tglMulai == "") {
				$tglMulai = $tglSkrg;
			}else if($tglAkhir == "") {
				$tglAkhir = $tglSkrg;
			}
			$filterTgl = "tgl_mulai >= '$tglMulai' AND tgl_akhir <= '$tglAkhir'";
		}
		$sqlQuery = "SELECT * FROM event WHERE title LIKE '%$keyword%' AND category LIKE '%$cat%' AND $filterTgl ORDER BY added DESC";
		$q = $this->query($sqlQuery);
		if($this->hitung($q) == 0) {
			return "null";
		}else {
			while($r = $this->ambil($q)) {
				$hasil[] = $r;
			}
			return $hasil;
		}
	}
	public function delete($id) {
		$q = $this->tabel("event")->hapus()->dimana(["idevent" => $id])->eksekusi();
		return $q;
	}
	public function ourEvent($id) {
		$q = $this->tabel("event")->pilih()->dimana(["idhotel" => $id])->eksekusi();
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

$event = new event();

?>