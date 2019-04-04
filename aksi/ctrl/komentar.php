<?php
include 'booking.php';

class komentar extends booking {
	public function all($id) {
		$q = $this->tabel('komentar')->pilih()->dimana(['idevent' => $id])->urutkan('added', 'DESC')->eksekusi();
		if($this->hitung($q) == 0) {
			return "tiada";
		}else {
			while($r = $this->ambil($q)) {
				$res[] = $r;
			}
			return $res;
		}
	}
	public function store($id, $idevt, $idu, $koment) {
		$q = $this->tabel('komentar')
					->tambah([
						'idkomentar'	=> $id,
						'idevent'		=> $idevt,
						'iduser'		=> $idu,
						'komentar'		=> $koment,
						'added'			=> time()
					])
					->eksekusi();
	}
	public function delete($id) {
		$q = $this->tabel('komentar')->hapus()->dimana(['idkomentar' => $id])->eksekusi();
	}

	// reply
	public function reply($id, $reply) {
		$q = $this->tabel('komentar')->ubah(['reply' => $reply])->dimana(['idkomentar' => $id])->eksekusi();
	}
	public function deleteReply($id) {
		$q = $this->tabel('komentar')->ubah(['reply' => ''])->dimana(['idkomentar' => $id])->eksekusi();
	}
	public function tot($id) {
		$q = $this->tabel('komentar')->pilih()->dimana(['idevent' => $id])->eksekusi();
		return $this->hitung($q);
	}
}

$komen = new komentar();