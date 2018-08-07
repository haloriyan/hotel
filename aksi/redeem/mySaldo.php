<?php
include '../ctrl/redeem.php';

$sesi = $hotel->sesi();
$idhotel = $hotel->get($sesi, "idhotel");
$myEvent = $event->my($idhotel);
$myRedeem = $redeem->my($idhotel);

function toIdr($angka) {
	return 'Rp. '.strrev(implode('.', str_split(strrev(strval($angka)), 3)));
}

/* saldo lama
foreach($myEvent as $row) {
    $laku = $row['quota'] - $row['availableseat'];
    $saldo += $laku * $row['price'];
}

foreach($myRedeem as $red) {
    $saldoRedeem += $red['saldo'];
}

$mySaldo = $saldo - $saldoRedeem;
*/

$get = $ctrl->query("SELECT * FROM booking LEFT JOIN event ON idhotel = '$idhotel'");
while($row = $ctrl->ambil($get)) {
    $mySaldo += $row['qty'] * $row['price'];
}

echo toIdr($mySaldo);