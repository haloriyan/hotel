<?php
include '../ctrl/redeem.php';

function toIdr($angka) {
	return 'Rp. '.strrev(implode('.', str_split(strrev(strval($angka)), 3)));
}

session_start();
$sesiHotel = $_SESSION['uhotel'];
$sesiResto = $_SESSION['uresto'];

$pakaiAkun = $_COOKIE['pakaiAkun'];

$redirect = base64_encode('data')

if($sesiHotel == "" && $sesiResto == "") {
    header("location: ../auth&r=".$redirect);
}

if($pakaiAkun == "resto") {
	// nggawe resto
	$idhotel = $resto->info($sesiResto, "idresto");
    $myEvent = $event->myForResto($myId);
    $linkCta = "../resto/add-listing";
}else {
    // nggawe hotel
	$idhotel = $hotel->get($sesiHotel, "idhotel");
    $myEvent = $event->my($myId);
    $linkCta = "../hotel/add-listing";
}

$status = $_COOKIE['statusRedeem'];
if($status == null) {
    $status = 0;
}
$myRedeem = $redeem->my($idhotel, $status);
if($myRedeem == "null") {
    echo "You haven't asked for redeem";
    exit();
}

foreach($myRedeem as $row) {
    $idevent = $row['idevents'];
    $coverImage = $event->info($idevent, "covers");
    $title = $event->info($idevent, "title");
    $price = $event->info($idevent, "price");
    $qty = $booking->countQty($idevent);
    $saldo = $price * $qty;
    $potongan = 5 / 100 * $saldo;
    $fixedSaldo = $saldo - $potongan;
    $status = $row['status'];

    if($status == 0) {
        $statusMsg = "Pending";
        $warna = "kuning";
    }else if($status == 1) {
        $statusMsg = "<i class='fa fa-check'></i> &nbsp; Confirmed";
        $warna = "hijau";
    }
    echo "<div class='myList'>".
            "<img src='../aset/gbr/".$coverImage."'>".
            "<div class='wrap'>".
                "<h3>".$title."</h3>".
                "<p><i class='fa fa-money'></i> &nbsp; ".toIdr($fixedSaldo)."</p>".
                "<button class='tbl $warna' style='cursor: default;'>".$statusMsg."</button>".
            "</div>".
         "</div>";
}