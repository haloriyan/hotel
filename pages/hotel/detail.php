<?php
include 'aksi/ctrl/event.php';

$sesi 	= $hotel->sesi();
$idhotel = $hotel->get($sesi, 'idhotel');
$name 	= $hotel->get($sesi, "nama");
$namaPertama = explode(" ", $name)[0];
$phone 	= $hotel->get($sesi, "phone");
$icon 	= $hotel->get($sesi, "icon");
$cover 	= $hotel->get($sesi, "cover");
$address 	= $hotel->get($sesi, "address");
$city = $hotel->get($sesi, "city");
$web = $hotel->get($sesi, "website");
$description = $hotel->get($sesi, "description");
$coords = $hotel->get($sesi, "coords");
if($coords == "") {
	$defaultCoords = "(This is default address)";
}

$addrMin = explode(",", $address);
$addressMin = $addrMin[0];

$c = explode("|", $coords);
$lat = $c[0];
$lng = $c[1];
if($lat == '') {
	$lat = '-7.256317699999999';
}
if($lng == '') {
	$lng = '112.73762540000007';
}

$cities = ['Bali','Bandung','Batam','Bogor','Jakarta','Jakarta','Lombok','Makassar','Malang','Pekalongan','Semarang','Solo','Surabaya','Yogyakarta'];

setcookie('pakaiAkun', 'hotel', time() + 5555, '/');

$lompatKe = [
	"dashboard" 	=> "Dashboard",
	"detail"		=> "Detail Information",
	"listing"		=> "My Listings",
	"restaurant"	=> "Restaurant",
];

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
	<div id="tblMenu" aksi="bkMenu"><i class="fa fa-bars"></i></div>
	<div class="pencarian">
		<i class="fa fa-search"></i>
		<input type="text" class="box" placeholder="Type your search...">
	</div>
	<nav class="menu">
		<a href="./<?php echo $idhotel; ?>" target='_blank'><li id="adaSub">Hello <?php echo $namaPertama; ?> ! &nbsp; <i class="fa fa-angle-down"></i>
			<nav class="sub merah-2" id="subUser">
				<a href="./dashboard"><li><div id="icon"><i class="fa fa-home"></i></div> Dashboard</li></a>
				<a href="./detail"><li><div id="icon"><i class="fa fa-user"></i></div> Profile</li></a>
				<a href="./listing"><li><div id="icon"><i class="fa fa-pencil"></i></div> Listing</li></a>
				<a href="./restaurant"><li><div id="icon"><i class="fa fa-cutlery"></i></div> Restaurant</li></a>
				<a href="./logout"><li><div id="icon"><i class="fa fa-sign-out"></i></div> Logout</li></a>
			</nav>
		</li></a>
		<button id="cta" class="tbl"><i class="fa fa-plus-circle"></i> Add Listing</button>
	</nav>
</div>

<select class="box" id="lompatKe" onchange="mengarahkan('../hotel/'+this.value)">
	<?php
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

<?php include 'kiriProfile.php'; ?>

<div class="container">
	<div class="tabs">
		<div class="wrap">
			<a href="#"><div class="tab" aktif='ya'><i class="fa fa-pencil"></i></div></a>
			<a href="./galeri"><div class="tab"><i class="fa fa-image"></i></div></a>
			<a href="./facility"><div class="tab"><i class="fa fa-cogs"></i></div></a>
			<a href="./social"><div class="tab"><i class="fa fa-user"></i></div></a>
		</div>
	</div>
	<div id="rekap" style="margin-top: 120px;">
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
			<div class="isi">Address : <?php echo $defaultCoords; ?></div>
			<input id="addressStaticInput" class="box" style="border: none;background: none;" readonly>
			<input type="hidden" id="latInputStatic" value="<?php echo $lat; ?>">
			<input type="hidden" id="lngInputStatic" value="<?php echo $lng; ?>">
			<div id="addressStatic" style="height: 300px"></div>
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
		<div class="wrap" style="margin-top: 55px !important;">
			<h4 style=""><div id="icon"><i class="fa fa-pencil"></i></div> Detail Information</h4>
			<div class="isi">Hotel description :</div>
			<textarea class='box' id='description'><?php echo $description; ?></textarea>
			<div class="isi">City :</div>
			<!--
			<input type="text" class="box" id="city" value="<?php echo $city; ?>">
			-->
			<select class="box" id="city" onchange="changeCity(this.value)">
				<?php
				if(!in_array($city, $cities)) {
					echo '<option selected>'.$city.'</option>';
				}
				foreach ($cities as $key => $value) {
					if($value == $city) {
						$selected = 'selected';
					}else {
						$selected = '';
					}
					echo '<option '.$selected.'>'.$value.'</option>';
				}
				?>
				<option value="other">Other</option>
			</select>
			<div id="generateCity"><input type="text" class="box" id="citys" style="display: none;" placeholder="Type city..."></div>
			<div class="isi">Phone :</div>
			<input type="number" class="box" placeholder="e.g 628123456789" id="phone" value="<?php echo $phone; ?>" min="1">
			<div class="isi">Website url :</div>
			<input type="text" class="box" id="web" placeholder="e.g https://dailyhotels.id" value="<?php echo $web; ?>">
			<div class="isi">Address :</div>
			<input class="box" id="address" value="<?php echo $address; ?>">
			<div id="myMaps" style="height: 300px;"></div>
			<input type="hidden" id="latInput">
			<input type="hidden" id="lngInput">
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

<script type="text/javascript" src='https://maps.google.com/maps/api/js?libraries=places&key=AIzaSyDqYJGuWw9nfoyPG8d9L1uhm392uETE-mA'></script>
<script src="../aset/js/jquery-3.1.1.js"></script>
<script src="../aset/js/locationpicker.jquery.min.js"></script>
<script src="../aset/js/insert.js"></script>
<script src="../aset/js/embo.js"></script>
<script>
	klik("#tblMenu", function() {
		let tbl = pilih("#tblMenu")
		let aksi = tbl.getAttribute("aksi")
		if(aksi == "bkMenu") {
			pengaya(".menu", "left: 0%")
			tbl.setAttribute("aksi", "xMenu")
		}else {
			pengaya(".menu", "left: 100%")
			tbl.setAttribute("aksi", "bkMenu")
		}
	})
	function getPlaceName(setLat, setLng) {
		let geocoder = new google.maps.Geocoder
		let latLng = { lat: parseFloat(setLat), lng: parseFloat(setLng) }

		geocoder.geocode({
			'location': latLng,
		}, function(results, status) {
			if(status === 'OK') {
				let formattedAddr = results[0].formatted_address
				$("#addressStaticInput").val(formattedAddr)
				$("#address").val(formattedAddr)
			}else {
				// alert('No result foound')
			}
		})
	}
	let setLat = $("#latInputStatic").val()
	let setLng = $("#lngInputStatic").val()
	setTimeout(function() {
		getPlaceName(setLat, setLng)
	}, 700)

	$('#myMaps').locationpicker({
		location: {
			latitude: <?php echo $lat; ?>,
			longitude: <?php echo $lng; ?>
		},
		radius: 0,
		inputBinding: {
			latitudeInput: $('#latInput'),
			longitudeInput: $('#lngInput'),
			locationNameInput: $("#address")
		},
		onchanged: function() {
			getPlaceName($('#latInput').val(), $('#lngInput').val())
		},
		enableAutocomplete: true,
	})
	$('#addressStatic').locationpicker({
		location: {
			latitude: <?php echo $lat; ?>,
			longitude: <?php echo $lng; ?>
		},
		radius: 0,
		onchanged: function() {
			//
		},
		enableAutocomplete: true,
	})
	function validUrl(str) {
	    let regExp = /^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/;

	    if(!regExp.test(str)) {
	    	munculPopup("#notif", pengaya("#notif", "top: 200px"))
			tulis("#isiNotif", "URL must be valid!")
			return false
	    }
	}
	function changeCity(val) {
		if(val == 'other') {
			// generate
			muncul('#citys')
		}else {
			hilang("#citys")
		}
	}
	$('#formDetil').submit(function() {
		let phone = $('#phone').val()
		let address = encodeURIComponent($('#address').val())
		let city = $('#city').val()
		if(city == 'other') {
			city = $('#citys').val()
		}
		let web = $('#web').val()
		let description = $('#description').val()
		let latitude = $('#latInput').val()
		let longitude = $('#lngInput').val()

		let icons = $('#namaIcon').val()
		let cover = $('#namaCover').val()
		let detil 	= "phone="+phone+"&bag=detil&city="+city+"&web="+web+"&description="+description+"&icon="+icons+"&cover="+cover+"&lat="+latitude+"&lng="+longitude+"&address="+address
		if(phone == "") {
			munculPopup("#notif", pengaya("#notif", "top: 225px"))
			tulis("#isiNotif", "Phone must be filled")
			return false
		}
		if(address == "") {
			munculPopup("#notif", pengaya("#notif", "top: 225px"))
			tulis("#isiNotif", "Address must be filled")
			return false
		}
		if(web == "") {
			munculPopup("#notif", pengaya("#notif", "top: 225px"))
			tulis("#isiNotif", "Website must be filled")
			return false
		}
		if(city == "") {
			munculPopup("#notif", pengaya("#notif", "top: 225px"))
			tulis("#isiNotif", "City must be filled")
			return false
		}

		validUrl(web)

		$.ajax({
			type: 'POST',
			url: '../aksi/hotel/edit.php',
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
		console.log(nama+' was uploaded')
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
			console.log('uploaded')
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
	function save(val) {
		let save = "idfac="+val+"&bag=facility"
		pos("../aksi/hotel/edit.php", save, function() {
			muncul("#saved")
			setTimeout(function() {
				hilang("#saved")
			}, 1200)
		})
	}
	klik("#mengedit", () => {
		hilang('#rekap')
		muncul('#formDetil')
	})
</script>

</body>
</html>
