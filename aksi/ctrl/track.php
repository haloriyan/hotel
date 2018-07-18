<?php
include 'user.php';

class track extends user {
	public function hit($idevent, $iduser, $tipe) {
		$cek = $this->tabel("track")
					->pilih()
					->dimana([
						"idevent" => $idevent,
						"iduser" => $iduser,
						"tipe" => $tipe
					])->eksekusi();
		if($this->hitung($cek) != 0) {
			return "ada";
		}else {
			return "tiada";
		}
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
			$idtrack = rand(1, 999999999);
			$ins = $this->tabel("track")
						->tambah([
							"idtrack" => $idtrack,
							"idevent" => $idevent,
							"iduser"  => $iduser,
							"tipe"	  => $tipe,
							"hint"	  => 1,
							"last_tracked" => time(),
							"added"	  => time()
						])->eksekusi();
		}
	}
}

$track = new track();

?>