<?php
include 'aksi/ctrl/resto.php';

// login to resto account
if($_GET['id'] !== null) {
	$resto->login($_GET['id']);
}

$sesi 	= $resto->sesi();
$name 	= $resto->info($sesi, "nama");
$idresto 	= $resto->info($sesi, "idresto");
$namaPertama = explode(" ", $name)[0];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>Social</title>
	<link href='../aset/fw/build/fw.css' rel='stylesheet'>
	<link href='../aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='../aset/css/style.index.css' rel='stylesheet'>
	<link href="../aset/css/style.explore-admin.css" rel="stylesheet">
	<style>
		.bg { z-index: 5; }
		.box {
			padding: 0px;
			border: none;
			border-radius: 0px;
			border-bottom: 2px solid #ccc;
			width: 100%;
			font-size: 17px;
		}
		.box:focus {
			border-bottom: 2px solid #cb0023;
		}
		select.box {
			border: 1px solid #ccc;
		}
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
	<a href='./dashboard'><div class="listWizard">Dashboard</div></a>
	<a href="./detail"><div class="listWizard">Detail Information</div></a>
	<a href="./listing"><div class="listWizard">My Listings</div></a>
	<a href="./galeri"><div class="listWizard">Gallery</div></a>
	<a href="./facility"><div class="listWizard">Facility</div></a>
	<a href="./social"><div class="listWizard" aktif="ya">Social Network</div></a>
	<a href="./logout"><div class="listWizard">Logout</div></a>
</div>

<div class="container">
	<form id="y">
		<div class="wrap">
			<h4><div id="icon"><i class="fa fa-home"></i></div> Social Network</h4>
			<div id="load"></div>
			<br />
			<button class="tbl merah-2"><i class="fa fa-plus"></i> Add New</button>
		</div>
	</form>
</div>

<div class="bg"></div>
<div class="popupWrapper" id="addSocial">
	<div class="popup">
		<div class="wrap">
			<h3>Add New Social Account
				<div class="ke-kanan" id="xAdd"><i class="fa fa-close"></i></div>
			</h3>
			<form id="formAdd">
				<select class="box" style="width: 100%;" id="typeAdd">
					<option>Facebook</option>
					<option>Instagram</option>
					<option>Twitter</option>
				</select>
				<input type="text" class="box" placeholder="URL" style="width: 100%" autocomplete="off" id="urlAdd">
				<div class="bag-tombol">
					<button class="merah-2">ADD</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="../aset/js/embo.js"></script>
<script>
	function load() {
		ambil("../aksi/restosocial/load.php", function(res) {
			tulis("#load", res)
		})
	}

	klik("#cta", function() {
		mengarahkan("./add-listing")
	})

	tekan("Escape", function() {
		hilangPopup("#addSocial")
	})
	klik("#xAdd", function() {
		hilangPopup("#addSocial")
	})
	submit("#y", function() {
		munculPopup("#addSocial")
		return false
	})
	submit("#formAdd", function() {
		let type = pilih("#typeAdd").value
		let url = pilih("#urlAdd").value
		let tambah = "type="+type+"&url="+url
		if(url == "") {
			return false
		}
		pos("../aksi/restosocial/add.php", tambah, function() {
			hilangPopup("#addSocial")
			load()
		})
		return false
	})

	load()
</script>

</body>
</html>