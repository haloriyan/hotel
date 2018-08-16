<?php
include 'aksi/ctrl/hotel.php';

$sesi 	= $hotel->sesi();
$name 	= $hotel->get($sesi, "nama");
$idhotel 	= $hotel->get($sesi, "idhotel");
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
	<a href="./dashboard"><div class="listWizard">Dashboard</div></a>
	<a href="./detail"><div class="listWizard">Detail Information</div></a>
	<a href="./listing"><div class="listWizard">My Listings</div></a>
	<a href="./galeri"><div class="listWizard">Gallery</div></a>
	<a href="./facility"><div class="listWizard">Facility</div></a>
	<a href="./listing"><div class="listWizard" aktif="ya">Social Network</div></a>
	<a href="./restaurant"><div class="listWizard">Restaurant</div></a>
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

<div class="popupWrapper" id="popupHapus">
	<div class="popup">
		<div class="wrap">
			<h3>Delete social
				<div id="xHapus" class="ke-kanan"><i class="fa fa-close"></i></div>
			</h3>
			<form id="delSocial">
				<p>
					Sure want delete this account?
				</p>
				<input type="hidden" id="idsocial">
				<div class="bag-tombol">
					<button class="merah-2">Yes, delete this account</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="../aset/js/embo.js"></script>
<script>
	function load() {
		ambil("../aksi/social/load.php", function(res) {
			tulis("#load", res)
		})
	}
	function hapus(val) {
		munculPopup("#popupHapus", pengaya("#popupHapus", "top: 210px"))
		pilih("#idsocial").value = val
	}

	klik("#cta", function() {
		mengarahkan("./add-listing")
	})

	tekan("Escape", function() {
		hilangPopup("#addSocial")
		hilangPopup("#popupHapus")
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
		pos("../aksi/social/add.php", tambah, function() {
			hilangPopup("#addSocial")
			pilih("#urlAdd").value = ""
			load()
		})
		return false
	})
	submit("#delSocial", function() {
		let id = pilih("#idsocial").value
		let del = "idsocial="+id
		pos("../aksi/social/delete.php", del, function() {
			hilangPopup("#popupHapus")
			load()
		})
		return false
	})

	load()
</script>

</body>
</html>
