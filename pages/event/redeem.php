<?php
include 'aksi/ctrl/redeem.php';

session_start();
$sesiHotel = $_SESSION['uhotel'];
$sesiResto = $_SESSION['uresto'];

setcookie('statusRedeem', '0', time() + 3666, "/");

if($sesiHotel == "" && $sesiResto == "") {
    header("location: ../hotel/login");
}

if($sesiHotel == "") {
	// nggawe resto
	$myId = $resto->info($sesiResto, "idresto");
    $myEvent = $event->myForResto($myId);
    $linkCta = "../resto/add-listing";
}else {
    // nggawe hotel
	$myId = $hotel->get($sesiHotel, "idhotel");
    $myEvent = $event->my($myId);
    $linkCta = "../hotel/add-listing";
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>Redeem</title>
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
        .atas { z-index: 3; }
        .bg { z-index: 4; }
        .popup { z-index: 5;border-radius: 6px; }
		#myListing li {
			display: inline-block;
			color: #cb0023;
			cursor: pointer;
		}
		td a { font-size: 15px; }
		th {
			text-align: left;
			padding: 5px;
			background-color: #fff;
			border-bottom: 1px solid #ccc;
		}
		td {
			padding: 10px;
			border-bottom: 1px solid #ddd;
			background-color: #fff;
		}
		td h4 { margin-top: 5px; }
        #abort {
            padding: 8px 30px 10px 30px;
        }
        .myList {
            width: 31.46%;
            display: inline-block;
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
		<button id="cta" class="tbl"><i class="fa fa-plus-circle"></i> Add Listing</button>
	</nav>
</div>

<div class="kiri">
    <a href="./dashboard"><div class="listWizard">Dashboard</div></a>
    <a href="./detail"><div class="listWizard">Detail Event</div></a>
    <a href="./guest-list"><div class="listWizard">Guest List</div></a>
    <a href="./redeem"><div class="listWizard" aktif="ya">Redeem</div></a>
	<a href="../hotel/logout"><div class="listWizard">Logout</div></a>
</div>

<div class="container">
    <div>
        <div class="wrap">
            <h4><div id="icon"><i class="fa fa-money"></i></div> Redeem</h4>
            <br />
            <div id="load">
                <input type="hidden" id='mySaldoInput' value='<?php echo $mySaldo; ?>'>
                <div id="loads"></div>
            </div>
            <h3>My Request</h3>
            <div id='myRedeem'></div>
        </div>
    </div>
</div>

<div class='bg'></div>
<div class='popupWrapper' id='notif'>
    <div class='popup'>
        <div class='wrap'>
            <h3><i class='fa fa-info'></i> &nbsp;Alert!
                <div class='ke-kanan' id='xNotif'><i class='fa fa-close'></i></div>
            </h3>
            <p id='isiNotif'>Hello world</p>
        </div>
    </div>
</div>

<div class='popupWrapper' id='abortRedeem'>
    <div class='popup'>
        <div class='wrap'>
            <h3>Abort Redeem
                <div class='ke-kanan' id='xAbort'><i class='fa fa-close'></i></div>
            </h3>
            <form id='formAbort'>
                <input type="hidden" id='idredeem'>
                <p>
                    Sure you want to cancel this redeem?
                </p>
                <div class='bag-tombol'>
                    <button class='merah-2'>Yes I sure!</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../aset/js/embo.js"></script>
<script>
    function load() {
        ambil("../aksi/event/redeemable.php", (res) => {
            tulis("#loads", res)
        })
        ambil("../aksi/redeem/myRedeem.php", (res) => {
            tulis("#myRedeem", res)
        })
    }
    function request(id) {
        let param = "idevent="+id
        pos("../aksi/redeem/request.php", param, () => {
            load()
        })
    }

    
    tekan("Escape", () => {
        hilangPopup("#notif")
        hilangPopup("#abortRedeem")
    })
    klik("#xNotif", () => {
        hilangPopup("#notif")
    })

    load()
</script>
</body>
</html>