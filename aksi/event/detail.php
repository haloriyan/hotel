<?php
error_reporting(1);
include '../ctrl/track.php';

$idevent = $_COOKIE['idevent'];
if(empty($idevent)) {
    die("Select event before see the details");
}

function toIdr($angka) {
	return 'Rp. '.strrev(implode('.', str_split(strrev(strval($angka)), 3)));
}

// Detail event
$title = $event->info($idevent, "title");
$covers = $event->info($idevent, "covers");
$availSeat = $event->info($idevent, "availableseat");
$price = $event->info($idevent, "price");
$hint = $event->info($idevent, "hint");

$totWA = $track->tot($idevent, "1");
$totCall = $track->tot($idevent, "2");

// Ngitung Price
foreach($booking->allBook($idevent) as $row) {
    $laku += $row['qty'];
}

$priceLaku = $laku * $price;

?>
<div class="ke-kiri" style="width: 49%;">
    <img src="../aset/gbr/<?php echo $covers; ?>" id="cover">
</div>
<div class="ke-kiri" id="detailnya">
    <li><div id="icon"><i class="fa fa-eye"></i></div> <?php echo $hint; ?> x</li>
    <li><div id="icon"><i class="fa fa-phone"></i></div> <?php echo $totCall; ?>x</li>
    <li><div id="icon"><i class="fa fa-whatsapp"></i></div> <?php echo $totWA; ?>x</li>
    <li><div id="icon"><i class="fa fa-money"></i></div> <?php echo toIdr($priceLaku); ?> ( <?php echo $laku; ?> seat )</li>
</div>