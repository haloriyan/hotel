<?php
include '../ctrl/redeem.php';

session_start();
$sesiHotel = $_SESSION['uhotel'];
$sesiResto = $_SESSION['uresto'];

$pakaiAkun = $_COOKIE['pakaiAkun'];

if($pakaiAkun == "resto") {
    // nggawe resto
    $idhotel = $resto->info($sesiResto, "idhotel");
	$idresto = $resto->info($sesiResto, "idresto");
	$myEvent = $event->myForResto($idresto, $_COOKIE['kwSearchDasbor']);
    if($_COOKIE['kwSearchDasbor'] != "") {
        $myEvents = $event->myForResto($idhotel, $_COOKIE['kwSearchDasbor'], '', '', 'ya');
    }
}else {
    // nggawe hotel
    $idhotel = $hotel->get($sesiHotel, "idhotel");
	$idresto = 0;
    $myEvent = $event->my($idhotel, $_COOKIE['kwSearchDasbor']);
    if($_COOKIE['kwSearchDasbor'] != "") {
        $myEvents = $event->my($idhotel, $_COOKIE['kwSearchDasbor'], '', '', 'ya');
    }
}

if($myEvent == "null") {
    echo "You dont have any event";
    exit();
}else {
    echo "<h3>Active Listing</h3>";
    foreach($myEvent as $row) {
        echo "<div class='myList'>".
                "<img src='../aset/gbr/".$row['covers']."'>".
                "<div class='wrap'>".
                    "<h3>".$row['title']."</h3>".
                    "<button id='ctaDashboard' class='tbl merah-2' onclick='see(this.value)' value='".$row['idevent']."'>Detail</button>".
                    "<button id='ctaDashboard' class='tbl merah-2' onclick='guest(this.value)' value='".$row['idevent']."'>Guest List</button>".
                "</div>".
             "</div>";
    }
    if($_COOKIE['kwSearchDasbor'] != "") {
        echo "<h3>All Listing</h3>";
        foreach ($myEvents as $row) {
            echo "<div class='myList'>".
                    "<img src='../aset/gbr/".$row['covers']."'>".
                    "<div class='wrap'>".
                        "<h3>".$row['title']."</h3>".
                        "<button id='ctaDashboard' class='tbl merah-2' onclick='see(this.value)' value='".$row['idevent']."'>Detail</button>".
                        "<button id='ctaDashboard' class='tbl merah-2' onclick='guest(this.value)' value='".$row['idevent']."'>Guest List</button>".
                    "</div>".
                 "</div>";
        }
    }
}