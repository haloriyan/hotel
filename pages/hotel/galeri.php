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
	<title>Galeri</title>
	<link href='../aset/fw/build/fw.css' rel='stylesheet'>
	<link href='../aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='../aset/css/style.index.css' rel='stylesheet'>
	<link href="../aset/css/style.explore-admin.css" rel="stylesheet">
	<style>
		.atas { z-index: 3; }
		.bg { z-index: 4 }
		.galeri {
			width: 31.25%;
			text-align: center;
			display: inline-block;
			margin: 10px 10px;
		}
		.galeri img {
			width: 100%;
			height: 200px;
		}
		.galeri:nth-child(2),.galeri:nth-child(4n + 1),.listAlbum:nth-child(1) { margin-left: 0px; }
		.galeri:nth-child(3n) { margin-right: 0px; }
		.galeri li {
			background: rgba(0,0,0,0.6);
			cursor: pointer;
			display: inline-block;
			margin-top: -155px;
			position: relative;
			top: -35px;
			color: #fff;
			opacity: 0.01;
			padding: 8px 0px;
			width: 100%;
		}
		.galeri:hover li { opacity: 1; }
		#notice,#uploading {
			background-color: #4CAF50;
			padding: 15px 35px;
			color: #fff;
			display: none;
		}
		#uploading { background: none;color: #454545; }

		.listAlbum {
			box-shadow: 1px 1px 5px 1px #ddd;
			padding: 1px;
			margin-bottom: 30px;
		}
		.listAlbum #tblDel {
			list-style: none;
			font-size: 16px;
			cursor: pointer;
			color: #cb0023;
			font-family: OLight;
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
	<a href="./listing"><div class="listWizard" aktif="ya">Gallery</div></a>
	<a href="./facility"><div class="listWizard">Facility</div></a>
	<a href="./social"><div class="listWizard">Social Network</div></a>
	<a href="./restaurant"><div class="listWizard">Restaurant</div></a>
	<a href="./logout"><div class="listWizard">Logout</div></a>
</div>

<div class="container">
	<div>
		<div class="wrap">
			<h4><div id="icon"><i class="fa fa-home"></i></div> Hotel Gallery
				<button id="newAlbum" class="tbl merah-2 ke-kanan"><i class="fa fa-plus-circle"></i> &nbsp; New Album</button>
			</h4>
			<br />
			<div id="hotelGallery">
				<!--
				<div class="galeri">
					<img src="../aset/gbr/dummy.jpg">
					<li><i class="fa fa-trash"></i></li>
				</div>
				-->
			</div>
		</div>
	</div>
</div>

<div class="bg"></div>
<div class="popupWrapper" id="addHotelImage">
	<div class="popup">
		<div class="wrap">
			<h3>Upload New Image for Hotel
				<div class="ke-kanan" id="xUploadHotel"><i class="fa fa-close"></i></div>
			</h3>
			<input type="file" class="box" style="font-size: 16px;" id="hotelImg">
			<input type="hidden" id="hotelImgs">
			<div id="uploading"><i class="fa fa-spinner"></i> &nbsp; Uploading...</div>
			<div id="notice"><i class="fa fa-check"></i> &nbsp; Uploaded</div>
		</div>
	</div>
</div>

<div class="popupWrapper" id="hapusImg">
	<div class="popup">
		<div class="wrap">
			<h3>Delete image
				<div class="ke-kanan" id="xDel"><i class="fa fa-close"></i></div>
			</h3>
			<form id="formHapus">
				<p>
					Sure want delete this image?
				</p>
				<input type="hidden" id="idgambar">
				<div class="bag-tombol">
					<button class="merah-2">Yes, I want!</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="popupWrapper" id='addNewAlbum'>
	<div class="popup">
		<div class="wrap">
			<h3>Create new album
				<div class="ke-kanan" id='xNewAlbum'><i class='fa fa-close'></i></div>
			</h3>
			<form id='formNewAlbum'>
				<div>Album name :</div>
				<input type="text" class='box' id='albumName'>
				<div class="bag-tombol">
					<button class='merah-2'>Create</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="popupWrapper" id='delAlbum'>
	<div class="popup">
		<div class="wrap">
			<h3>Delete Album
				<div class="ke-kanan" id='xDelAlbum'><i class='fa fa-close'></i></div>
			</h3>
			<form id='formDelAlbum'>
				<p>Sure want delete this album?</p>
				<div class="bag-tombol">
					<button class='merah-2'>Yes, I sure!</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="../aset/js/embo.js"></script>
<script src="../aset/js/jquery-3.1.1.js"></script>
<script src="../aset/js/insert.js"></script>
<script>
	function loadHotel() {
		ambil("../aksi/galeri/loadHotel.php", function(res) {
			tulis("#hotelGallery", res)
		})
	}
	function delAlbum(val) {
		let set = "namakuki=idalbum&value="+val+"&durasi=3666"
		pos("../aksi/setCookie.php", set, () => {
			munculPopup("#delAlbum", pengaya("#delAlbum", "top: 190px"))
		})
	}

	loadHotel()

	let allowed = ["jpg","jpeg","png","bmp","JPG","PNG","JPEG","BMP"]
	klik("#cta", function() {
		mengarahkan("./add-listing")
	})
	pilih("#hotelImg").onchange = function() {
		muncul("#uploading")
		setTimeout(function() {
			hilang("#uploading")
			muncul("#notice")
		}, 1850)
		setTimeout(function() {
			hilang("#notice")
		}, 3200)
	}
	$("#hotelImg").on("change", function() {
		var hotelImg = $("#hotelImg").val();
		var p = hotelImg.split("fakepath");
		var nama = p[1].substr(1, 2585);
		$("#hotelImgs").val(nama);
		let hotelImgExt = getExt(nama)
		if(!inArray(hotelImgExt, allowed)) {
			$("#hotelImg").val("")
			alert("Image format not allowed!")
			return false
		}

		var file = $(this)[0].files[0];
		var upload = new Upload(file);
		upload.doUpload();

		muncul("#uploading")
	})

	function sukses() {
		let gambar = pilih("#hotelImgs").value
		let change = "tipe=hotel&gambar="+gambar
		pos("../aksi/galeri/tambah.php", change, function() {
			hilang("#uploading")
			muncul("#notice")
			setTimeout(function() {
				hilang("#notice")
			}, 1800)
			$("#hotelImg").val("")
			loadHotel()
		})
	}

	tekan("Escape", function() {
		hilangPopup("#addHotelImage")
		hilangPopup("#hapusImg")
		hilangPopup("#addNewAlbum")
		hilangPopup("#delAlbum")
	})
	klik("#xUploadHotel", function() {
		hilangPopup("#addHotelImage")
	})
	klik("#xDel", function() {
		hilangPopup("#hapusImg")
	})
	klik("#xNewAlbum", () => {
		hilangPopup("#addNewAlbum")
	})

	function getExt(val) {
		let re =/(?:\.([^.]+))?$/
		let ext = re.exec(val)[1]
		return ext
	}

	function hapus(val) {
		let del = "namakuki=idgambar&value="+val+"&durasi=3666"
		pos("../aksi/setCookie.php", del, function() {
			pilih("#idgambar").value = val
			munculPopup("#hapusImg", pengaya("#hapusImg", "top: 220px"))
		})
	}

	klik("#newAlbum", () => {
		munculPopup("#addNewAlbum", pengaya("#addNewAlbum", "top: 170px"))
	})

	submit("#formHapus", function() {
		let id = pilih("#idgambar").value
		let del = "idgambar="+id
		pos("../aksi/galeri/delete.php", del, function() {
			hilangPopup("#hapusImg")
			loadHotel()
		})
		return false
	})
	submit("#formNewAlbum", () => {
		let name = pilih("#albumName").value
		let crt = "name="+name
		pos("../aksi/galeri/createAlbum.php", crt, () => {
			hilangPopup("#addNewAlbum")
			loadHotel()
			pilih("#albumName").value = ""
		})
		return false
	})
	submit("#formDelAlbum", () => {
		pos("../aksi/galeri/deleteAlbum.php", "", () => {
			hilangPopup("#delAlbum")
			loadHotel()
		})
		return false
	})
</script>

</body>
</html>