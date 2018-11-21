<?php
include 'aksi/ctrl/hotel.php';

$sesi 	= $hotel->sesi();
$name 	= $hotel->get($sesi, "nama");
$idhotel = $hotel->get($sesi, 'idhotel');
$namaPertama = explode(" ", $name)[0];

$lompatKe = [
	"dashboard" 	=> "Dashboard",
	"detail"		=> "Detail Information",
	"listing"		=> "My Listings",
	"restaurant"	=> "Restaurant"
];

setcookie('pakaiAkun', 'hotel', time() + 5555, '/');
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
			float: left;
			margin: 10px 10px;
		}
		.galeri img {
			width: 100%;
			height: 200px;
		}
		.galeri:nth-child(3),.galeri:nth-child(4n + 1),.listAlbum:nth-child(1) { margin-left: 0px; }
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
			background: none;
			border: none;
			list-style: none;
			font-size: 16px;
			cursor: pointer;
			color: #cb0023;
			font-family: OSans;
		}
		#popupSeeImage {
			left: 10%;width: 80%;text-align: center;
		}
		#popupSeeImage .popup {
			background: none !important;
		}
		.sub { top: 80px !important;background-color: #cb0023; }
		#subUser { right: 185px; }
		.sub li {
			line-height: 50px;
		}
		#lompatKe { font-size: 16px; }
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
		<a href="./<?php echo $idhotel; ?>" target='_blank'><li id="adaSub">Hello <?php echo $namaPertama; ?> ! &nbsp; <i class="fa fa-angle-down"></i>
			<nav class="sub" id="subUser">
				<a href="./detail"><li><div id="icon"><i class="fa fa-cog"></i></div> Settings</li></a>
				<a href="./galeri"><li><div id="icon"><i class="fa fa-image"></i></div> Gallery</li></a>
				<a href="./facility"><li><div id="icon"><i class="fa fa-cogs"></i></div> Facility</li></a>
				<a href="./social"><li><div id="icon"><i class="fa fa-user"></i></div> Social</li></a>
				<a href="./logout"><li><div id="icon"><i class="fa fa-sign-out"></i></div> Logout</li></a>
			</nav>
		</li></a>
		<button id="cta" class="tbl"><i class="fa fa-plus-circle"></i> Add Listing</button>
	</nav>
</div>
<select class="box" id="lompatKe" onchange="mengarahkan('../hotel/'+this.value)">
	<?php
	if($bag == "galeri" or $bag == "facility" or $bag == "social") {
		$bag = "detail";
	}
	foreach ($lompatKe as $key => $value) {
		if($bag == $key) {
			$selected = 'selected';
		}else {
			$selected = '';
		}
		echo "<option value='".$key."' ".$selected.">".$value."</option>";
	}
	?>
</select>

<div class="kiri">
	<a href="./dashboard"><div class="listWizard">Dashboard</div></a>
	<a href="./detail"><div class="listWizard" aktif='ya'>Detail Information</div></a>
	<a href="./listing"><div class="listWizard">My Listings</div></a>
	<a href="./restaurant"><div class="listWizard">Restaurant</div></a>
	<a href="./logout"><div class="listWizard">Logout</div></a>
</div>

<div class="container">
	<div class="tabs">
		<div class="wrap">
			<a href="./detail"><div class="tab"><i class="fa fa-pencil"></i></div></a>
			<a href="#"><div class="tab" aktif='ya'><i class="fa fa-image"></i></div></a>
			<a href="./facility"><div class="tab"><i class="fa fa-cogs"></i></div></a>
			<a href="./social"><div class="tab"><i class="fa fa-user"></i></div></a>
		</div>
	</div>
	<div style="margin-top: 120px;">
		<div class="wrap">
			<h4><div id="icon"><i class="fa fa-image"></i></div> Hotel Gallery
				<button id="newAlbum" class="tbl merah-2 ke-kanan"><i class="fa fa-plus-circle"></i> &nbsp; New Album</button>
			</h4>
			<br />
			<div id="hotelGallery"></div>
		</div>
	</div>
</div>

<div class="bg"></div>
<div id="addPhoto" class='popupWrapper'>
	<div class="popup">
		<div class="wrap">
			<h3>Upload Photo for <span id='namaAlbum'></span>
				<div class="ke-kanan" id="xUploadHotel"><i class="fa fa-close"></i></div>
			</h3>
			<form id='uploadPhoto'>
				<input type="hidden" id='idalbum'>
				<input type="hidden" id="hotelImgs">
				<input type="file" class='box' style='font-size: 16px' id='hotelImg'>
				<div id="uploading"><i class="fa fa-spinner"></i> &nbsp; Uploading...</div>
				<div id="notice"><i class="fa fa-check"></i> &nbsp; Uploaded</div>
			</form>
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

<div class="popupWrapper" id="popupSeeImage">
	<div class="popup">
		<div class="wrap">
			<div>
				<div class="ke-kanan" id="xSeeImage" style="color: #fff;font-size: 25px;"><i class="fa fa-close"></i></div>
			</div>
			<img src="" id="myImage">
		</div>
	</div>
</div>

<script src="../aset/js/embo.js"></script>
<script src="../aset/js/jquery-3.1.1.js"></script>
<script src="../aset/js/insert.js"></script>
<script>
	function loadAlbum(val) {
		let set = "namakuki=idalbum&value="+val+"&durasi=3666"
		pos("../aksi/setCookie.php", set, () => {
			ambil("../aksi/galeri/loadAlbum.php", (res) => {
				tulis("#hotelGallery", res)
			})
		})
		let setPublic = "namakuki=public&value=0&durasi=1"
		pos("../aksi/setCookie.php", setPublic, () => {
			console.log("hello")
		})
	}
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
	function addPhoto(idAlbum, namaAlbum) {
		munculPopup("#addPhoto", pengaya("#addPhoto", "top: 220px"))
		pilih("#idalbum").value = idAlbum
		tulis("#namaAlbum", namaAlbum)
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
		let idalbum = pilih("#idalbum").value
		let gambar = pilih("#hotelImgs").value
		let change = "tipe=hotel&gambar="+gambar+"&idalbum="+idalbum
		pos("../aksi/galeri/tambah.php", change, function() {
			hilang("#uploading")
			muncul("#notice")
			setTimeout(function() {
				hilang("#notice")
			}, 1800)
			$("#hotelImg").val("")
			loadAlbum(idalbum)
		})
	}

	tekan("Escape", function() {
		hilangPopup("#addPhoto")
		hilangPopup('#popupSeeImage')
		hilangPopup("#hapusImg")
		hilangPopup("#addNewAlbum")
		hilangPopup("#delAlbum")
	})
	klik("#xUploadHotel", function() {
		hilangPopup("#addPhoto")
	})
	klik("#xDel", function() {
		hilangPopup("#hapusImg")
	})
	klik("#xNewAlbum", () => {
		hilangPopup("#addNewAlbum")
	})
	klik("#xDelAlbum", () => {
		hilangPopup("#delAlbum")
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
		let idalbum = pilih("#idalbums").value
		let id = pilih("#idgambar").value
		let del = "idgambar="+id
		pos("../aksi/galeri/delete.php", del, function() {
			hilangPopup("#hapusImg")
			loadAlbum(idalbum)
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
	function seeImage(img) {
		munculPopup('#popupSeeImage', pengaya('#popupSeeImage', 'top: 70px'))
		pilih("#myImage").setAttribute('src', '../aset/gbr/'+img)
	}
	klik('#xSeeImage', () => {
		hilangPopup('#popupSeeImage')
	})
</script>

</body>
</html>