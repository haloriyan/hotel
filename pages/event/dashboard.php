<?php
include 'aksi/ctrl/booking.php';

session_start();
$sesiHotel = $_SESSION['uhotel'];
$sesiResto = $_SESSION['uresto'];

$pakaiAkun = $_COOKIE['pakaiAkun'];

if($sesiHotel == "" && $sesiResto == "") {
    header("location: ../auth");
}

$from = $_GET['from'];
if($from == "guest-list") {
    $msgFrom = "Select event first before see guest list";
}else if($from == "detail") {
    $msgFrom = "Select event first before see detail";
}

if($pakaiAkun == "resto") {
	// nggawe resto
	$myId = $resto->info($sesiResto, "idresto");
    $myEvent = $event->myForResto($myId);
    $linkCta = "../resto/add-listing";
    $nama = $resto->info($sesiResto, "nama");
}else {
    // nggawe hotel
	$myId = $hotel->get($sesiHotel, "idhotel");
    $myEvent = $event->my($myId);
    $linkCta = "../hotel/add-listing";
    
    $nama = $hotel->get($sesiHotel, "nama");
}
$namaPertama = explode(" ", $nama)[0];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>Dashboard - Events Dailyhotels</title>
	<link href='../aset/fw/build/fw.css' rel='stylesheet'>
	<link href='../aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='../aset/css/style.index.css' rel='stylesheet'>
	<link href="../aset/css/style.explore-admin.css" rel="stylesheet">
	<style>
        .box { font-size: 16px;}
        .myList {
            width: 31.46%;
            float: left;
            box-shadow: 1px 1px 5px 1px #ddd;
            margin: 0px 10px;
            margin-bottom: 25px;
        }
        .myList:nth-child(1),.myList:nth-child(3n + 1) { margin-left: 0px; }
        .myList:nth-child(3n) { margin-right: 0px; }
        .myList img {
            width: 100%;
            height: 180px;
        }
        .myList .wrap { margin: 6% 10% 8% 10%; }
        .myList h3 { line-height: 35px; }
        #load { margin-top: 45px; }
        #ctaDashboard {
            font-size: 17px;
            padding: 10px 17px 12px 17px;
            margin-right: 10px;
        }
        #ctaDashboard:nth-child(3) {
            margin-right: 0px;
        }
	</style>
</head>
<body>
<div class="atas merah-2">
	<h1 class="logoHome" style="margin: 0;margin-left: 5%;font-size: 23px;font-family: OBold;">Event Management</h1>
	<div class="pencarian">
		<i class="fa fa-search"></i>
		<input type="text" class="box" placeholder="Type your search...">
	</div>
	<nav class="menu">
		<a href="#"><li>Home</li></a>
		<a href="#"><li>Explore</li></a>
		<a href="#"><li>City</li></a>
		<li>Hello <?php echo $namaPertama; ?> !</li>
		<a href='<?php echo $linkCta; ?>' target='_blank'><button id="cta" class="tbl"><i class="fa fa-plus-circle"></i> Add Listing</button></a>
	</nav>
</div>

<div class="kiri">
    <a href="./dashboard"><div class="listWizard" aktif="ya">Dashboard</div></a>
    <a href="./detail"><div class="listWizard">Detail Event</div></a>
    <a href="./guest-list"><div class="listWizard">Guest List</div></a>
    <a href="./redeem"><div class="listWizard">Redeem</div></a>
	<a href="../hotel/logout"><div class="listWizard">Logout</div></a>
</div>

<div class='container'>
    <div>
        <div class='wrap'>
            <h4><div id='icon'>&nbsp;<i class='fa fa-home'></i>&nbsp;</div> Dashboard
                <div class='ke-kanan'>
                    <input type="text" class='box' placeholder='Search event...' oninput='cari(this.value)'>
                </div>
            </h4>
            <div class="merah-2" style='margin-top: 30px;padding: 1px;display: none;' id='alert'>
                <div class="wrap">
                    <?php echo $msgFrom; ?>
                    <div class='ke-kanan' id='xAlert'><i class='fa fa-close'></i></div>
                </div>
            </div>
            <div id='load'></div>
        </div>
    </div>
</div>

<script src='../aset/js/embo.js'></script>
<script>
    function load() {
        ambil("../aksi/event/myEvent.php", (res) => {
            tulis("#load", res)
        })
    }

    function cari(val) {
        let set = "namakuki=kwSearchDasbor&value="+val+"&durasi=3666"
        pos("../aksi/setCookie.php", set, () => {
            load()
        })
    }

    function see(val) {
        mengarahkan("./detail&idevent="+val)
    }
    function guest(val) {
        mengarahkan("./guest-list&idevent="+val)
    }
    klik("#xAlert", () => {
        hilang("#alert")
    })

    load()
</script>

<?php

if($from != null) {
    echo '<script>
setTimeout(function() {
muncul("#alert")
}, 500)
</script>';
}

?>

</body>
</html>