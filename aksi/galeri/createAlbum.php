<?php
include '../ctrl/galeri.php';

session_start();
$sesiHotel = $_SESSION['uhotel'];
$sesiResto = $_SESSION['uresto'];

if($sesiResto != "") {
    // nggawe resto
    $idhotel = $resto->info($sesiResto, "idhotel");
    $idresto = $resto->info($sesiResto, "idresto");
}else {
    // nggawe hotel
    $idhotel = $hotel->get($sesiHotel, "idhotel");
    $idresto = 0;
}
$nama = $_POST['name'];

$galeri->create($idhotel, $idresto, $nama);