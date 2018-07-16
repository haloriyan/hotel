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
	<title>Add Listing</title>
	<link href='../aset/fw/build/fw.css' rel='stylesheet'>
	<link href='../aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='../aset/css/style.index.css' rel='stylesheet'>
	<link href="../aset/css/style.explore-admin.css" rel="stylesheet">
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
		<a href="./listing"><li>Listing</li></a>
		<a href="./detail"><li>Setting</li></a>
		<a href="./logout"><li>Sign out</li></a>
	</nav>
</div>

<div class="kiri">
	<div class="listWizard" id="kebasic" aktif="ya">Add Listing</div>
	<div class="listWizard" id="keimage">Event Image</div>
	<div class="listWizard" id="kelocation">Location</div>
	<div class="listWizard" id="kedetail">Event Details</div>
	<div class="listWizard" id="keprice">Price</div>
</div>

<div class="container">
	<?php
	$status = $hotel->get($sesi, "status");
	if($status == "2") { ?>
		<form id="error!">
			<div class="wrap">
				<h4><div id="icon"><i class="fa fa-close"></i></div> ERROR :(</h4>
				<p>
					Sorry, you can't add a listing. Your account hasn't been verified by admin. Wait until admin verifying your account then you can add new listing
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
			<div class="isi">Logo (optional)</div>
			<input type="file" class="box" id="logo">
			<div class="isi">Cover (optional)</div>
			<input type="file" class="box" id="cover"><br />
			<input type="hidden" id="logos">
			<input type="hidden" id="covers">
			<button class="tbl merah-2">NEXT</button>
		</div>
	</form>
	<form id="location">
		<div class="wrap">
			<h4><div id="icon"><i class="fa fa-map-marker"></i></div> Location</h4>
			<div class="isi">Region</div>
			<input type="text" class="box" id="region">
			<div class="isi">Address</div>
			<textarea class="box" id="address"></textarea><br />
			<button class="tbl merah-2">NEXT</button>
		</div>
	</form>
	<form id="detail">
		<div class="wrap">
			<h4><div id="icon"><i class="fa fa-map-marker"></i></div> Event Details</h4>
			<div class="isi">Date Start</div>
			<input type="date" class="box" placeholder="yyyy-mm-dd" id="date" data-date-format="YYYY MM DD">
			<div class="isi">Date End</div>
			<input type="date" class="box" placeholder="yyyy-mm-dd" id="dateEnd" data-date-format="YYYY MM DD">
			<div class="isi">Category</div>
			<select class="box" id="category">
				<option>Food and Beverage</option>
				<option>Room</option>
				<option>Venue</option>
				<option>Sports and Wellness</option>
				<option>Shopping</option>
				<option>Recreation</option>
				<option>Parties</option>
			</select>
			<br />
			<button class="tbl merah-2">NEXT</button>
		</div>
	</form>
	<form id="price">
		<div class="wrap">
			<h4><div id="icon"><i class="fa fa-map-marker"></i></div> Price</h4>
			<div class="isi">Pricing</div>
			<input type="text" class="box" id="priceBox" placeholder='e.g "140000"'>
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
<script src="../aset/js/insert.js"></script>
<script>
	function hilangKecuali(y) {
		hilang("#basic")
		hilang("#image")
		hilang("#location")
		hilang("#detail")
		hilang("#price")
		muncul("#" + y)

		pilih("#kebasic").setAttribute("aktif", "tidak")
		pilih("#keimage").setAttribute("aktif", "tidak")
		pilih("#kelocation").setAttribute("aktif", "tidak")
		pilih("#kedetail").setAttribute("aktif", "tidak")
		pilih("#keprice").setAttribute("aktif", "tidak")
		pilih("#ke" + y).setAttribute("aktif", "ya")
	}
	function publish() {
		let title = encodeURIComponent(pilih("#title").value)
		let tagline = encodeURIComponent(pilih("#tagline").value)
		let description = encodeURIComponent(pilih("#description").value)
		let logo = pilih("#logos").value
		let cover = pilih("#covers").value
		let region = pilih("#region").value
		let address = encodeURIComponent(pilih("#address").value)
		let date = pilih("#date").value
		let dateEnd = pilih("#dateEnd").value
		let category = pilih("#category").value
		let price = pilih("#priceBox").value
		let pub = "title="+title+"&tagline="+tagline+"&description="+description+"&logo="+logo+"&cover="+cover+"&region="+region+"&address="+address+"&tgl="+date+"&tgl_akhir="+dateEnd+"&category="+category+"&price="+price
		if(title == "" || tagline == "" || description == "" || logo == "" || cover == "" || region == "" || address == "" || date == "" || category == "" || price == "") {
			munculPopup("#notif", pengaya("#notif", "top: 225px"))
			tulis("#isiNotif", "All field must be filled")
			return false
		}
		pos("../aksi/event/create.php", pub, function() {
			mengarahkan("./listing")
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
		hilangKecuali("image")
		return false
	})
	submit("#image", function() {
		let allowed = ["jpg","jpeg","png","bmp"]
		let logo = pilih("#logos").value
		let cover = pilih("#covers").value
		let logoExt = getExt(logo)
		let coverExt = getExt(cover)
		if(logo == "" || cover == "") {
			munculPopup("#notif", pengaya("#notif", "top: 225px"))
			tulis("#isiNotif", "You must insert an image for logo and cover")
			return false
		}
		hilangKecuali("location")
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
		hilangKecuali("detail")
		return false
	})
	submit("#detail", function() {
		let date = pilih("#date").value
		let cat = pilih("#category").value
		if(date == "" || cat == "") {
			munculPopup("#notif", pengaya("#notif", "top: 225px"))
			tulis("#isiNotif", "All field must be filled")
			return false
		}
		hilangKecuali("price")
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

	klik("#kebasic", function() {
		hilangKecuali("basic")
	})
	klik("#keimage", function() {
		hilangKecuali("image")
	})
	klik("#kelocation", function() {
		hilangKecuali("location")
	})
	klik("#kedetail", function() {
		hilangKecuali("detail")
	})
	klik("#keprice", function() {
		hilangKecuali("price")
	})

	$("#logo").on("change", function() {
		let allowed = ["jpg","jpeg","png","bmp"]
		var logo = $("#logo").val();
		var p = logo.split("fakepath");
		var nama = p[1].substr(1, 2585);
		$("#logos").val(nama);
		let logoExt = getExt(nama)
		if(!inArray(logoExt, allowed)) {
			$("#logo").val("")
			munculPopup("#notif", pengaya("#notif", "top: 225px"))
			tulis("#isiNotif", "Image format not allowed")
			return false
		}

		var file = $(this)[0].files[0];
		var upload = new Upload(file);
		upload.doUpload();
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
</script>

</body>
</html>