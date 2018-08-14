<?php
include '../ctrl/redeem.php';

$idhotel = $hotel->get($hotel->sesi(), "idhotel");

session_start();
$sesiHotel = $_SESSION['uhotel'];
$sesiResto = $_SESSION['uresto'];

if($sesiHotel == "") {
	// nggawe resto
	$idResto = $resto->info($sesiResto, "idresto");
    $myEvent = $event->myForResto($myId);
}else {
    // nggawe hotel
	$idhotel = $hotel->get($sesiHotel, "idhotel");
    $myEvent = $event->my($myId);
}
$saldo = $_POST['saldo'];

$redeem->request($idhotel, $idResto, $saldo);