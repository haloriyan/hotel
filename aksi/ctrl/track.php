<?php
include 'booking.php';

class track extends booking {
	public function hit($idevent, $iduser, $tipe) {
		$cek = $this->query("SELECT * FROM track WHERE idevent = '$idevent' AND iduser = '$iduser' AND tipe = '$tipe'");
		if($this->hitung($cek) != 0) {
			// pernah
			$r = $this->ambil($cek);
			$hint = $r['hint'] + 1;
			$ubah = $this->tabel("track")
						 ->ubah([
						 	"hint" => $hint,
						 	"last_tracked" => time()
						 ])
						 ->dimana([
						 	"idtrack" => $r['idtrack']
						 ])->eksekusi();
		}else {
			// ga pernah
			$ins = $this->tabel("track")
						->tambah([
							"idtrack" => null,
							"idevent" => $idevent,
							"iduser"  => $iduser,
							"tipe"	  => $tipe,
							"hint"	  => 1,
							"last_tracked" => time(),
							"added"	  => time()
						])->eksekusi();
		}
	}
	public function tot($idevent, $tipe) {
		$q = $this->query("SELECT SUM(hint) AS valHint FROM track WHERE idevent = '$idevent' AND tipe = '$tipe'");
		$r = $this->ambil($q);
		if($r['valHint'] == "") {
			return "0";
		}else {
			return $r['valHint'];
		}
	}
}

$track = new track();

?>