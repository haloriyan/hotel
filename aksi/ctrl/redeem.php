<?php
include 'booking.php';

class redeem extends booking {
	public function my($idhotel) {
		$q = $this->tabel("redeem")->pilih()->dimana(["idhotel" => $idhotel, "status" => 0])->eksekusi();
		if($this->hitung($q) == 0) {
			return "null";
		}else {
			while($r = $this->ambil($q)) {
				$hasil[] = $r;
			}
			return $hasil;
		}
	}
	public function request($id, $saldo) {
		$q = $this->tabel("redeem")
				  ->tambah([
					  "idredeem" => rand(1, 999999),
					  "idhotel" => $id,
					  "saldo" => $saldo,
					  "tgl" => date('Y-m-d H:i:s'),
					  "status" => 0,
					  "added" => time()
				  ])->eksekusi();
	}
	public function cancel($id) {
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
}

$redeem = new redeem();

?>