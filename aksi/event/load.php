<?php
include '../ctrl/event.php';

error_reporting(1);
$keyword = $_COOKIE['kwExplore'];

if($event->all($keyword) == "null") {
	echo "Tidak ada event";
	exit();
}

$tglMulai = $_COOKIE['tglMulai'];
$tglAkhir = $_COOKIE['tglAkhir'];
$category = $_COOKIE['category'];

foreach ($event->all($keyword, $tglMulai, $tglAkhir, $category) as $row) {
	$idhotel = $row['idhotel'];
	$idresto = $row['id_resto'];
	if($idresto != 0) {
		// Pakai resto
		$namaHotel = $resto->info($idresto, "nama");
		$iconHotel = $resto->info($idresto, "icon");
	}else {
		// Pakai hotel
		$namaHotel = $hotel->get($idhotel, "nama");
		$iconHotel = $hotel->get($idhotel, "icon");
	}
	echo "<a href='./event/".$row['idevent']."'>".
			 "<div class='list'>".
				"<img src='aset/gbr/".$row['cover']."'>".
				"<div class='ket'>".
					"<div class='wrap'>".
						"<div id='keterangan'>".
							"<h3>".$row['title']."</h3>".
							"<p><i class='fa fa-map-marker'></i> ".$row['address']."</p>".
						"</div>".
					"</div>".
					"<div id='hosted'>".
						"<div class='wrap'>".
							"<img src='aset/gbr/".$iconHotel."' class='ke-kiri'>",
							"<div id='namaHotel'>Hosted by <b>".$namaHotel."</b></div>".
						"</div>".
					"</div>".
				"</div>".
			 "</div>".
			"</a>";
}