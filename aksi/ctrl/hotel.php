<?php
include 'user.php';

class hotel extends user {
	public function get($id, $struktur) {
		$q = $this->tabel("hotel")
				  ->pilih()
				  ->dimana(["idhotel" => $id])
				  ->eksekusi();
		if($this->hitung($q) == 0) {
			$q = $this->tabel("hotel")
				  ->pilih()
				  ->dimana(["email" => $id])
				  ->eksekusi();
		}
		$r = $this->ambil($q);
		return $r[$struktur];
	}
	public function register($a, $b, $c, $d, $e) {
		$q = $this->tabel("hotel")
				  ->tambah([
				  	"idhotel" => $a,
				  	"nama" => $b,
				  	"email" => $c,
				  	"password" => $d,
				  	"icon" => "", "cover" => "", "phone" => "", "website" => "", "city" => "", "address" => "",
				  	"status" => 0,
				  	"added" => $e
				  ])
				  ->eksekusi();
		return $q;
	}
	public function login($e, $p) {
		$pw = $this->get($e, "password");
		if($p == $pw) {
			$status = $this->get($e, "status");
			if($status == 0) {
				setcookie('kukiLogin', 'You must verify your email address first!', time() + 40, "/");
			}else {
				session_start();
				$_SESSION['uhotel']=$e;
			}
		}else {
			setcookie('kukiLogin', 'Wrong email and/or password', time() + 40, "/");
		}
	}
	public function validate($e) {
		$idhotel = $this->get($e, "idhotel");
		$q = $this->tabel("hotel")
				  ->ubah(["status" => 2])
				  ->dimana(["idhotel" => $idhotel])
				  ->eksekusi();
		return $q;
	}
	public function sesi($log = NULL) {
		session_start();
		$sesi = $_SESSION['uhotel'];
		if($log != "") {
			if(empty($sesi)) {
				header("location: ../auth");
			}
		}
		return $sesi;
	}
	public function change($id, $struktur, $val) {
		$q = $this->tabel("hotel")
				  ->ubah([$struktur => $val])
				  ->dimana(["idhotel" => $id])
				  ->eksekusi();
		return $q;
	}

	public function infoFac($id, $struktur) {
		$q = $this->tabel("facility")->pilih()->dimana(["idfacility" => $id])->eksekusi();
		$r = $this->ambil($q);
		return $r[$struktur];
	}
	public function ourResto($id) {
		$q = $this->tabel("restoran")->pilih()->dimana(["idhotel" => $id])->eksekusi();
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

$hotel = new hotel();

?>