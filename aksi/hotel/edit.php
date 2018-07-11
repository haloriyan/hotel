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

	$val = $phone.",".$address.",".$web.",".$city;
	$change = "phone,address,website,city";

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
}