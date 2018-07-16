<?php
include 'aksi/ctrl/event.php';

date_default_timezone_set('Asia/Jakarta');
// echo date('Y-m-d H:i:s', time());
$tglStart = "2018-07-10";
$tglAkhir = "2018-07-14";

$tglSkrg = "2018-07-15";

if(($tglStart <= $tglSkrg) && ($tglSkrg <= $tglAkhir)) {
	echo "ada";
}else {
	echo "tiada";
}

$query = "SELECT * FROM event WHERE tgl_mulai <= '$tglSkrg' AND tgl_akhir => '$tglSkrg'";

echo $event->all("", "", "");