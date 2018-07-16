<?php
include 'event.php';

class booking extends event {
	public function info($id, $struktur) {
		$q = $this->tabel("booking")->pilih()->dimana(["idbooking" => $id])->eksekusi();
		$r = $this->ambil($q);
		return $r[$struktur];
	}
}

$booking = new booking();

?>