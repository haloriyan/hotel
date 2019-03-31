<?php
include 'aksi/ctrl/booking.php';

session_start();
$sesiHotel = $_SESSION['uhotel'];
$sesiResto = $_SESSION['uresto'];

if($sesiHotel == "" && $sesiResto == "") {
    header("location: ../auth");
}

$pakaiAkun = $_COOKIE['pakaiAkun'];

if($pakaiAkun == "resto") {
	// nggawe resto
	$myId = $resto->info($sesiResto, "idresto");
    $myEvent = $event->myForResto($myId);
    $linkCta = "../resto/add-listing";
    $nama = $resto->info($sesiResto, 'nama');
}else {
    // nggawe hotel
	$myId = $hotel->get($sesiHotel, "idhotel");
    $myEvent = $event->my($myId);
    $linkCta = "../hotel/add-listing";
    $nama = $hotel->get($sesiHotel, 'nama');
}

$idevent = $_GET['idevent'];
if(isset($_GET['idevent'])) {
    setcookie('idevent', $_GET['idevent'], time() + 3666, "/");
}else {
    header("location: ./dashboard&from=detail");
}

$eventName = $event->info($idevent, "title");
$namaPertama = explode(" ", $nama)[0];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>Detail Event</title>
	<link href='../aset/fw/build/fw.css' rel='stylesheet'>
	<link href='../aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='../aset/css/style.index.css' rel='stylesheet'>
	<link href="../aset/css/style.explore-admin.css" rel="stylesheet">
	<style>
        .box { font-size: 16px;}
        #cover {
            width: 100%;
            height: 350px;
        }
        #detailnya {
            width: 44%;
            margin-left: 5%;
        }
        #detailnya li {
            line-height: 65px;
            list-style: none;
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
		<a href="./<?php echo $idhotel; ?>" target='_blank'><li id="adaSub">Hello <?php echo $namaPertama; ?> ! &nbsp; <i class="fa fa-angle-down"></i>
            <nav class="sub merah-2" id="subUser" style="top: 77px !important;">
                <a href="./dashboard"><li><div id="icon"><i class="fa fa-home"></i></div> Dashboard</li></a>
                <a href="./detail"><li><div id="icon"><i class="fa fa-user"></i></div> Profile</li></a>
                <a href="./listing"><li><div id="icon"><i class="fa fa-pencil"></i></div> Listing</li></a>
                <a href="./restaurant"><li><div id="icon"><i class="fa fa-cutlery"></i></div> Restaurant</li></a>
                <a href="./logout"><li><div id="icon"><i class="fa fa-sign-out"></i></div> Logout</li></a>
            </nav>
        </li></a>
		<a href='<?php echo $linkCta; ?>' target='_blank'><button id="cta" class="tbl"><i class="fa fa-plus-circle"></i> Add Listing</button></a>
	</nav>
</div>

<div class="kiri">
    <a href="./dashboard"><div class="listWizard">Dashboard</div></a>
    <a href="#"><div class="listWizard" aktif="ya">Detail Event</div></a>
    <a href="./guest-list&idevent=<?php echo $_GET['idevent']; ?>"><div class="listWizard">Guest List</div></a>
    <a href="./redeem"><div class="listWizard">Redeem</div></a>
	<a href="../hotel/logout"><div class="listWizard">Logout</div></a>
</div>

<div class="container">
    <div>
        <div class="wrap">
            <h4><div id="icon"><i class="fa fa-list"></i></div> Detail Event for <?php echo $eventName; ?></h4>
            <br />
            <div id="load">
                Select event before see the details
            </div>
        </div>
    </div>
</div>

<script src="../aset/js/embo.js"></script>
<script>
    function load() {
        ambil("../aksi/event/detail.php", function(res) {
            tulis("#load", res)
        })
    }

    function selectEvt(val) {
        let set = "namakuki=idevent&value="+val+"&durasi=3655"
        pos("../aksi/setCookie.php", set, function() {
            load()
        })
    }

    klik("#cta", function() {
        mengarahkan("../hotel/add-listing")
    })

    load()
</script>
</body>
</html>
