<?php
include '../ctrl/redeem.php';

function toIdr($angka) {
	return 'Rp. '.strrev(implode('.', str_split(strrev(strval($angka)), 3)));
}

session_start();
$sesiHotel = $_SESSION['uhotel'];
$sesiResto = $_SESSION['uresto'];

if($sesiHotel == "") {
    // nggawe resto
    $idresto = $resto->info($sesiResto, "idresto");
    $load = $booking->redeemable($idresto, "resto");
}else {
    // nggawe hotel
    $idhotel = $hotel->get($sesiHotel, "idhotel");
    $load = $booking->redeemable($idhotel, "hotel");
}

if($load == "null") {
    echo "You dont have redeemable event";
    exit();
}else {
    foreach($load as $row) {
        $idevent = $row['idevent'];
        $qty = $booking->countQty($idevent);
        $price = $row['price'];
        $fixedPrice = $qty * $price;
        echo "<div class='myList'>".
                "<img src='../aset/gbr/".$row['covers']."'>".
                "<div class='wrap'>".
                    "<h3>".$row['title']."</h3>".
                    "<p><i class='fa fa-money'></i> &nbsp; ".toIdr($fixedPrice)."</p>".
                    "<button class='tbl merah-2' onclick='request(this.value)' value='".$row['idevent']."'>Redeem</button>".
                "</div>".
             "</div>";
    }
}