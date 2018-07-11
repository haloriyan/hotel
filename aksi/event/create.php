<?php
include '../ctrl/event.php';

date_default_timezone_set('Asia/Jakarta');

$id 			= rand(1, 999999);
$idhotel		= $hotel->get($hotel->sesi(), "idhotel");
$title 			= $_POST['title'];
$tagline 		= $_POST['tagline'];
$description 	= $_POST['description'];
$logo 			= $_POST['logo'];
$cover 			= $_POST['cover'];
$region 		= $_POST['region'];
$address 		= $_POST['address'];
$tgl 			= $_POST['tgl'];
$tgl_akhir		= $_POST['tgl_akhir'];
$tgl_posted		= date('Y-m-d H:i:s');
$category 		= $_POST['category'];
$price 			= $_POST['price'];
$added			= time();

$event->create($id, $idhotel, $title, $tagline, $description, $logo, $cover, $region, $address, $tgl, $tgl_akhir, $tgl_posted, $category, $price, $added);