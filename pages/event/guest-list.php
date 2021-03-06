<?php
include 'aksi/ctrl/booking.php';

session_start();
$sesiHotel = $_SESSION['uhotel'];
$sesiResto = $_SESSION['uresto'];

$idevent = $_GET['idevent'];
if($idevent == null) {
	header("location: ./dashboard&from=guest-list");
}
setcookie('idevent', $_GET['idevent'], time() + 3666, "/");

$namaEvent = $event->info($idevent, "title");

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
	$nama = $hotel->get($sesiResto, 'nama');
}

$namaPertama = explode(" ", $nama)[0];

// Set Cookie jadi kosong
setcookie('hadir', '0', time() + 1, "/");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>Dashboard</title>
	<link href='../aset/fw/build/fw.css' rel='stylesheet'>
	<link href='../aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='../aset/css/style.index.css' rel='stylesheet'>
	<link href="../aset/css/style.explore-admin.css" rel="stylesheet">
	<style>
		.card {
			display: inline-block;
			width: 31%;
			border-radius: 6px;
			margin-right: 15px;
			margin-bottom: 20px;
			cursor: pointer;
		}
		.card .wrap { margin: 4% 15% 8% 15%; }
		.box {
			font-size: 17px;
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
    <a href="./detail&idevent=<?php echo $idevent; ?>"><div class="listWizard">Detail Event</div></a>
    <a href="#"><div class="listWizard" aktif="ya">Guest List</div></a>
	<a href="./redeem"><div class="listWizard">Redeem</div></a>
	<a href="../hotel/logout"><div class="listWizard">Logout</div></a>
</div>

<div class='container'>
	<div class='wrap'>
		<h4><div id="icon"><i class="fa fa-list"></i></div> Guest Lists for <?php echo $namaEvent; ?></h4>
		<div>
			<div class='bag bag-4'>
				<input type="text" class='box' id='name' oninput='cari(this.value)' placeholder='Search by name'>
			</div>
			<div class='bag bag-3'>
				<select id="hadir" class='box' onchange='selectHadir(this.value)'>
					<option value="0">Unattend</option>
					<option value="1">Attended</option>
				</select>
			</div>
			<!--
			<div class='bag bag-3'>
				<select id="event" onchange="selectEvt(this.value)" class="box">
					<option value="">Select event...</option>
					<?php
					/*
					foreach ($myEvent as $row) {
						echo "<option value='".$row['idevent']."'>".$row['title']."</option>";
					}
					*/
					?>
				</select>
			</div>
			-->
		</div>
		<br /><br /><br /><br /><br />
		<div id='load'></div>
	</div>
</div>

<script src='../aset/js/embo.js'></script>
<script>
	function load() {
		ambil("../aksi/booking/guestList.php", (res) => {
			tulis("#load", res)
		})
	}

	function setCookie(name, val) {
		let set = "namakuki="+name+"&value="+val+"&durasi=3666"
		pos("../aksi/setCookie.php", set, () => {
			load()
		})
	}

	function cari(val) {
		setCookie("namaCari", val)
	}

	function selectEvt(val) {
		setCookie("idevent", val)
	}

	function selectHadir(val) {
		setCookie("hadir", val)
	}

	function hadir(val) {
		let set = "id="+val
		pos("../aksi/booking/hadir.php", set, () => {
			load()
		})
	}

	load()
</script>

</body>
</html>