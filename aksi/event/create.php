<?php
include '../ctrl/event.php';

date_default_timezone_set('Asia/Jakarta');

session_start();
$sesiHotel = $_SESSION['uhotel'];
$sesiResto = $_SESSION['uresto'];

$pakaiAkun = $_COOKIE['pakaiAkun'];

if($pakaiAkun == "resto") {
    // nggawe resto
    $idhotel = $resto->info($sesiResto, "idhotel");
    $idresto = $resto->info($sesiResto, "idresto");
}else {
    // nggawe hotel
    $idhotel = $hotel->get($sesiHotel, "idhotel");
    $idresto = 0;
}

$id 			= null;
$title 			= $_POST['title'];
$tagline 		= $_POST['tagline'];
$description 	= $_POST['description'];
$cover 			= $_POST['cover'];
$region 		= $_POST['region'];
$address 		= $_POST['address'];
$tgl 			= $_POST['tgl'];
$tgl_akhir		= $_POST['tgl_akhir'];
$tgl_posted		= date('Y-m-d H:i:s');
$category 		= $_POST['category'];
$quota          = $_POST['quota'];
$price 			= $_POST['price'];
$added			= time();

$event->create($id, $idhotel, $idresto, $title, $tagline, $description, $cover, $region, $address, $tgl, $tgl_akhir, $tgl_posted, $category, $quota, $price, $added);