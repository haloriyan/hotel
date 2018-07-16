<?php
include 'resto.php';

class galeri extends resto {
	public function add($a, $b, $c ,$d) {
		$q = $this->tabel("galeri")
				  ->tambah([
				  	"idgambar" => $a,
				  	"idhotel" => $b,
				  	"tipe" => $c,
				  	"gambar" => $d,
				  	"added" => time()
				  ])
				  ->eksekusi();
		return $q;
	}
	public function load($id, $tipe) {
		$q = $this->tabel("galeri")
				  ->pilih()
				  ->dimana([
				  	"idhotel" => $id,
				  	"tipe" => $tipe
				  ])->eksekusi();
		if($this->hitung($q) == 0) {
			return "null";
		}else {
			while($r = $this->ambil($q)) {
				$hasil[] = $r;
			}
			return $hasil;
		}
	}
	public function delete($id) {
		$q = $this->tabel("galeri")->hapus()->dimana(["idgambar" => $id])->eksekusi();
		return $q;
	}
	public function cek($id, $struktur) {
		$q = $this->tabel("galeri")->pilih()->dimana(["idgambar" => $id])->eksekusi();
		$r = $this->ambil($q);
		return $r[$struktur];
	}
}

$galeri = new galeri();

?>