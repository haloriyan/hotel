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
	$priceFrom = $_POST['priceFrom'];
	$priceTo = $_POST['priceTo'];

	$activate = $_POST['activate'];

	$price = $priceFrom."|".$priceTo;

	if($_POST['icon'] == '') {
		$icon = $resto->info($sesi, 'icon');
	}
	if($_POST['cover'] == '') {
		$cover = $resto->info($sesi, 'cover');
	}

	$val = $phone.",".$address.",".$web.",".$city.",".$description.",".$icon.",".$cover.",".$coords.",".$price;
	$change = "phone,address,website,city,description,icon,cover,coords,price";

	$v = explode(",", $val);
	$c = explode(",", $change);
	for ($i=0; $i < count($c); $i++) { 
		$resto->change($idresto, $c[$i], $v[$i]);
	}
	if($activate == 1) {
		$resto->change($idresto, "status", 1);
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
}else if($bag == "serves") {
	$serve = $_POST['serve'];
	$myServe = $resto->info($sesi, "serve");
	$serv = explode(',', $myServe);

	if(in_array($serve, $serv)) {
		foreach ($serv as $key => $value) {
			if($serve == $serv[$key]) {
				unset($serv[$key]);
			}
			$baru = implode(",", $serve);
		}
	}else {
		if($myServe != "") {
			$baru = $myServe.",".$serve;
		}else {
			$baru = $serve;
		}
	}
	$resto->change($idresto, "serve", $baru);
}