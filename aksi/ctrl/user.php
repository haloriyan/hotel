<?php
include 'controller.php';

class user extends controller {
	public function info($e, $struktur) {
		$q = $this->tabel("user")
				  ->pilih()
				  ->dimana(["iduser" => $e])
				  ->eksekusi();
		if($this->hitung($q) == 0) {
			$q = $this->tabel("user")
				  ->pilih()
				  ->dimana(["email" => $e])
				  ->eksekusi();
		}
		$r = $this->ambil($q);
		return $r[$struktur];
	}
	public function login($e, $p) {
		$pwd = $this->info($e, "password");
		if($p == $pwd) {
			$status = $this->info($e, "status");
			if($status == 0) {
				setcookie('kukiLogin', 'You must verify your email address first!', time() + 45, "/");
			}else {
				session_start();
				$_SESSION['upublic']=$e;
				setcookie('kukiLogin', '', 1, "/");
			}
		}else {
			setcookie('kukiLogin', 'Wrong email and/or password!', time() + 45, "/");
		}
	}
	public function sesi($opt = NULL) {
		session_start();
		$sesi = $_SESSION['upublic'];
		if($opt != "") {
			if(empty($sesi)) {
				header("location: ./");
			}
		}
		return $_SESSION['upublic'];
	}
	public function register($a, $b, $c, $d, $e) {
		$q = $this->tabel("user")
				  ->tambah([
				  	"iduser" => $a,
				  	"email" => $b,
				  	"password" => $c,
				  	"nama" => $d,
				  	"telepon" => "", "alamat" => "", "status" => "0",
				  	"registered" => $e
				  ])
				  ->eksekusi();
		return $q;
	}
	public function validate($e) {
		$iduser = $this->info($e, "iduser");
		$q = $this->tabel("user")
				  ->ubah(["status" => 1])
				  ->dimana(["iduser" => $iduser])
				  ->eksekusi();
	}
	public function ganti($id, $kolom, $value) {
		$q = $this->tabel("user")->ubah([$kolom => $value])->dimana(["iduser" => $id])->eksekusi();
		return $q;
	}

	// LISTING EVENT
	public function myList($id, $status = NULL) {
		$q = $this->query("SELECT * FROM booking WHERE iduser = '$id' AND status LIKE '%$status%'");
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

$user = new user();

?>