<?php
include '../ctrl/redeem.php';

session_start();
$sesiHotel = $_SESSION['uhotel'];
$sesiResto = $_SESSION['uresto'];

if($sesiHotel == "" && $sesiResto == "") {
    header("location: ../hotel/login");
}

if($sesiHotel == "") {
	// nggawe resto
	$idhotel = $resto->info($sesiResto, "idresto");
    $myEvent = $event->myForResto($idhotel);
    $myRedeem = $redeem->myForResto($idhotel);
    $linkCta = "../resto/add-listing";
}else {
    // nggawe hotel
	$idhotel = $hotel->get($sesiHotel, "idhotel");
    $myEvent = $event->my($idhotel);
    $myRedeem = $redeem->my($idhotel);
    $linkCta = "../hotel/add-listing";
}

function toIdr($angka) {
	return 'Rp. '.strrev(implode('.', str_split(strrev(strval($angka)), 3)));
}

foreach($myEvent as $row) {
    $laku = $row['quota'] - $row['availableseat'];
    $saldo += $laku * $row['price'];
}

foreach($myRedeem as $red) {
    $saldoRedeem += $red['saldo'];
}

$mySaldo = $saldo - $saldoRedeem;

echo toIdr($mySaldo);