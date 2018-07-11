<?php
include '../ctrl/galeri.php';

$idhotel = $hotel->get($hotel->sesi(), "idhotel");
$load = $galeri->load($idhotel, "hotel");

if($load == "null") {
	die("ya");
}

foreach ($load as $row) {
	echo "<div class='galeri'>".
			"<img src='../aset/gbr/".$row['gambar']."'>".
			"<li onclick='hapus(this.value)' value='".$row['idgambar']."'><i class='fa fa-trash'></i></li>".
		 "</div>";
}