<?php
include 'hotel.php';

class resto extends hotel {
	public function info($id, $struktur) {
		$q = $this->tabel("restoran")
				  ->pilih()
				  ->dimana(["idresto" => $id])
				  ->eksekusi();
		if($this->hitung($q) == 0) {
			$q = $this->tabel("restoran")
					  ->pilih()
					  ->dimana(["email" => $id])
					  ->eksekusi();
		}
		$r = $this->ambil($q);
		return $r[$struktur];
	}
	public function add($a, $b, $c, $d) {
		$q = $this->tabel("restoran")
				  ->tambah([
				  	"idresto" => $a,
				  	"idhotel" => $b,
				  	"nama" => $c,
				  	"added" => $d
				  ])
				  ->eksekusi();
		return $q;
	}
	public function myResto($id) {
		$q = $this->tabel("restoran")
				  ->pilih()
				  ->dimana(["idhotel" => $id])
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
	public function delete($id) {
		$q = $this->tabel("restoran")->hapus()->dimana(["idresto" => $id])->eksekusi();
		return $q;
	}
	public function login($id) {
		session_start();
		$cek = $this->query("SELECT * FROM restoran WHERE idresto = '$id' OR nama = '$id'");
		if($cek != 0) {
			if(!is_numeric($id)) {
				$sesiHotel = $_SESSION['uhotel'];
				$idhotel = $this->get($sesiHotel, "idhotel");
				$getId = $this->query("SELECT idresto FROM restoran WHERE nama = '$id' AND idhotel = '$idhotel'");
				$r = $this->ambil($getId);
				$idresto = $r['idresto'];
				$_SESSION['uresto']=$idresto;
			}else {
				$_SESSION['uresto']=$id;
			}
		}else {
			die("error 403");
		}
	}
	public function sesi() {
		session_start();
		$sesi = $_SESSION['uresto'];
		if(empty($sesi)) {
			header("location: ../hotel/restaurant");
		}
		return $sesi;
	}
	public function change($id, $struktur, $value) {
		$q = $this->tabel("restoran")
					->ubah([$struktur => $value])
					->dimana(["idresto" => $id])
					->eksekusi();
		return $q;
	}

	public function infoFac($id, $struktur) {
		$q = $this->tabel("facility")->pilih()->dimana(["idfacility" => $id])->eksekusi();
		$r = $this->ambil($q);
		return $r[$struktur];
	}
	public function infoCui($id, $struktur) {
		$q = $this->tabel('cuisine')->pilih($struktur)->dimana(['idcuisine' => $id])->eksekusi();
		$r = $this->ambil($q);
		return $r[$struktur];
	}
	public function totMyResto($id) {
		$q = $this->tabel("restoran")->pilih()->dimana(["idhotel" => $id])->eksekusi();
		return $this->hitung($q);
	}
}

$resto = new resto();

?>