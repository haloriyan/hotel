<?php
include 'booking.php';

class redeem extends booking {
	public function my($idhotel) {
		$q = $this->tabel("redeem")->pilih()->dimana(["idhotel" => $idhotel, "id_resto" => 0, "status" => 0])->eksekusi();
		if($this->hitung($q) == 0) {
			return "null";
		}else {
			while($r = $this->ambil($q)) {
				$hasil[] = $r;
			}
			return $hasil;
		}
	}
	public function myForResto($id) {
		$q = $this->tabel("redeem")->pilih()->dimana(["id_resto" => $id])->eksekusi();
		if($this->hitung($q) == 0) {
			return "null";
		}else {
			while($r = $this->ambil($q)) {
				$hasil[] = $r;
			}
			return $hasil;
		}
	}
	public function request($id, $idResto, $saldo) {
		$q = $this->tabel("redeem")
				  ->tambah([
					  "idredeem" => rand(1, 999999),
					  "idhotel" => $id,
					  "id_resto" => $idResto,
					  "saldo" => $saldo,
					  "tgl" => date('Y-m-d H:i:s'),
					  "status" => 0,
					  "added" => time()
				  ])->eksekusi();
	}
	public function cancel($id) {
		// rung rampung
		$get = $this->tabel("redeem")->pilih()->dimana(["idredeem" => $id])->eksekusi();
		$r = $this->ambil($get);
		$saldo = $r['saldo'];
		$ubah = 
		$q = $this->tabel("redeem")->hapus()->dimana(["idredeem" => $id])->eksekusi();
		return $q;
	}

	// For Admin
	public function all($status) {
		$q = $this->tabel("redeem")->pilih()->dimana(["status" => $status])->eksekusi();
		if($this->hitung($q) == 0) {
			return "null";
		}else {
			while($r = $this->ambil($q)) {
				$hasil[] = $r;
			}
			return $hasil;
		}
	}
	public function cawang($id) {
		$q = $this->tabel("redeem")->ubah(["status" => 1])->dimana(["idredeem" => $id])->eksekusi();
		return $q;
	}
}

$redeem = new redeem();

?>