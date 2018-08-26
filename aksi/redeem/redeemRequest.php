<?php
include '../ctrl/redeem.php';
function toIdr($angka) {
	return 'Rp. '.strrev(implode('.', str_split(strrev(strval($angka)), 3)));
}

$all = $redeem->all(0);
if($all == "null") {
    echo "No redeem request";
    exit();
}

foreach($all as $row) {
    $idevent = $row['idevents'];
    $coverImage = $event->info($idevent, "covers");
    $title = $event->info($idevent, "title");
    $price = $event->info($idevent, "price");
    $qty = $booking->countQty($idevent);
    $saldo = $price * $qty;
    $potongan = 5 / 100 * $saldo;
    $fixedSaldo = $saldo - $potongan;
    if($row['id_resto'] == 0) {
        // pakai hotel
        $idhotel = $row['idhotel'];
        $name = $hotel->get($idhotel, "nama");
    }else {
        // pakai resto
        $idresto = $rpw['id_resto'];
        $name = $resto->info($idresto, "nama")."s";
    }

    echo "<div class='myList'>".
            "<img src='../aset/gbr/".$coverImage."'>".
            "<div class='wrap'>".
                "<h3>".$title."</h3>".
                "<p>".
                    "<div id='icon'><i class='fa fa-money'></i></div> ".toIdr($fixedSaldo).
                "</p>".
                "<p>".
                    "<div id='icon'><i class='fa fa-user'></i></div> ".$name." - 115601021344500 (BRI)".
                "</p>".
                "<button class='tbl merah-2' onclick='cawang(this.value)' value='".$row['idredeem']."'>Confirm</button>".
            "</div>".
         "</div>";
}