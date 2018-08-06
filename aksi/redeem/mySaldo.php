<?php
include '../ctrl/redeem.php';

$sesi = $hotel->sesi();
$idhotel = $hotel->get($sesi, "idhotel");
$myEvent = $event->my($idhotel);
$myRedeem = $redeem->my($idhotel);

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