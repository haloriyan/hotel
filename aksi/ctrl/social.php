<?php
include 'event.php';

class social extends event {
	public function test() {
		return 'Hello embo!';
	}
	public function all($id, $akun = NULL) {
		if($akun == "restoran") {
			$account = "idresto";
		}else {
			$account = "idhotel";
		}
		$q = $this->tabel("social")
				  ->pilih()
				  ->dimana([$account => $id])
				  ->eksekusi();
		if($this->hitung($q) == 0) {
			return "null";
		}else {
			while($r = $this->ambil($q)) {
				$hasil[] = $r;
			}
			return $hasil;
		}
	}
	public function add($a, $b, $c, $d, $akun = NULL) {
		if($akun == "restoran") {
			$idresto = $b;
			$idhotel = resto::info($idresto, "idhotel");
		}else {
			$idresto = 0;
			$idhotel = $b;
		}
		$q = $this->tabel("social")
				  ->tambah([
				  	"idsocial" => $a,
				  	"idhotel" => $idhotel,
				  	"idresto" => $idresto,
				  	"type" => $c,
				  	"url" => $d
				  ])
				  ->eksekusi();
		return $q;
	}
	public function delete($id) {
		$q = $this->tabel("social")->hapus()->dimana(["idsocial" => $id])->eksekusi();
		return $q;
	}
}

$social = new social();

?>