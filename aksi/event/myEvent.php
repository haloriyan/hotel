<?php
include '../ctrl/redeem.php';

session_start();
$sesiHotel = $_SESSION['uhotel'];
$sesiResto = $_SESSION['uresto'];

if($sesiHotel == "") {
    // nggawe resto
    $idhotel = $resto->info($sesiResto, "idhotel");
	$idresto = $resto->info($sesiResto, "idresto");
	$myEvent = $event->myForResto($idresto);
}else {
    // nggawe hotel
    $idhotel = $hotel->get($sesiHotel, "idhotel");
	$idresto = 0;
	$myEvent = $event->my($idhotel);
}

if($myEvent == "null") {
    echo "You dont have any event";
    exit();
}else {
    foreach($myEvent as $row) {
        echo "<div class='myList'>".
                "<img src='../aset/gbr/".$row['covers']."'>".
                "<div class='wrap'>".
                    "<h3>".$row['title']."</h3>".
                    "<button class='tbl merah-2' onclick='see(this.value)' value='".$row['idevent']."'>Detail</button>".
                "</div>".
             "</div>";
    }
}