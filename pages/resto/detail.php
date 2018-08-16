<?php
include 'aksi/ctrl/resto.php';

// login to resto account
if($_GET['id'] !== null) {
	$resto->login($_GET['id']);
}

$sesi 	= $resto->sesi();
$name 	= $resto->info($sesi, "nama");
$namaPertama = explode(" ", $name)[0];
$phone 	= $resto->info($sesi, "phone");
$address 	= $resto->info($sesi, "address");
$city = $resto->info($sesi, "city");
$web = $resto->info($sesi, "website");
$description = $resto->info($sesi, "description");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>Detail Information</title>
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
	<a href="./detail"><div class="listWizard" aktif="ya">Detail Information</div></a>
	<a href="./listing"><div class="listWizard">My Listings</div></a>
	<a href="./galeri"><div class="listWizard">Gallery</div></a>
	<a href="./facility"><div class="listWizard">Facility</div></a>
	<a href="./social"><div class="listWizard">Social Network</div></a>
	<a href="./logout"><div class="listWizard">Logout</div></a>
</div>

<div class="container">
	<form id="formDetil">
		<div class="wrap">
			<h4><div id="icon"><i class="fa fa-pencil"></i></div> Detail Information</h4>
			<div class="isi">Resto description</div>
			<textarea class='box' id='description'><?php echo $description; ?></textarea>
			<div class="isi">City :</div>
			<input type="text" class="box" id="city" value="<?php echo $city; ?>">
			<div class="isi">Phone :</div>
			<input type="text" class="box" placeholder="e.g 628123456789" id="phone" value="<?php echo $phone; ?>">
			<div class="isi">Website url :</div>
			<input type="text" class="box" id="web" placeholder="e.g https://dailyhotels.id" value="<?php echo $web; ?>">
			<div class="isi">Address :</div>
			<input class="box" id="address" value="<?php echo $address; ?>">
			<div class="bag-tombol">
				<button class="tbl merah-2">SAVE</button>
			</div>
		</div>
	</form>
	<form id="formImage">
		<div class="wrap">
			<h4><div id="icon"><i class="fa fa-image"></i></div> Change Image</h4>
			<div class="isi">Icon</div>
			<input type="file" id="icons" class="box">
			<div class="isi">Cover</div>
			<input type="file" id="covers" class="box">
			<input type="hidden" id="namaIcon">
			<input type="hidden" id="namaCover">
			<div class="bag-tombol">
				<button class="tbl merah-2">SAVE</button>
			</div>
		</div>
	</form>
</div>

<div class="bg"></div>
<div class="popupWrapper" id="saved">
	<div class="popup">
		<div class="wrap">
			<h3>Saved changes!
				<div id="xNotif" class="ke-kanan"><i class="fa fa-close"></i></div>
			</h3>
		</div>
	</div>
</div>

<div class="popupWrapper" id="notif">
	<div class="popup">
		<div class="wrap">
			<h3><i class="fa fa-info"></i> &nbsp; Alert!
				<div class="ke-kanan" id="xNotif2"><i class="fa fa-close"></i></div>
			</h3>
			<p id="isiNotif">Error</p>
		</div>
	</div>
</div>

<script src="../aset/js/jquery-3.1.1.js"></script>
<script src="../aset/js/insert.js"></script>
<script src="../aset/js/embo.js"></script>
<script>
	submit("#formDetil", function() {
		let phone 	= pilih("#phone").value
		let address = pilih("#address").value
		let city 	= pilih("#city").value
		let web 	= pilih("#web").value
		let description = pilih("#description").value
		let detil 	= "phone="+phone+"&address="+address+"&bag=detil&city="+city+"&web="+web+"&description="+description
		if(phone == "" || address == "" || web == "" || city == "") {
			return false
		}
		pos("../aksi/resto/edit.php", detil, function() {
			munculPopup("#saved", pengaya("#saved", "top: 225px"))
		})
		return false
	})
	submit("#formImage", function() {
		let icons = pilih("#namaIcon").value
		let cover = pilih("#namaCover").value
		let img = "icon="+icons+"&cover="+cover+"&bag=image"
		if(icons == "") {
			return false
		}
		pos("../aksi/resto/edit.php", img, function() {
			munculPopup("#saved", pengaya("#saved", "top: 225px"))
		})
		return false
	})

	tekan("Escape", function() {
		hilangPopup("#saved")
		hilangPopup("#notif")
	})
	klik("#xNotif", function() {
		hilangPopup("#saved")
	})
	klik("#xNotif2", function() {
		hilangPopup("#notif")
	})

	let allowed = ["jpg","jpeg","png","bmp"]

	$("#icons").on("change", function() {
		var icon = $("#icons").val();
		var p = icon.split("fakepath");
		var nama = p[1].substr(1, 2589);
		$("#namaIcon").val(nama);
		let iconExt = getExt(nama)
		if(!inArray(iconExt, allowed)) {
			$("#icons").val('')
			munculPopup("#notif", pengaya("#notif", "top: 200px"))
			tulis("#isiNotif", "File format not supported!")
			return false
		}

		var file = $(this)[0].files[0];
		var upload = new Upload(file);
		upload.doUpload();
	})
	$("#covers").on("change", function() {
		var cover = $("#covers").val();
		var c = cover.split("fakepath");
		var cov = c[1].substr(1, 2585);
		$("#namaCover").val(cov);
		let coverExt = getExt(cov)
		if(!inArray(coverExt, allowed)) {
			$("#covers").val('')
			munculPopup("#notif", pengaya("#notif", "top: 200px"))
			tulis("#isiNotif", "File format not supported!")
			return false
		}

		var file = $(this)[0].files[0];
		var upload = new Upload(file);
		upload.doUpload();
	})

	function sukses() {
		$(function() {
			//
		});
	}

	klik("#cta", function() {
		mengarahkan("./add-listing")
	})
	function getExt(val) {
		let re =/(?:\.([^.]+))?$/
		let ext = re.exec(val)[1]
		return ext
	}
</script>

</body>
</html>
