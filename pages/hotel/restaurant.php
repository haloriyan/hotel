<?php
include 'aksi/ctrl/hotel.php';

$sesi 	= $hotel->sesi();
$name 	= $hotel->get($sesi, "nama");
$namaPertama = explode(" ", $name)[0];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>Restaurant</title>
	<link href='../aset/fw/build/fw.css' rel='stylesheet'>
	<link href='../aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='../aset/css/style.index.css' rel='stylesheet'>
	<link href="../aset/css/style.explore-admin.css" rel="stylesheet">
	<style>
		.atas { z-index: 2; }
		.bg { z-index: 4; }
		.popup .box {
			padding: 0px;
			font-size: 16px;
			height: 50px;
			border: none;
			border-radius: 0px;
			border-bottom: 1px solid #ccc;
			width: 100%;
		}
		.box:focus { border-bottom: 1px solid #cb0023; }
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
	<a href="./restaurant"><div class="listWizard" aktif="ya">Restaurant</div></a>
	<a href="./listing"><div class="listWizard">My Listings</div></a>
	<a href="./detail"><div class="listWizard">Detail Information</div></a>
	<a href="./social"><div class="listWizard">Social Network</div></a>
	<a href="./facility"><div class="listWizard">Facility</div></a>
	<a href="./logout"><div class="listWizard">Logout</div></a>
</div>

<div class="container">
	<div>
		<div class="wrap">
			<h4><div id="icon"><i class="fa fa-home"></i></div> My Restaurant
				<button class="ke-kanan merah-2 tbl" id="newResto"><i class="fa fa-plus"></i> &nbsp;New Resto</button>
			</h4>
			<div id="loadResto"></div>
		</div>
	</div>
</div>

<div class="bg"></div>
<div class="popupWrapper" id="popupNew">
	<div class="popup">
		<div class="wrap">
			<h3>New Restaurant
				<div id="xNew" class="ke-kanan"><i class="fa fa-close"></i></div>
			</h3>
			<form id="formAdd">
				<input type="text" class="box" id="nameAdd" placeholder="Resto name" autocomplete="off" required>
				<input type="email" class="box" id="mailAdd" placeholder="Email login" autocomplete="off" required>
				<input type="password" class="box" id="pwdAdd" placeholder="Password login" autocomplete="off" required>
				<div class="bag-tombol">
					<button class="merah-2">Add</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="popupWrapper" id="suksesAdd">
	<div class="popup">
		<div class="wrap">
			<h3>Successfully Added!
				<div id="xSukses" class="ke-kanan"><i class="fa fa-close"></i></div>
			</h3>
			<p>
				change the details of information through restaurant accounts that can be accessed <a href="../resto/login" target="_blank">here</a>
			</p>
		</div>
	</div>
</div>

<div class="popupWrapper" id="delResto">
	<div class="popup">
		<div class="wrap">
			<h3>Delete restaurant
				<div id="xDel" class="ke-kanan"><i class="fa fa-close"></i></div>
			</h3>
			<form id="formDelete">
				<input type="hidden" id="idresto">
				<p>
					Sure want delete this restaurant?
				</p>
				<div class="bag-tombol">
					<button class="merah-2">Yes, I want</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="../aset/js/embo.js"></script>
<script>
	function loadResto() {
		ambil("../aksi/resto/my.php", function(res) {
			tulis("#loadResto", res)
		})
	}
	function hapus(val) {
		pilih("#idresto").value = val
		munculPopup("#delResto", pengaya("#delResto", "top: 200px"))
	}
	loadResto()
	klik("#cta", function() {
		mengarahkan("./add-listing")
	})
	klik("#newResto", function() {
		munculPopup("#popupNew", pengaya("#popupNew", "top: 120px"))
	})
	// munculPopup("#popupNew", pengaya("#popupNew", "top: 120px"))

	submit("#formAdd", function() {
		let name = pilih("#nameAdd").value
		let mail = pilih("#mailAdd").value
		let pwd  = pilih("#pwdAdd").value
		let add = "name="+name+"&email="+mail+"&pwd="+pwd
		pos("../aksi/resto/add.php", add, function() {
			pilih("#nameAdd").value = ""
			pilih("#mailAdd").value = ""
			pilih("#pwdAdd").value = ""
			hilangPopup("#popupNew")
			munculPopup("#suksesAdd", pengaya("#suksesAdd", "top: 190px"))
			loadResto()
		})
		return false
	})
	submit("#formDelete", function() {
		let id = pilih("#idresto").value
		let del = "id="+id
		pos("../aksi/resto/delete.php", del, function() {
			hilangPopup("#delResto")
			loadResto()
		})
		return false
	})

	tekan("Escape", function() {
		hilangPopup("#popupNew")
		hilangPopup("#suksesAdd")
		hilangPopup("#delResto")
	})
	klik("#xNew", function() {
		hilangPopup("#popupNew")
	})
	klik("#xDel", function() {
		hilangPopup("#delResto")
	})
	klik("#xSukses", function() {
		hilangPopup("#suksesAdd")
	})
</script>

</body>
</html>