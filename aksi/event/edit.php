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

$id 			= $_POST['idevent'];;
$title 			= $_POST['title'];
$tagline 		= $_POST['tagline'];
$description 	= $_POST['description'];
$cover 			= $_POST['cover'];
if($cover == '') {
	$cover = $event->info($id, 'covers');
}
$region 		= $_POST['region'];
$address 		= $_POST['address'];
$tgl 			= $_POST['tgl'];
$tgl_akhir		= $_POST['tgl_akhir'];
$category 		= $_POST['category'];
$quota          = $_POST['quota'];
$price 			= $_POST['price'];

$kolom = ['title','tagline','description','covers','region','alamat','tgl_mulai','tgl_akhir','category','quota','price'];
$isi = 	 [$title,$tagline,$description,$cover,$region,$address,$tgl,$tgl_akhir,$category,$quota,$price];

for ($i=0; $i < count($kolom); $i++) { 
	$event->edit($id, $kolom[$i], $isi[$i]);
}