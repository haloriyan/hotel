<?php
include 'hotel.php';

class tokek extends hotel {
	public function contoh() {
		$q = $this->tabel('tokek')->tambah(['tokeks' => '123'])->eksekusi();
		return $q;
	}
}

$tokek = new tokek();