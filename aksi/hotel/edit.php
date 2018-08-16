<?php
include '../ctrl/hotel.php';

$sesi = $hotel->sesi();
$idhotel = $hotel->get($sesi, "idhotel");

$bag = $_POST['bag'];
if($bag == "detil") {
	$phone 		= $_POST['phone'];
	$address 	= $_POST['address'];
	$web 		= $_POST['web'];
	$city 		= $_POST['city'];
	$description	= $_POST['description'];

	$val = $phone.",".$address.",".$web.",".$city.",".$description;
	$change = "phone,address,website,city,description";

	$v = explode(",", $val);
	$c = explode(",", $change);
	for ($i=0; $i < count($c); $i++) { 
		$hotel->change($idhotel, $c[$i], $v[$i]);
	}
}else if($bag == "image") {
	$icon = $_POST['icon'];
	$cover = $_POST['cover'];

	$hotel->change($idhotel, "icon", $icon);
	$hotel->change($idhotel, "cover", $cover);
}else if($bag == "facility") {
	$idfac = $_POST['idfac'];
	$myFac = $hotel->get($sesi, "facility");
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
	$hotel->change($idhotel, "facility", $baru);
}
