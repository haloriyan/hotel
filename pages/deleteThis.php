<?php

include 'aksi/ctrl/booking.php';

function getDisabledDate() {
	$booking = new booking();
	$cekDate = $booking->cekAvailable("18846");
	foreach($cekDate as $key => $value) {
		$res .= $value.",";
	}
	return $res;
}

echo "<input type='text' value='".getDisabledDate()."'>";

exit();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale = 1'>
	<title>deleteThis</title>
	<link href='aset/fw/build/fw.css' rel='stylesheet'>
	<link href='aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='aset/css/style.deleteThis.css' rel='stylesheet'>
</head>
<body>

<?php

function getRange() {
	$ctrl = new controller();
	$getAll = $ctrl->tabel("event")->pilih()->dimana(["idevent" => "18846"])->eksekusi();
	$r = $ctrl->ambil($getAll);
	$tglMulai = $r['tgl_mulai'];
	$tglAkhir = $r['tgl_akhir'];
	$rangeDate = new DatePeriod(
		new DateTime($tglMulai),
		new DateInterval('P1D'),
		new DateTime($tglAkhir)
	);

	foreach($rangeDate as $key => $value) {
		// echo "<li>".$value->format('Y-m-d')."</li>";
		$res[] = $value->format('Y-m-d');
	}
	return $res;
}

function getMaxQty($tgl) {
	$ctrl = new controller();
	$q = $ctrl->tabel("event")->pilih("quota")->dimana(["idevent" => "18846"])->eksekusi();
	$r = $ctrl->ambil($q);
	return $r['quota'];
}

function ngecek() {
	$ctrl = new controller();
	$disabledDate = [];
	foreach(getRange() as $key => $value) {
		$tgl = $value;
		$maxQty = getMaxQty($tgl);
		$q = $ctrl->query("SELECT SUM(qty) AS qty FROM booking WHERE tgl = '$tgl' AND idevent = '18846'a");
		$r = $ctrl->ambil($q);
		if($r['qty'] >= $maxQty) {
			array_push($disabledDate, $tgl);
		}
		// echo $r['qty']." ( ".$maxQty." ) <br />";
	}
	return $disabledDate;
}

foreach(ngecek() as $key => $value) {
	echo $value."<br />";
}

ngecek()

?>

<script src='aset/js/embo.js'></script>
<script src='aset/js/script.deleteThis.js'></script>

</body>
</html>