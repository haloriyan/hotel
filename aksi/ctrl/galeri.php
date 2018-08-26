<?php
include 'resto.php';

class galeri extends resto {
	public function add($a, $idAlbum, $b, $c ,$d) {
		$q = $this->tabel("galeri")
				  ->tambah([
					"idgambar" => $a,
					"idalbums" => $idAlbum,
				  	"idhotel" => $b,
				  	"tipe" => $c,
				  	"gambar" => $d,
				  	"added" => time()
				  ])
				  ->eksekusi();
		return $q;
	}
	public function load($id) {
		$q = $this->query("SELECT * FROM galeri INNER JOIN album WHERE idalbums = '$id'");
		if($this->hitung($q) == 0) {
			return "null";
		}else {
			while($r = $this->ambil($q)) {
				$hasil[] = $r;
			}
			return $hasil;
		}
	}
	public function loadFromAlbum($id) {
		$q = $this->tabel("galeri")->pilih()->dimana(["idalbums" => $id])->eksekusi();
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

	// Urusan Album
	public function infoAlbum($id, $kolom) {
		$q = $this->tabel("album")
				  ->pilih($kolom)
				  ->dimana(["idalbum" => $id])
				  ->eksekusi();
		$r = $this->ambil($q);
		return $r[$kolom];
	}
	public function create($idHotel, $idResto, $nama) {
		$q = $this->tabel("album")
				  ->tambah([
					  "idalbum" => rand(1, 99999),
					  "idhotel" => $idHotel,
					  "id_resto" => $idResto,
					  "nama" => $nama,
					  "created" => time()
				  ])->eksekusi();
		return $q;
	}
	public function deleteAlbum($id) {
		$q = $this->tabel("album")
				  ->hapus()
				  ->dimana(["idalbum" => $id])
				  ->eksekusi();
		$del = $this->tabel("galeri")
					->hapus()
					->dimana(["idalbums" => $id])
					->eksekusi();
		return $q;
	}
	public function myAlbum($id, $tipe) {
		if($tipe == "hotel") {
			$where = ["idhotel" => $id,"id_resto" => 0];
		}else {
			$where = ["id_resto" => $id];
		}
		$q = $this->tabel("album")
				  ->pilih()
				  ->dimana($where)
				  ->eksekusi();
		if($this->hitung($q) == 0) {
			echo "You dont have any album";
		}else {
			while($r = $this->ambil($q)) {
				$hasil[] = $r;
			}
			return $hasil;
		}
	}
}

$galeri = new galeri();

?>