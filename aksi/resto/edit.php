<?php
include '../ctrl/resto.php';

$sesi = $resto->sesi();
$idresto = $resto->info($sesi, "idresto");

$bag = $_POST['bag'];
if($bag == "detil") {
	$phone 		= $_POST['phone'];
	$address 	= $_POST['address'];
	$web 		= $_POST['web'];
	$city 		= $_POST['city'];
	$description	= $_POST['description'];
	$icon 		= $_POST['icon'];
	$cover 		= $_POST['cover'];
	$lat = $_POST['lat'];
	$lng = $_POST['lng'];
	$coords = $lat."|".$lng;

	if($_POST['icon'] == '') {
		$icon = $resto->info($sesi, 'icon');
	}
	if($_POST['cover'] == '') {
		$cover = $resto->info($sesi, 'cover');
	}

	$val = $phone.",".$address.",".$web.",".$city.",".$description.",".$icon.",".$cover.",".$coords;
	$change = "phone,address,website,city,description,icon,cover,coords";

	$v = explode(",", $val);
	$c = explode(",", $change);
	for ($i=0; $i < count($c); $i++) { 
		$resto->change($idresto, $c[$i], $v[$i]);
	}
}else if($bag == "facility") {
	$idfac = $_POST['idfac'];
	$myFac = $resto->info($sesi, "facility");
	$fac = explode(",", $myFac);
	if(in_array($idfac, $fac)) {
		foreach ($fac as $key => $value) {
			if($idfac == $fac[$key]) {
				unset($fac[$key]);
			}
			$baru = implode(",", $fac);
		}
	}else {
		if($myFac != "") {
			$baru = $myFac.",".$idfac;
		}else {
			$baru = $idfac;
		}
	}
	$resto->change($idresto, "facility", $baru);
}else if($bag == "cuisine") {
	$idcui = $_POST['idcui'];
	$myCui = $resto->info($sesi, 'cuisine');
	$cui = explode(',', $myCui);

	if(in_array($idcui, $cui)) {
		foreach ($cui as $key => $value) {
			if($idcui == $cui[$key]) {
				unset($cui[$key]);
			}
			$baru = implode(",", $cui);
		}
	}else {
		if($myCui != "") {
			$baru = $myCui.",".$idcui;
		}else {
			$baru = $idcui;
		}
	}
	$resto->change($idresto, "cuisine", $baru);
}