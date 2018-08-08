<?php
include 'aksi/ctrl/redeem.php';

$sesi 	= $hotel->sesi();
$name 	= $hotel->get($sesi, "nama");
$namaPertama = explode(" ", $name)[0];

$idhotel = $hotel->get($sesi, "idhotel");
$myEvent = $event->my($idhotel);
$myRedeem = $redeem->my($idhotel);

function toIdr($angka) {
	return 'Rp. '.strrev(implode('.', str_split(strrev(strval($angka)), 3)));
}

foreach($myEvent as $row) {
    $laku = $row['quota'] - $row['availableseat'];
    $saldo += $laku * $row['price'];
}
foreach($myRedeem as $red) {
    $saldoRedeem += $red['saldo'];
}

$mySaldo = $saldo - $saldoRedeem;

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
            <h4><div id="icon"><i class="fa fa-money"></i></div> Redeem Saldo
                <div class='ke-kanan'>
                    <h3>Available Saldo : <span id='mySaldo'><?php echo toIdr($mySaldo); ?></span></h3>
                </div>
            </h4>
            <br />
            <div id="load">
                <input type="hidden" id='mySaldoInput' value='<?php echo $mySaldo; ?>'>
                <form id='formRedeem'>
                    <input type="number" class='box' id='saldo' placeholder='Saldo (Rp)' style='width: 74%;'> &nbsp;
                    <button class='tbl merah-2'>Redeem</button>
                </form>
                <div id='myRedeem'></div>
            </div>
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
        ambil("../aksi/redeem/myRedeem.php", (res) => {
            tulis("#myRedeem", res)
        })
        ambil("../aksi/redeem/mySaldo.php", (sal) => {
            tulis("#mySaldo", sal)
        })
    }
    function abort(val) {
        munculPopup("#abortRedeem", pengaya("#abortRedeem", "top: 190px"))
        pilih("#idredeem").value = val
    }

    submit("#formRedeem", () => {
        let saldo = pilih("#saldo").value
        let mySaldo = pilih("#mySaldoInput").value
        let req = "saldo="+saldo
        if(parseInt(saldo) >= parseInt(mySaldo)) {
            munculPopup("#notif", pengaya("#notif", "top: 190px"))
            tulis("#isiNotif", "Your saldo is not enough")
            return false
        }else if(saldo == 0 || saldo == "") {
            return false
        }
        pos("../aksi/redeem/request.php", req, () => {
            munculPopup("#notif", pengaya("#notif", "top: 190px"))
            tulis("#isiNotif", "Success to ask for redeem")
            pilih("#saldo").value = ""
            load()
        })
        return false
    })
    submit("#formAbort", () => {
        let idredeem = pilih("#idredeem").value
        let cancel = "idredeem="+idredeem
        pos("../aksi/redeem/cancel.php", cancel, () => {
            hilangPopup("#abortRedeem")
            munculPopup("#notif", pengaya("#notif", "top: 190px"))
            tulis("#isiNotif", "Success canceling this redeem request")
            load()
        })
        return false
    })
    
    tekan("Escape", () => {
        hilangPopup("#notif")
        hilangPopup("#abortRedeem")
    })
    klik("#xNotif", () => {
        hilangPopup("#notif")
    })
    klik("#xAbort", () => {
        hilangPopup("#abortRedeem")
    })

    load()
</script>
</body>
</html>