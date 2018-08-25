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
	/*
	login resto lama
	public function login($e, $p) {
		$em = $this->info($e, "email");
		$pw = $this->info($e, "password");
		if($e == $em and $p == $pw) {
			session_start();
			$_SESSION['uresto']=$e;
		}else {
			setcookie('loginResto', 'Email and/or Password wrong!', time() + 35, "/");
		}
	}
	*/
	public function login($id) {
		session_start();
		$cek = $this->query("SELECT * FROM restoran WHERE idresto = '$id' OR nama = '$id'");
		if($cek != 0) {
			$_SESSION['uresto']=$id;
			unset($_SESSION['uhotel']);
		}else {
			die("error 403");
		}
	}
	public function sesi() {
		session_start();
		$sesi = $_SESSION['uresto'];
		if(empty($sesi)) {
			header("location: ../resto/login");
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
	public function totMyResto($id) {
		$q = $this->tabel("restoran")->pilih()->dimana(["idhotel" => $id])->eksekusi();
		return $this->hitung($q);
	}
}

$resto = new resto();

?>