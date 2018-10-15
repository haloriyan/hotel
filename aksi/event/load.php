<?php
include '../ctrl/event.php';

error_reporting(1);
$keyword = $_COOKIE['kwExplore'];

$tglMulai = $_COOKIE['tglMulai'];
$tglAkhir = $_COOKIE['tglAkhir'];
$category = $_COOKIE['category'];
$city   = $_COOKIE['region'];

$all = $event->all($keyword, $tglMulai, $tglAkhir, $category, $city);

if($all == "kosong") {
	if($keyword != "") {
		$resKw = "<b>".$keyword."</b>";
	}
	if($category != "") {
		$resNull = " for ".$category;
	}
	if($city != "") {
		$resCity = " in ".$city;
	}
	echo "No result ".$resKw.$resNull.$resCity."<br />";
	exit();
}

foreach ($all as $row) {
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
	$coverImage = "aset/gbr/".$row['covers'];
	echo "".
			 "<div class='list'>".
			 	"<div class='bgImage' style='background: url(".$coverImage.");background-size: cover;'>".
					// "<img src='aset/gbr/".$row['covers']."'>".
				"</div>".
				"<div class='ket'>".
					"<a href='./event/".$row['idevent']."'>".
					"<div class='wrap'>".
						"<div id='keterangan'>".
						"<div class='tgl'><i class='fa fa-calendar'></i> &nbsp; ".$row['tgl_mulai']."</div>".
							"<h3>".$row['title']."</h3>".
							"<p><i class='fa fa-map-marker'></i> &nbsp; ".$row['alamat']."</p>".
						"</div>".
					"</div>".
					"</a>".
					"<a href='./hotel/".$row['idhotel']."' target='_blank'>".
					"<div id='hosted'>".
						"<div class='wrap'>".
							"<img src='aset/gbr/swissBelinnIcon.jpg' class='ke-kiri'>",
							"<div id='namaHotel'>Hosted by <b>".$namaHotel."</b></div>".
						"</div>".
					"</div>".
					"</a>".
				"</div>".
			 "</div>".
			"";
}