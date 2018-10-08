<?php
include 'aksi/ctrl/resto.php';

// login to resto account
if($_GET['id'] !== null) {
	$resto->login($_GET['id']);
}else if($_GET['namaResto'] != null) {
	$resto->login($_GET['namaResto']);
}

function toIdr($angka) {
	return 'Rp. '.strrev(implode('.',str_split(strrev(strval($angka)),3)));
}

$sesi 	= $resto->sesi();
$idresto = $resto->info($sesi, "idresto");
$name 	= $resto->info($sesi, "nama");
$namaPertama = explode(" ", $name)[0];
$phone 	= $resto->info($sesi, "phone");
$icon 	= $resto->info($sesi, "icon");
$cover 	= $resto->info($sesi, "cover");
$address 	= $resto->info($sesi, "address");
$city = $resto->info($sesi, "city");
$web = $resto->info($sesi, "website");
$description = $resto->info($sesi, "description");
$price = $resto->info($sesi, "price");

$pr = explode("|", $price);
$priceFrom = $pr[0];
$priceTo = $pr[1];

setcookie('pakaiAkun', 'resto', time() + 5555, '/');

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
		#priceFrom,#priceTo { width: 80%; }
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
		<!--
		<a href="#"><li>Home</li></a>
		<a href="#"><li>Explore</li></a>
		<a href="#"><li>City</li></a>
		-->
		<a href="../restoran/<?php echo $idresto; ?>" target='_blank'><li>Hello <?php echo $namaPertama; ?> !</li></a>
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
	<div id="rekap">
		<div class="wrap">
			<h4><div id="icon"><i class="fa fa-pencil"></i></div> Detail Information</h4>
			<div class="isi">Hotel description :</div>
			<div><?php echo $description; ?></div>
			<div class="isi">City :</div>
			<div><?php echo $city; ?></div>
			<div class="isi">Phone :</div>
			<div><?php echo $phone; ?></div>
			<div class="isi">Website :</div>
			<div><a href='<?php echo $web; ?>' target='_blank'><?php echo $web; ?></a></div>
			<div class="isi">Address :</div>
			<div><?php echo $address; ?></div>
			<div class="isi">Price :</div>
			<div><?php echo toIdr($priceFrom); ?> - <?php echo toIdr($priceTo); ?></div>
			<div class="isi">Icon</div>
			<?php if($icon != '') { ?>
			<img src="../aset/gbr/<?php echo $icon; ?>" style='width: 40%;'>
			<?php }else { ?>
			No icon
			<?php } ?>
			<div class="isi">Cover</div>
			<?php if($cover != '') { ?>
			<img src="../aset/gbr/<?php echo $cover; ?>" style='width: 40%;'>
			<?php }else { ?>
			No cover
			<?php } ?>
			<div class="bag-tombol" style="margin-top: 35px;">
				<button class="merah-2" id="mengedit">Edit Detail Information</button>
			</div>
		</div>
	</div>
	<form id="formDetil" style="display: none;">
		<div class="wrap">
			<h4><div id="icon"><i class="fa fa-pencil"></i></div> Detail Information</h4>
			<div class="isi">Resto description</div>
			<textarea class='box' id='description'><?php echo $description; ?></textarea>
			<div class="isi">City :</div>
			<input type="text" class="box" id="city" value="<?php echo $city; ?>">
			<div class="isi">Phone :</div>
			<input type="number" class="box" placeholder="e.g 628123456789" id="phone" value="<?php echo $phone; ?>">
			<div class="isi">Website url :</div>
			<input type="text" class="box" id="web" placeholder="e.g https://dailyhotels.id" value="<?php echo $web; ?>">
			<div class="isi">Address :</div>
			<input class="box" id="address" value="<?php echo $address; ?>">
			<input type="hidden" id="latInput">
			<input type="hidden" id="lngInput">
			<div>
				<h3 style="margin-bottom: 0px;">Price</h3>
				<div class="bag bag-5">
					<div class="isi">From (Rp) :</div>
					<input type="number" class="box" id="priceFrom" value="<?php echo $priceFrom; ?>">
				</div>
				<div class="bag bag-5">
					<div class="isi">to (Rp) :</div>
					<input type="number" class="box" id="priceTo" value="<?php echo $priceTo; ?>">
				</div>
			</div>
		</div>
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

<script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyDqYJGuWw9nfoyPG8d9L1uhm392uETE-mA'></script>
<script src="../aset/js/jquery-3.1.1.js"></script>
<script src="../aset/js/locationpicker.jquery.min.js"></script>
<script src="../aset/js/insert.js"></script>
<script src="../aset/js/embo.js"></script>
<script>

	function validUrl(str) {
	    let regExp = /^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/;

	    if(!regExp.test(str)) {
	    	munculPopup("#notif", pengaya("#notif", "top: 200px"))
			tulis("#isiNotif", "URL must be valid!")
			return 'gavalid'
	    }else {
	    	return '1'
	    }
	}
	$('#formDetil').submit(function() {
		let phone = $('#phone').val()
		let address = $('#address').val()
		let city = $('#city').val()
		let web = $('#web').val()
		let description = $('#description').val()
		let latitude = $('#latInput').val()
		let longitude = $('#lngInput').val()
		let priceFrom = $('#priceFrom').val()
		let priceTo = $('#priceTo').val()

		let icons = $('#namaIcon').val()
		let cover = $('#namaCover').val()
		let detil 	= "phone="+phone+"&bag=detil&city="+city+"&web="+web+"&description="+description+"&icon="+icons+"&cover="+cover+"&address="+address+"&priceFrom="+priceFrom+"&priceTo="+priceTo
		if(phone == "" || address == "" || web == "" || city == "") {
			munculPopup("#notif", pengaya("#notif", "top: 225px"))
			tulis("#isiNotif", "All field must be filled")
			return false
		}

		if(validUrl(web) == 'gavalid') {
			return false
		}

		$.ajax({
			type: 'POST',
			url: '../aksi/resto/edit.php',
			data: detil,
			success: function() {
				munculPopup("#saved", pengaya("#saved", "top: 225px"))
				setTimeout(function() {
					location.reload()
				}, 1500)
			}
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
	klik("#mengedit", () => {
		hilang('#rekap')
		muncul('#formDetil')
	})
</script>

</body>
</html>
