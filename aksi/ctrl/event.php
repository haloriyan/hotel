<?php
include 'hotel.php';

class event extends hotel {
	public function info($id, $struktur) {
		$q = $this->tabel("event")
				  ->pilih()
				  ->dimana(["idevent" => $id])
				  ->eksekusi();
		$r = $this->ambil($q);
		return $r[$struktur];
	}
	public function create($a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $tglAkhir, $jPosted, $k, $l, $m) {
		$q = $this->tabel("event")
				  ->tambah([
				  	"idevent" => $a,
				  	"idhotel" => $b,
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
				  ->dimana(["idhotel" => $id])
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
	public function all($keyword = NULL) {
		if($keyword == "") {
			$q = $this->tabel("event")
					  ->pilih()
					  ->urutkan("added", "DESC")
					  ->eksekusi();
		}else {
			$q = $this->tabel("event")
					  ->pilih()
					  ->dimana(["title" => $keyword], "like")
					  ->eksekusi();
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