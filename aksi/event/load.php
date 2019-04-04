<?php
include '../ctrl/event.php';

error_reporting(1);

function convertTanggal($tgl) {
	$bln = ["01" => "January", "02" => "February" , "03" => "March", "04" => "April", "05" => "May", "06" => "June", "07" => "July", "08" => "August", "09" => "September", "10" => "October", "11" => "November", "12" => "December"];
	$t = explode("-", $tgl);
	return $bln[$t[1]]." ".$t[2].", ".$t[0];
}

$keyword = $_COOKIE['kwExplore'];

$bln = $_COOKIE['bulan'];
$thn = $_COOKIE['tahun'];

if($bln == "" || $thn == "") {
	$tglAkhir = "";
}else {
	$tglAkhir = $thn."-".$bln;
}
$category = $_COOKIE['category'];
$city   = $_COOKIE['region'];

$all = $event->all($keyword, $tglAkhir, $category, $city);

if($all == "kosong" || $all == "null") {
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
		$namaHosted = $resto->info($idresto, "nama");
		$iconHosted = $resto->info($idresto, "icon");
		$linkToHosted = "./resto/".$idresto;
	}else {
		// Pakai hotel
		$namaHosted = $hotel->get($idhotel, "nama");
		$iconHosted = $hotel->get($idhotel, "icon");
		$linkToHosted = "./hotel/".$idhotel;
	}
	$cover = $row['covers'];
	$coverImage = '"aset/gbr/'.$cover.'"';
	if(strlen($row['region']) > 35) {
		$alamat = substr($row['region'], 0, 35)."...";
	}else {
		$alamat = $row['region'];
	}
	if(strlen($row['title']) > 37) {
		$title = substr($row['title'], 0, 37)."...";
	}else {
		$title = $row['title'];
	}
	$tglMulai = convertTanggal($row['tgl_mulai']);
	echo "<div class='grid-item' style='height: 420px;'>".
			"<a href='./event/".$row['idevent']."'>".
				"<div class='beges' style='background: url(".$coverImage.");background-size: cover;'></div>".
				"<div class='ket'>".
					"<div class='wrap'>".
						"<h3>".$title."</h3>".
						"<p>".
							"<div class='bag bag-5'>".
								"<i class='fa fa-map-marker'></i> &nbsp; ".$alamat."".
							"</div>".
							"<div class='bag bag-5'>".
								"<i class='fa fa-calendar'></i> &nbsp; ".$tglMulai."".
							"</div>".
						"</p>".
					"</div>".
				"</div>".
			"</a>".
			"<a href='".$linkToHosted."'>".
				"<div class='hosted'>".
					"<div class='wrap'>".
						"<img src='aset/gbr/".$iconHosted."'>".
						"<div id='namaHotel'>".
							"Hosted by <b>".$namaHosted."</b>".
						"</div>".
					"</div>".
				"</div>".
			"</a>".
		 "</div>";
}