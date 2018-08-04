<?php
include 'event.php';

class social extends event {
	public function test() {
		return 'Hello embo!';
	}
	public function all($id) {
		$q = $this->tabel("social")
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
	public function add($a, $b, $c, $d) {
		$q = $this->tabel("social")
				  ->tambah([
				  	"idsocial" => $a,
				  	"idhotel" => $b,
				  	"type" => $c,
				  	"url" => $d
				  ])
				  ->eksekusi();
		return $q;
	}
	public function delete($id) {
		$q = $this->tabel("social")->hapus()->dimana(["idsocial" => $id])->eksekusi();
		return $q;
	}
}

$social = new social();

?>