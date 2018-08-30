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

$cek = $booking->cekAvailable("18846", '1');
foreach($cek as $key => $value) {
	echo $value.".<br />";
}

?>

<script src='aset/js/embo.js'></script>
<script src='aset/js/script.deleteThis.js'></script>

</body>
</html>