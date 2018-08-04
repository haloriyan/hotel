<?php
include 'aksi/ctrl/event.php';

$sesi 	= $resto->sesi();
$name 	= $resto->info($sesi, "nama");
$myId 	= $resto->info($sesi, "idresto");
$namaPertama = explode(" ", $name)[0];

$idevent = $_GET['idevent'];
$namaEvent = $event->info($idevent, "title");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>My Listing</title>
	<link href='../aset/fw/build/fw.css' rel='stylesheet'>
	<link href='../aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='../aset/css/style.index.css' rel='stylesheet'>
	<link href="../aset/css/style.explore-admin.css" rel="stylesheet">
	<style>
		.box {
			font-size: 16px;
			width: 93.2%;
		}
		.atas { z-index: 1; }
		.bg { z-index: 4; }
		.popup { z-index: 15;border-radius: 5px; }
		.container {
			background-color: #fff;
			color: #444;
			border: 1px solid #ccc;
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
	<img src= "../aset/gbr/logo.png" class="logoHome">
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
	<a href="./detail"><div class="listWizard">Detail Information</div></a>
	<a href="./listing"><div class="listWizard" aktif="ya">My Listings</div></a>
	<a href="./galeri"><div class="listWizard">Gallery</div></a>
	<a href="./facility"><div class="listWizard">Facility</div></a>
	<a href="./social"><div class="listWizard">Social Network</div></a>
	<a href="./logout"><div class="listWizard">Logout</div></a>
</div>

<div class="container">
	<div class="wrap">
		<h4><div id="icon"><i class="fa fa-home"></i></div> My Listing</h4>
		<p>
			Your listing are shown in the table below
		</p>
		<div id="load"></div>
	</div>
</div>

<div class="bg"></div>
<div class="popupWrapper" id="hapusList">
	<div class="popup">
		<div class="wrap">
			<h3>Hapus Listing Event
				<div class="ke-kanan" id="xHapus"><i class="fa fa-close"></i></div>
			</h3>
			<form id="formHapus">
				<input type="hidden" id="idevent">
				<p id="loadFormHapus">
					Yakin ingin menghapus <b><?php echo $namaEvent; ?></b> ?
				</p>
				<div class="bag-tombol">
					<button class="merah-2">Ya, Hapus</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="../aset/js/embo.js"></script>
<script>
	function load() {
		ambil("../aksi/event/my.php", function(res) {
			tulis("#load", res)
		})
	}
	load()
	klik("#cta", function() {
		mengarahkan("./add-listing")
	})

	function hapus(val) {
		let set = "namakuki=idevent&value="+val+"&durasi=365"
		pos("../aksi/setCookie.php", set, function() {
			munculPopup("#hapusList", pengaya("#hapusList", "top: 200px"))
			ambil("../aksi/event/formHapus.php", function(res) {
				tulis("#loadFormHapus", res)
			})
			pilih("#idevent").value = val
		})
	}

	tekan("Escape", function() {
		hilangPopup("#hapusList")
	})
	klik("#xHapus", function() {
		hilangPopup("#hapusList")
	})

	submit("#formHapus", function() {
		let id = pilih("#idevent").value
		let del = "id="+id
		pos("../aksi/event/delete.php", del, function() {
			hilangPopup("#hapusList")
			load()
		})
		return false
	})
</script>

</body>
</html>