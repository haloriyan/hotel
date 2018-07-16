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

	$val = $phone.",".$address.",".$web.",".$city;
	$change = "phone,address,website,city";

	$v = explode(",", $val);
	$c = explode(",", $change);
	for ($i=0; $i < count($c); $i++) { 
		$resto->change($idresto, $c[$i], $v[$i]);
	}
}else if($bag == "image") {
	$icon = $_POST['icon'];
	$cover = $_POST['cover'];

	$resto->change($idresto, "icon", $icon);
	$resto->change($idresto, "cover", $cover);
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
}