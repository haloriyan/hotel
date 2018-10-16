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
	public function getDateRange($idevent) {
		$q = $this->tabel("event")->pilih()->dimana(["idevent" => $idevent])->eksekusi();
		$r = $this->ambil($q);
		$tglMulai = $r['tgl_mulai'];
		$tglAkhir = $r['tgl_akhir'];
		$rangeDate = new DatePeriod(
			new DateTime($tglMulai),
			new DateInterval('P1D'),
			new DateTime($tglAkhir)
		);

		foreach($rangeDate as $key => $value) {
			$res[] = $value->format('Y-m-d');
		}
		return $res;
	}
	public function create($a, $b, $idresto, $c, $d, $e, $g, $h, $i, $j, $tglAkhir, $jPosted, $k, $seat, $l, $m) {
		$q = $this->tabel("event")
				  ->tambah([
				  	"idevent" => $a,
					"idhotel" => $b,
					"id_resto" => $idresto,
				  	"title" => $c,
				  	"tagline" => $d,
				  	"description" => $e,
				  	"covers" => $g,
				  	"region" => $h,
				  	"alamat" => $i,
				  	"tgl_mulai" => $j,
				  	"tgl_akhir" => $tglAkhir,
				  	"tgl_posted" => $jPosted,
					"category" => $k,
					"quota" => $seat,
					"price" => $l,
					"status" => 1,
					"hint" => 0,
				  	"added" => $m
				  ])
				  ->eksekusi();
		return $q;
	}
	public function edit($id, $kolom, $value) {
		$q = $this->tabel('event')->ubah([$kolom => $value])->dimana(['idevent' => $id])->eksekusi();
		return $q;
	}
	public function my($id, $keyword = NULL, $category = NULL, $month = NULL) {
		$thn = date('Y');
		$tglFilter = $thn.'-'.$month;
		$q = $this->query("SELECT * FROM event WHERE idhotel = '$id' AND status = '1' AND id_resto = '0' AND title LIKE '%$keyword%' AND category LIKE '%$category%' AND tgl_mulai LIKE '%$tglFilter%'");
		if($this->hitung($q) == "") {
			return "kosong";
		}else {
			while($r = $this->ambil($q)) {
				$hasil[] = $r;
			}
			return $hasil;
		}
	}
	public function myForResto($id, $keyword = NULL, $category = NULL, $month = NULL) {
		$thn = date('Y');
		$tglFilter = $thn.'-'.$month;
		$q = $this->query("SELECT * FROM event WHERE id_resto = '$id' AND status = '1' AND title LIKE '%$keyword%' AND category LIKE '%$category%' AND tgl_mulai LIKE '%$tglFilter%'");
		if($this->hitung($q) == "") {
			return "kosong";
		}else {
			while($r = $this->ambil($q)) {
				$hasil[] = $r;
			}
			return $hasil;
		}
	}
	public function alls($keyword = NULL, $tglMulai = NULL, $tglAkhir = NULL, $cat = NULL, $region = NULL) {
		date_default_timezone_set('Asia/Jakarta');
		$query = "SELECT * FROM event LEFT JOIN hotel ON event.idhotel = hotel.idhotel WHERE nama LIKE '%$keyword%' AND category LIKE '%$cat%' AND $filterTgl region LIKE '%$region%' ORDER BY event.added DESC";
		return $query;
	}
	public function all($keyword = NULL, $tglMulai = NULL, $tglAkhir = NULL, $cat = NULL, $region = NULL) {
		date_default_timezone_set('Asia/Jakarta');
		$tglSkrg = date('Y-m-d');
		$tglMulaiDefault = date('Y-m-1');
		$tglAkhirDefault = date('2035-12-31');
		// basic query SELECT * FROM `event` WHERE tgl_akhir <= '2018-09-31' AND tgl_akhir >= '2018-09-02'
		if($tglMulai == "" and $tglAkhir == "") {
			// lama $filterTgl = "tgl_mulai >= '$tglMulaiDefault' AND tgl_akhir <= '$tglAkhirDefault'";
			$filterTgl = "tgl_akhir <= '$tglAkhirDefault' AND tgl_akhir >= '$tglSkrg'";
		}else {
			if($tglMulai == "") {
				$tglMulai = $tglSkrg;
			}else if($tglAkhir == "") {
				// $tglAkhir = '2105-12-31';
				$tglAkhir = date('Y-m-31');
			}
			$filterTgl = "tgl_akhir <= '$tglAkhir'";
		}
		// $sqlQuery = "SELECT * FROM event WHERE title LIKE '%$keyword%' AND category LIKE '%$cat%' AND $filterTgl ORDER BY added DESC";
		$sqlQuery = $this->query("SELECT * FROM event LEFT JOIN hotel ON event.idhotel = hotel.idhotel WHERE nama LIKE '%$keyword%' AND category LIKE '%$cat%' AND $filterTgl AND region LIKE '%$region%' ORDER BY event.added DESC");
		if($this->hitung($sqlQuery) == 0) {
			return 'kosong';
			$sqlQuery = $this->query("SELECT * FROM event WHERE title LIKE '%$keyword%' AND category LIKE '%$cat%' AND $filterTgl AND region LIKE '%$region%' ORDER BY event.added DESC");
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
		$q = $this->tabel("event")->ubah(['status' => 0])->dimana(["idevent" => $id])->eksekusi();
		$y = $this->tabel("booking")->ubah(['status' => 0])->dimana(["idevent" => $id])->eksekusi();
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
		$q = $this->query("UPDATE event SET hint = hint + 1 WHERE idevent = '$idevent'");
		return $q;
	}
}

$event = new event();

?>