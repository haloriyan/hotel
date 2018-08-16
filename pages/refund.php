<?php
include 'aksi/ctrl/booking.php';

$sesi 	= $user->sesi();
if(empty($sesi)) {
	header("location: ./");
}
$iduser = $user->info($sesi, "iduser");
$name 	= $user->info($sesi, "nama");
$namaPertama = explode(" ", $name)[0];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>Refund</title>
	<link href='aset/fw/build/fw.css' rel='stylesheet'>
	<link href='aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='aset/css/style.index.css' rel='stylesheet'>
	<link href="aset/css/style.explore-admin.css" rel="stylesheet">
	<style>
		body { background-color: #ecf0f1 !important; }
		#icon {
			line-height: 50px;
		}
		#myListing img {
			width: 50px;
			height: 50px;
		}
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
		#tblStatus {
			padding: 12px 25px;
			font-size: 17px;
		}
        .bg { z-index: 5; }
        .popup { z-index: 5; }
	</style>
</head>
<body>

<div class="atas merah-2">
	<img src= "aset/gbr/logo.png" class="logoHome">
	<div class="pencarian">
		<i class="fa fa-search"></i>
		<input type="text" class="box" placeholder="Type your search...">
	</div>
	<nav class="menu">
		<a href="#"><li>Home</li></a>
		<a href="#"><li>Explore</li></a>
		<a href="#"><li>City</li></a>
		<li>Hello <?php echo $namaPertama; ?> !</li>
	</nav>
</div>

<div class="kiri">
	<a href="./hello"><div class="listWizard">Dashboard</div></a>
	<a href="./my"><div class="listWizard">My Listings</div></a>
    <a href="./refund"><div class="listWizard" aktif="ya">My Refunds</div></a>
	<a href="./detail"><div class="listWizard">Detail Information</div></a>
	<a href="./logout"><div class="listWizard">Logout</div></a>
</div>

<div class="container">
	<div>
		<div class="wrap">
			<h4><div id="icon">&nbsp;<i class="fa fa-home"></i>&nbsp;</div> My Refunded Event
                <div class='ke-kanan'>
                    <button id='newRefund' class='tbl merah-2'>Request Refund</button>
                </div>
            </h4>
			<div id="load"></div>
		</div>
	</div>
</div>

<div class='bg'></div>
<div class='popupWrapper' id='bagReq'>
    <div class='popup'>
        <div class='wrap'>
            <h3>Request Refund Event
                <div class='ke-kanan' id='xReq'><i class='fa fa-close'></i></div>
            </h3>
            <form id='formReq'>
                <div>Select event :</div>
                <select id="selectedEvt" class='box' style='width: 100%;'>
                    <?php
                    foreach($booking->bisaRefund($iduser) as $row) {
                        $eventName = $event->info($row['idevent'], "title");
                        echo "<option value='".$row['idbooking']."'>".$eventName."</option>";
                    }
                    ?>
                </select>
                <div class='bag-tombol'>
                    <button class='merah-2'>Request!</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="aset/js/embo.js"></script>
<script>
	function load() {
		ambil("aksi/user/myRefund.php", function(res) {
			tulis("#load", res)
		})
	}
    klik("#newRefund", () => {
        munculPopup("#bagReq", pengaya("#bagReq", "top: 150px"))
    })
    klik("#xReq", () => {
        hilangPopup("#bagReq")
    })

    tekan("Escape", () => {
        hilangPopup("#bagReq")
    })

    submit("#formReq", () => {
        let idbooking = pilih("#selectedEvt").value
        let req = "idbooking="+idbooking
        pos("aksi/user/reqRefund.php", req, () => {
            location.reload()
        })
        return false
    })

	load() // komentar
</script>

</body>
</html>
