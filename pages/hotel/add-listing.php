<?php
include 'aksi/ctrl/hotel.php';

$sesi 	= $hotel->sesi();
$name 	= $hotel->get($sesi, "nama");
$namaPertama = explode(" ", $name)[0];
$idhotel = $hotel->get($sesi, 'idhotel');

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>Add Listing | Dailyhotels</title>
	<link href='../aset/fw/build/fw.css' rel='stylesheet'>
	<link href='../aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='../aset/css/style.index.css' rel='stylesheet'>
	<link href="../aset/css/style.explore-admin.css" rel="stylesheet">
	<link rel="stylesheet" href="../aset/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="../aset/flatpickr/dist/themes/material_red.css">
	<style>
		.box,textarea.box {
			border-radius: 0px;
			border: none;
			border-bottom: 2px solid #ccc;
			font-size: 16px;
			padding: 0px;
			width: 100%;
			transition: 0.4s;
		}
		.box:focus { border-bottom: 2px solid #cb0023; }
		#image,#location,#detail,#price { display: none; }
		.atas { z-index: 2; }
		.bg { z-index: 4; }
		.box[readonly] { background: #ecf0f1; }
		.container {
			top: 200px;left: 15%;
			width: 70%;
			margin-bottom: 35px;
			border-radius: 6px;
			border: 1px solid #ddd;
		}

		.myStep {
			z-index: 2;
			text-align: center;
			position: fixed;
			top: 80px;left: 22.5%;
			border: 1px solid #ddd;
			background-color: #fff;
			padding: 15px 100px;
			border-bottom-left-radius: 90px;
			border-bottom-right-radius: 90px;
		}
		.step {
			border: 2px solid #777;
			color: #777;
			font-size: 16px;
			font-family: Arial;
			width: 40px;
			line-height: 40px;
			text-align: center;
			border-radius: 90px;
			display: inline-block;
			cursor: pointer;
		}
		.step[aktif=ya] { border: 2px solid #cb0023;color: #cb0023; }
		.after {
			display: inline-block;
			width: 75px;
			height: 2px;
			background-color: #888;
			position: relative;
			top: -5px;
		}
		.after[aktif=ya] { background-color: #cb0023; }
	</style>
</head>
<body>

<div class="atas merah-2">
	<img src= "../aset/gbr/logo.png" class="logoHome">
	<div class="pencarian" style="display: none;">
		<i class="fa fa-search"></i>
		<input type="text" class="box" placeholder="Type your search...">
	</div>
	<nav class="menu">
		<a href="./dashboard"><li>Dashboard</li></a>
		<a href="./listing"><li>My Listings</li></a>
		<a href="./dashboard"><li>Gallery</li></a>
		<a href="./dashboard"><li>Restaurant</li></a>
	</nav>
</div>

<!--
<div class="kiri">
	<a href="./dashboard"><div class="listWizard">Dashboard</div></a>
	<a href="./detail"><div class="listWizard">Detail Information</div></a>
	<a href="./listing"><div class="listWizard">My Listings</div></a>
	<a href="./galeri"><div class="listWizard">Gallery</div></a>
	<a href="./facility"><div class="listWizard">Facility</div></a>
	<a href="./social"><div class="listWizard">Social Network</div></a>
	<a href="./restaurant"><div class="listWizard">Restaurant</div></a>
	<a href="./logout"><div class="listWizard">Logout</div></a>
</div>
-->

<div class="myStep">
	<div class="step" id="stepOne" aktif='ya'><i class="fa fa-pencil"></i></div>
	<div class="after" id="afterOne"></div>
	<div class="step" id="stepTwo"><i class="fa fa-camera"></i></div>
	<div class="after" id="afterTwo"></div>
	<div class="step" id="stepThree"><i class="fa fa-map-marker"></i></div>
	<div class="after" id="afterThree"></div>
	<div class="step" id="stepFour"><i class="fa fa-align-justify"></i></div>
	<div class="after" id="afterFour"></div>
	<div class="step" id="stepFive"><i class="fa fa-money"></i></div>
</div>

<div class="container">
	<?php
	$status = $hotel->get($sesi, "status");
	if($status == "2") { ?>
		<form id="error!">
			<div class="wrap">
				<h4><div id="icon"><i class="fa fa-close"></i></div> ERROR :(</h4>
				<p>
					Sorry, you can't add a listing. Your account hasn't been verified by admin. To be verified, complete all the <a href="./detail">Detail Information</a> needed and wait until admin verifies your account.
				</p>
			</div>
		</form>
		<?php
		exit();
	}
	?>
	<form id="basic">
		<div class="wrap">
			<h4><div id="icon"><i class="fa fa-pencil"></i></div> Add Listing</h4>
			<div class="isi">Title</div>
			<input type="text" class="box" id="title" placeholder="Event name..." autocomplete="off">
			<div class="isi">Tagline</div>
			<input type="text" class="box" id="tagline" placeholder="Tagline..." autocomplete="off">
			<div class="isi">Description</div>
			<textarea class="box" id="description" placeholder="Event description..."></textarea><br />
			<button class="tbl merah-2">NEXT</button>
		</div>
	</form>
	<form id="image">
		<div class="wrap">
			<h4><div id="icon"><i class="fa fa-camera"></i></div> Event Images</h4>
			<div class="isi">Cover</div>
			<input type="file" class="box" id="cover"><br />
			<input type="hidden" id="covers">
			<button class="tbl merah-2">NEXT</button>
		</div>
	</form>
	<form id="location">
		<div class="wrap">
			<h4><div id="icon"><i class="fa fa-map-marker"></i></div> Location</h4>
			<div class="isi">Region</div>
			<select class='box' id='region' required>
				<option value="">Select region...</option>
				<option>Bali</option>
				<option>Bandung</option>
				<option>Batam</option>
				<option>Bogor</option>
				<option>Jakarta</option>
				<option>Lombok</option>
				<option>Makassar</option>
				<option>Malang</option>
				<option>Pekalongan</option>
				<option>Semarang</option>
				<option>Solo</option>
				<option>Surabaya</option>
				<option>Yogyakarta</option>
			</select>
			<div class="isi">Address</div>
			<textarea class="box" id="address"></textarea><br />
			<button class="tbl merah-2">NEXT</button>
		</div>
	</form>
	<form id="detail">
		<div class="wrap">
			<h4><div id="icon"><i class="fa fa-align-justify"></i></div> Event Details</h4>
			<input type="hidden" id='tglSkrg' value='<?php echo date('Y-m-d'); ?>'>
			<div class="isi">Date Start</div>
			<input type="text" class="box" placeholder="yyyy-mm-dd" id="date" onchange="dateStart(this.value)">
			<div class="isi">Date End</div>
			<input type="text" class="box" placeholder="yyyy-mm-dd" id="dateEnd" readonly>
			<div class="isi">Category</div>
			<select class="box" id="category">
				<option>Food and Beverage</option>
				<option>Room</option>
				<option>Venue</option>
				<option>Sports and Wellness</option>
				<option>Shopping</option>
				<option>Recreation</option>
				<option>Parties</option>
				<option>Others</option>
			</select>
			<div class="isi">Quota :</div>
			<input type="number" class="box" placeholder="Quota Seat per day..." id="seat">
			<br />
			<button class="tbl merah-2">NEXT</button>
		</div>
	</form>
	<form id="price">
		<div class="wrap">
			<h4><div id="icon"><i class="fa fa-money"></i></div> Price</h4>
			<div class="isi">Pricing</div>
			<input type="number" class="box" id="priceBox" placeholder='e.g "140000"'>
			<button class="tbl merah-2" id="publish" type="button">PUBLISH</button>
		</div>
	</form>
</div>

<div class="bg"></div>
<div class="popupWrapper" id="notif">
	<div class="popup">
		<div class="wrap">
			<h3><i class="fa fa-info"></i> &nbsp; Alert!
				<div class="ke-kanan" id="xNotif"><i class="fa fa-close"></i></div>
			</h3>
			<div id="isiNotif">Lorem ipsum dolor sit amet consectetur</div>
		</div>
	</div>
</div>

<script src="../aset/js/embo.js"></script>
<script src="../aset/js/jquery-3.1.1.js"></script>
<script src="../aset/flatpickr/dist/flatpickr.js"></script>
<script src="../aset/js/insert.js"></script>
<script>
	function hilangKecuali(y) {
		hilang("#basic")
		hilang("#image")
		hilang("#location")
		hilang("#detail")
		hilang("#price")
		muncul("#" + y)

		if(y == 'image') {
			pilih('#stepTwo').setAttribute('aktif', 'ya')
			pilih('#afterOne').setAttribute('aktif', 'ya')
		}else if(y == 'location') {
			pilih('#stepThree').setAttribute('aktif', 'ya')
			pilih('#afterTwo').setAttribute('aktif', 'ya')
		}else if(y == 'detail') {
			pilih('#stepFour').setAttribute('aktif', 'ya')
			pilih('#afterThree').setAttribute('aktif', 'ya')
		}else if(y == 'price') {
			pilih('#stepFive').setAttribute('aktif', 'ya')
			pilih('#afterFour').setAttribute('aktif', 'ya')
		}
	}
	function publish() {
		let title = $("#title").val()
		let tagline = $("#tagline").val()
		let description = $("#description").val()
		let cover = $("#covers").val()
		let region = $("#region").val()
		let address = $("#address").val()
		let date = $("#date").val()
		let dateEnd = $("#dateEnd").val()
		let category = $("#category").val()
		let seat = $("#seat").val()
		let price = $("#priceBox").val()
		let pub = "title="+title+"&tagline="+tagline+"&description="+description+"&cover="+cover+"&region="+region+"&address="+address+"&tgl="+date+"&tgl_akhir="+dateEnd+"&category="+category+"&quota="+seat+"&price="+price
		if(title == "" || tagline == "" || description == "" || cover == "" || region == "" || address == "" || date == "" || category == "" || seat == "" || price == "") {
			munculPopup("#notif", pengaya("#notif", "top: 225px"))
			tulis("#isiNotif", "All field must be filled")
			return false
		}
		$.ajax({
			type: "POST",
			url: "../aksi/event/create.php",
			data: pub,
			success: () => {
				mengarahkan("./listing")
			}
		})
	}
	submit("#basic", function() {
		let title 		= pilih("#title").value
		let tagline 	= pilih("#tagline").value
		let description = pilih("#description").value
		if(title == "" || tagline == "" || description == "") {
			munculPopup("#notif", pengaya("#notif", "top: 225px"))
			tulis("#isiNotif", "All field must be filled")
			return false
		}
		hilangKecuali('image')
		return false
	})
	submit("#image", function() {
		let allowed = ["jpg","jpeg","png","bmp"]
		let cover = pilih("#covers").value
		let coverExt = getExt(cover)
		if(cover == "") {
			munculPopup("#notif", pengaya("#notif", "top: 225px"))
			tulis("#isiNotif", "You must insert an image cover")
			return false
		}
		hilangKecuali('location')
		return false
	})
	submit("#location", function() {
		let region = pilih("#region").value
		let address = pilih("#address").value
		if(region == "" || address == "") {
			munculPopup("#notif", pengaya("#notif", "top: 225px"))
			tulis("#isiNotif", "All field must be filled")
			return false
		}
		hilangKecuali('detail')
		return false
	})
	submit("#detail", function() {
		let date = pilih("#date").value
		let cat = pilih("#category").value
		let seat = pilih("#seat").value
		if(date == "" || cat == "" || seat == "") {
			munculPopup("#notif", pengaya("#notif", "top: 225px"))
			tulis("#isiNotif", "All field must be filled")
			return false
		}
		hilangKecuali('price')
		return false
	})
	submit("#price", function() {
		publish()
		return false
	})

	klik("#publish", function() {
		publish()
		return false
	})

	klik("#xNotif", function() {
		hilangPopup("#notif")
	})
	tekan("Escape", function() {
		hilangPopup("#notif")
	})
	klik(".bg", function() {
		hilangPopup("#notif")
	})
	$("#cover").on("change", function() {
		let allowed = ["jpg","jpeg","png","bmp"]
		var cover = $("#cover").val();
		var c = cover.split("fakepath");
		var cov = c[1].substr(1, 2585);
		$("#covers").val(cov);
		let coverExt = getExt(cov)
		if(!inArray(coverExt, allowed)) {
			$("#cover").val("")
			munculPopup("#notif", pengaya("#notif", "top: 225px"))
			tulis("#isiNotif", "Image format not allowed")
			return false
		}

		var file = $(this)[0].files[0];
		var upload = new Upload(file);
		upload.doUpload();
	})

	function sukses() {
		$(function() {
			console.log("uploaded")
		});
	}
	function getExt(val) {
		let re =/(?:\.([^.]+))?$/
		let ext = re.exec(val)[1]
		return ext
	}

	/* datepicker lama
	$(function() {
		$("#date").datepicker({
			minDate: $("#tglSkrg").val(),
			maxDate: '2025-12-31',
			dateFormat: "yy-mm-dd",
			useCurrent: false,
			showClose: true
		})
	})
	*/

	flatpickr("#date", {
		minDate: pilih("#tglSkrg").value,
		maxDate: '2025-12-31',
		dateFormat: "Y-m-d"
	})

	function dateStart(val) {
		pilih("#dateEnd").removeAttribute("readonly")
		flatpickr("#dateEnd", {
			minDate: val,
			maxDate: "2025-12-31",
			dateFormat: "Y-m-d"
		})
	}
</script>

</body>
</html>