<?php
include '../ctrl/booking.php';

$idevent = $_COOKIE['idevents'];
$tgl     = $_COOKIE['tglevent'];

$count = $booking->countQtyFromTgl($idevent, $tgl);
$quota = $event->info($idevent, "quota");

$till = $quota - $count;

?>
<div class="isi">Quantity</div>
<select class="box" id="qty">
	<?php
    $qty = $till;
	if($qty >= 10) {
		$till = 10;
	}
	for($i = 1; $i <= $till; $i++) {
		echo "<option>".$i."</option>";
	}
	?>
</select>