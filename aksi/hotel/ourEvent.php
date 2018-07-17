<?php
include '../ctrl/event.php';

$idhotel = $_COOKIE['idhotel'];
$idresto = $_COOKIE['idresto'];

if($idresto != "") {
	$idhotel = $idresto;
}

$load = $event->ourEvent($idhotel);
if($load == "null") {
	die("Tidak ada event");
}

foreach ($load as $row) {
	$iconHotel = $hotel->get($idhotel, "icon");
	$namaHotel = $hotel->get($idhotel, "nama");
	if($idresto != "") {
		// Pakai resto
		$iconHotel = $resto->info($idhotel, "icon");
		$namaHotel = $resto->info($idhotel, "nama");
	}else {
		// Pakai hotel
		$iconHotel = $hotel->get($idhotel, "icon");
		$namaHotel = $hotel->get($idhotel, "nama");
	}
	echo "<a href='../event/".$row['idevent']."'>".
			"<div class='list' id='loadedEvent'>".
				"<img src='../aset/gbr/".$row['cover']."'>".
				"<div class='ket'>".
					"<div class='wrap'>".
						"<div id='keterangan'>".
							"<h3>".$row['title']."</h3>".
							"<p><i class='fa fa-map-marker'></i> ".$row['address']."</p>".
						"</div>".
					"</div>".
					"<div id='hosted'>".
						"<div class='wrap'>".
							"<img src='../aset/gbr/".$iconHotel."' class='ke-kiri'>".
							"<div id='namaHotel'>Hosted by <b>".$namaHotel."</b></div>".
						"</div>".
					"</div>".
				"</div>".
			"</div>".
		 "</a>";
}

?>