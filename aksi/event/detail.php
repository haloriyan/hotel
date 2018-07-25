<?php
include '../ctrl/track.php';

$idevent = $_COOKIE['idevent'];
if(empty($idevent)) {
    die("Select event before see the details");
}

$title = $event->info($idevent, "title");
$covers = $event->info($idevent, "covers");

$totWA = $track->tot($idevent, "1");
$totCall = $track->tot($idevent, "2");

?>
<div class="ke-kiri" style="width: 49%;">
    <img src="../aset/gbr/<?php echo $covers; ?>" id="cover">
</div>
<div class="ke-kiri" id="detailnya">
    <li><div id="icon"><i class="fa fa-eye"></i></div> 2014</li>
    <li><div id="icon"><i class="fa fa-phone"></i></div> <?php echo $totCall; ?>x</li>
    <li><div id="icon"><i class="fa fa-whatsapp"></i></div> <?php echo $totWA; ?>x</li>
    <li><div id="icon"><i class="fa fa-money"></i></div> Rp 25.450.000 ( 25 seat )</li>
</div>