<?php
include '../ctrl/galeri.php';

session_start();
$sesiHotel = $_SESSION['uhotel'];
$sesiResto = $_SESSION['uresto'];

if($sesiHotel == "") {
    // nggawe resto
    $idhotel = $resto->info($sesiResto, "idhotel");
    $idresto = $resto->info($sesiResto, "idresto");
}else {
    // nggawe hotel
    $idhotel = $hotel->get($sesiHotel, "idhotel");
    $idresto = 0;
}

$id = rand(1, 999999);
$tipe = $_POST['tipe'];
$gambar = $_POST['gambar'];

$galeri->add($id, $idhotel, $tipe, $gambar);