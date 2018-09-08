<?php
include 'event.php';

/*
	* Catatan :
	* status 9 adalah permintaan refund
	* status 8 adalah refund confirmed
*/

class booking extends event {
	public function info($id, $struktur) {
		$q = $this->tabel("booking")->pilih($struktur)->dimana(["idbooking" => $id])->eksekusi();
		$r = $this->ambil($q);
		return $r[$struktur];
	}
	public function book($a, $b, $c, $nama, $d, $e) {
		$q = $this->tabel("booking")
				  ->tambah([
				  	"idbooking" => $a,
				  	"idevent" => $b,
					"iduser" => $c,
					"nama" => $nama,
				  	"qty" => $d,
				  	"status" => 0,
				  	"tgl" => $e,
				  	"tgl_book" => date('Y-m-d H:i:s'),
				  	"added" => time()
				  ])->eksekusi();
		return $q;
	}
	public function tolak($id) {
		$q = $this->tabel("booking")
				  ->ubah([
				  	"status" => 0,
				  	"bukti" => ""
				  ])
				  ->dimana(["idbooking" => $id])
				  ->eksekusi();
		return $q;
	}
	public function delete($id) {
		$q = $this->tabel("booking")->hapus()->dimana(["idbooking" => $id])->eksekusi();
		return $q;
	}
	public function cek($idevent, $iduser) {
		$q = $this->query("SELECT * FROM booking WHERE idevent = '$idevent' AND iduser = '$iduser' AND status != '9' AND status != '8'");
		if($this->hitung($q) != 0) {
			return "ada";
		}else {
			return "tiada";
		}
	}
	public function myBooking($iduser) {
		$q = $this->query("SELECT * FROM booking WHERE iduser = '$iduser' AND status != '9' AND status != '8'");
		if($this->hitung($q) == 0) {
			return "null";
		}else {
			while($r = $this->ambil($q)) {
				$hasil[] = $r;
			}
			return $hasil;
		}
	}

	public function guest($idevent, $hadir, $nama) {
		if($hadir == "") {
			$hadir = 0;
		}
		$q = $this->query("SELECT * FROM booking WHERE nama LIKE '%$nama%' AND idevent = '$idevent' AND hadir = '$hadir' AND status != '9' AND status != '8' ORDER BY nama ASC");
		if($this->hitung($q) == 0) {
			return "null";
		}else {
			while($r = $this->ambil($q)) {
				$hasil[] = $r;
			}
			return $hasil;
		}
	}

	public function allBook($idevent) {
		$q = $this->query("SELECT * FROM booking WHERE idevent = '$idevent' AND status = '1'");
		if($this->hitung($q) == 0) {
			return "null";
		}else {
			while($r = $this->ambil($q)) {
				$hasil[] = $r;
			}
			return $hasil;
		}
	}

	public function getDateRange($idevent) {
		$q = $this->tabel("event")->pilih()->dimana(["idevent" => $idevent])->eksekusi();
		$r = $this->ambil($q);
		$tglMulai = $r['tgl_mulai'];
		$tglAkhir = $r['tgl_akhir'];
		$rangeDate = new DatePeriod(
			new DateTime($tglMulai),
			new DateInterval('P1D'),
			new DateTime($tglAkhir)
		);
 		foreach($rangeDate as $key => $value) {
			$res[] = $value->format('Y-m-d');
		}
		return $res;
	}
	public function cekAvailable($idevent, $opt = NULL) {
		$event = new event();
		$disabledDate = [];
		$maxQty = $event->info($idevent, "quota");
		foreach($this->getDateRange($idevent) as $key => $tgl) {
			$sumQty = $this->query("SELECT SUM(qty) AS qty FROM booking WHERE tgl = '$tgl' AND idevent = '$idevent'");
			$r = $this->ambil($sumQty);
			$rQty[] = $r['qty'] - $maxQty;
			if($r['qty'] >= $maxQty) {
				array_push($disabledDate, $tgl);
			}
		}
		if($opt == "") {
			return $disabledDate;
		}else {
			return $rQty;
		}
	}

	// Payment
	public function confirm($id, $bukti) {
		$q = $this->tabel("booking")
				  ->ubah([
					  "bukti" => $bukti
				  ])
				  ->dimana([
					  "idbooking" => $id
				  ])->eksekusi();
	}

	// For Admin
	public function all() {
		$q = $this->query("SELECT * FROM booking WHERE bukti != '' AND status = 0 ORDER BY tgl_book DESC");
		if($this->hitung($q) == 0) {
			return "null";
		}else {
			while($r = $this->ambil($q)) {
				$hasil[] = $r;
			}
			return $hasil;
		}
	}
	public function refundReq($status = NULL) {
		if($status == NULL) {
			$status = 9;
		}
		$q = $this->query("SELECT * FROM booking WHERE status = '$status'");
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
		$q = $this->tabel("booking")->ubah(["status" => 1])->dimana(["idbooking" => $id])->eksekusi();
		return $q;
	}

	public function hadir($id) {
		$q = $this->tabel("booking")->ubah(["hadir" => 1])->dimana(["idbooking" => $id])->eksekusi();
		return $q;
	}

	public function redeemable($id, $tipe) {
		if($tipe == "resto") {
			$tipes = "event.id_resto = '$id'";
		}else {
			$tipes = "event.idhotel = '$id'";
		}
		date_default_timezone_set('Asia/Jakarta');
		$tglSkrg = date('Y-m-d');
		$q = $this->query("SELECT * FROM event WHERE $tipes AND status != '9' AND tgl_akhir < '$tglSkrg'");
		if($this->hitung($q) == 0) {
			return "null";
		}else {
			while($r = $this->ambil($q)) {
				$hasil[] = $r;
			}
			return $hasil;
		}
	}
	public function countQty($id) {
		$q = $this->query("SELECT SUM(qty) AS countQty FROM booking WHERE idevent = '$id' AND status = '1'");
		$r = $this->ambil($q);
		return $r['countQty'];
	}
	public function countQtyFromTgl($id, $tgl) {
		$event = new event();
		$q = $this->query("SELECT SUM(qty) AS countQty FROM booking WHERE idevent = '$id' AND tgl = '$tgl'");
		$r = $this->ambil($q);
		if($r['countQty'] == "") {
			return 0;
		}else {
			return $r['countQty'];
		}
	}
}

$booking = new booking();

if($booking->tolak("312544")) 
	echo "berhasil";
else 
	echo "gagal";

?>
