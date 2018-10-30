<?php
include 'controller.php';

class admin extends controller {
	public function get($id, $struktur) {
		$q = $this->tabel("admin")
				  ->pilih()
				  ->dimana(["idadmin" => $id])
				  ->eksekusi();
		if($this->hitung($q) == 0) {
			$q = $this->tabel("admin")
				  ->pilih()
				  ->dimana(["username" => $id])
				  ->eksekusi();
		}
		$r = $this->ambil($q);
		return $r[$struktur];
		// return $q;
	}
	public function login($e, $p) {
		$pw = $this->get($e, "password");
		if($p == $pw) {
			session_start();
			$_SESSION['uadmin']=$e;
			setcookie('loginAdmin', 'bener', time() + 40, "/");
		}else {
			setcookie('loginAdmin', 'Wrong username and/or password', time() + 4, "/");
		}
	}
	public function sesi() {
		session_start();
		$sesi = $_SESSION['uadmin'];
		if(empty($sesi)) {
			header("location: ../admin/login");
		}
		return $sesi;
	}
	public function change($id, $struktur, $val) {
		$q = $this->tabel("admin")
				  ->ubah([$struktur => $val])
				  ->dimana(["idadmin" => $id])
				  ->eksekusi();
		return $q;
	}
	public function all() {
		$q = $this->query("SELECT * FROM hotel WHERE status = '2' AND phone != '' AND city != ''");
		while($r = $this->ambil($q)) {
			$hasil[] = $r;
		}
		return $hasil;
	}
// Add Admin

	public function addadmin() {
		$p = $this->query("SELECT * FROM admin");
		while($t = $this->ambil($p)) {
			$hasil[] = $t;
		}
		return $hasil;
	}
	public function add($a, $b, $c, $d) {
	  $q = $this->tabel("admin")
	  			->tambah([
	  				"idadmin" => $a,
	  				"username" => $b,
	  				"password" => $c,
	  				"added" => $d
	  			])
	  			->eksekusi();
	  return $q;
	}
	public function delete($id) {
		$q = $this->tabel("admin")
				  ->hapus()
				  ->dimana(["idadmin" => $id])
				  ->eksekusi();
		return $q;
	}
	public function cawang($id) {
		$q = $this->tabel("hotel")
				  ->ubah(["status" => 1])
				  ->dimana(["idhotel" => $id])
				  ->eksekusi();
		return $q;
	}
//Delete Events

	public function event() {
		$p = $this->query("SELECT * FROM event");
		while($t = $this->ambil($p)) {
			$hasil[] = $t;
		}
		return $hasil;
	}
public function deleteevent($id) {
	$q = $this->tabel("event")
				->hapus()
				->dimana(["idevent" => $id])
				->eksekusi();
	return $q;
}
}

$admin = new admin();
?>
