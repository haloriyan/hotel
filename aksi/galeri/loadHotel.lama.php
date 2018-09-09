<?php
include '../ctrl/galeri.php';

// $idhotel = $hotel->get($hotel->sesi(), "idhotel");

session_start();
$sesiHotel = $_SESSION['uhotel'];
$sesiResto = $_SESSION['uresto'];

if($sesiResto != "") {
    // nggawe resto
    // $idhotel = $resto->info($sesiResto, "idhotel");
	$idhotel = $resto->info($sesiResto, "idresto");
	$tipe = "resto";
}else {
    // nggawe hotel
    $idhotel = $hotel->get($sesiHotel, "idhotel");
	$idresto = 0;
	$tipe = "hotel";
}

$load = $galeri->load($idhotel, $tipe);

if($load == "null") {
	echo "<h3>No any image available</h3>";
}

foreach ($load as $row) {
	echo "<div class='galeri'>".
			"<img src='../aset/gbr/".$row['gambar']."'>".
			"<li onclick='hapus(this.value)' value='".$row['idgambar']."'><i class='fa fa-trash'></i></li>".
		 "</div>";
}