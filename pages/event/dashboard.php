<?php
include 'aksi/ctrl/booking.php';

session_start();
$sesiHotel = $_SESSION['uhotel'];
$sesiResto = $_SESSION['uresto'];

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
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale = 1'>
    <title>Dashboard - Events Dailyhotels</title>
</head>
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
        .myList {
            width: 31.6%;
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
            <div id='load'>
                <div class='myList'>
                    <img src="http://localhost/hotel/aset/gbr/paulWalkerCover.jpg">
                    <div class='wrap'>
                        <h3>Meet and Greet with Paul Walker on the heaven</h3>
                        <button class='tbl merah-2'>Detail</button>
                    </div>
                </div>
                <div class='myList'>
                    <img src="http://localhost/hotel/aset/gbr/koridor-co-working-space-surabaya-koridor-2.jpg">
                    <div class='wrap'>
                        <h3>Meet and Greet with Paul Walker on the heaven</h3>
                        <button class='tbl merah-2'>Detail</button>
                    </div>
                </div>
                <div class='bag-tombol'>
                    <button class='merah-2'>load more</button>
                </div>
            </div>
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
        mengarahkan("./detail&id="+val)
    }

    load()
</script>

</body>
</html>