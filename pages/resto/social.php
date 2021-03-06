<?php
include 'aksi/ctrl/resto.php';

// login to resto account
if($_GET['id'] !== null) {
	$resto->login($_GET['id']);
}else if($_GET['namaResto'] != null) {
	$resto->login($_GET['namaResto']);
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
		<a href="../restoran/<?php echo $idresto; ?>" target='_blank'><li id="adaSub">Hello <?php echo $namaPertama; ?> ! &nbsp; <i class="fa fa-angle-down"></i>
			<nav class="sub" id="subUser">
				<a href="./detail"><li><div id="icon"><i class="fa fa-cog"></i></div> Settings</li></a>
				<a href="./galeri"><li><div id="icon"><i class="fa fa-image"></i></div> Gallery</li></a>
				<a href="./facility"><li><div id="icon"><i class="fa fa-cogs"></i></div> Facility</li></a>
				<a href="./social"><li><div id="icon"><i class="fa fa-user"></i></div> Social</li></a>
				<a href="./cuisine"><li><div id="icon"><i class="fa fa-cutlery"></i></div> Cuisine</li></a>
				<a href="./logout"><li><div id="icon"><i class="fa fa-sign-out"></i></div> Logout</li></a>
			</nav>
		</li></a>
		<button id="cta" class="tbl"><i class="fa fa-plus-circle"></i> Add Listing</button>
	</nav>
</div>

<div class="kiri">
	<a href='./dashboard'><div class="listWizard">Dashboard</div></a>
	<a href="./detail"><div class="listWizard" aktif="ya">Detail Information</div></a>
	<a href="./listing"><div class="listWizard">My Listings</div></a>
</div>

<div class="container">
	<div class="tabs">
		<div class="wrap">
			<a href="./detail"><div class="tab" resto='ya'><i class="fa fa-pencil"></i></div></a>
			<a href="./galeri"><div class="tab" resto='ya'><i class="fa fa-image"></i></div></a>
			<a href="./facility"><div class="tab" resto='ya'><i class="fa fa-cogs"></i></div></a>
			<a href="./cuisine"><div class="tab" resto='ya'><i class="fa fa-cutlery"></i></div></a>
			<a href="#"><div class="tab" resto='ya' aktif='ya'><i class="fa fa-user"></i></div></a>
		</div>
	</div>
	<div id="y" style="margin-top: 120px">
		<div class="wrap">
			<h4><div id="icon"><i class="fa fa-user"></i></div> Social Network</h4>
			<div id="load"></div>
			<br />
			<button class="tbl merah-2" id="newSocial"><i class="fa fa-plus"></i> Add New</button>
		</div>
	</div>
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
					<option>LinkedIn</option>
					<option>Youtube</option>
					<option>Google+</option>
					<option>Snapchat</option>
					<option>Pinterest</option>
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
		ambil("../aksi/restosocial/load.php", function(res) {
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
	})
	klik("#xAdd", function() {
		hilangPopup("#addSocial")
	})
	klik("#newSocial", function() {
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
			pilih("#urlAdd").value = ''
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