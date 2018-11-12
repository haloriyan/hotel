<?php
include 'booking.php';

class redeem extends booking {
	public function my($idhotel, $status = NULL) {
		$q = $this->tabel("redeem")->pilih()->dimana(["idhotel" => $idhotel, "id_resto" => 0])->eksekusi();
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
	public function request($idhotel, $idresto, $idevent) {
		date_default_timezone_set('Asia/Jakarta');
		$q = $this->tabel("redeem")
				  ->tambah([
					  "idredeem" 	=> null,
					  "idhotel"	 	=> $idhotel,
					  "id_resto" 	=> $idresto,
					  "idevents" 	=> $idevent,
					  "tgl"			=> date('Y-m-d H:i:s'),
					  "status" 		=> 0,
					  "added" 		=> time()
				  ])->eksekusi();
		$ubah = $this->tabel("event")->ubah(["status" => 9])->dimana(["idevent" => $idevent])->eksekusi();
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