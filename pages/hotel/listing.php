<?php
include 'aksi/ctrl/event.php';

$sesi 	= $hotel->sesi();
$idhotel = $hotel->get($sesi, 'idhotel');
$name 	= $hotel->get($sesi, "nama");
$myId 	= $hotel->get($sesi, "idhotel");
$namaPertama = explode(" ", $name)[0];
$address = $hotel->get($sesi, "address");
$icon 	= $hotel->get($sesi, "icon");
$cover 	= $hotel->get($sesi, "cover");

$addrMin = explode(",", $address);
$addressMin = $addrMin[0];

$idevent = $_GET['idevent'];
$namaEvent = $event->info($idevent, "title");

$category = ["Food and Beverage","Room","Venue","Sports and Wellness","Shopping","Recreation","Parties","Others"];
$bulan = [
	'01' => 'January',
	'02' => 'February',
	'03' => 'March',
	'04' => 'April',
	'05' => 'May',
	'06' => 'June',
	'07' => 'July',
	'08' => 'August',
	'09' => 'September',
	'10' => 'October',
	'11' => 'November',
	'12' => 'December'
];
$lompatKe = [
	"dashboard" 	=> "Dashboard",
	"detail"		=> "Detail Information",
	"listing"		=> "My Listings",
	"restaurant"	=> "Restaurant"
];

setcookie('pakaiAkun', 'hotel', time() + 5555, '/');
setcookie('category', '', time() + 1, '/');
setcookie('month', '', time() + 1, '/');

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>My Listing</title>
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
		.container {
			background-color: #fff;
			color: #444;
			border: 1px solid #ccc;
		}
		#myListing img {
			width: 50px;
			height: 50px;
		}
		#myListing li {
			display: inline-block;
			color: #cb0023;
			cursor: pointer;
		}
		td a { font-size: 15px; }
		th {
			text-align: left;
			padding: 5px;
			background-color: #fff;
			border-bottom: 1px solid #ccc;
		}
		td {
			padding: 10px;
			border-bottom: 1px solid #ddd;
			background-color: #fff;
		}
		td h4 { margin-top: 5px; 
		}
		#list-event{
			margin-top: -62px;
		}
		#seeEvent {
			color: #444;
			text-decoration: none;
		}
		#seeEvent:hover { color: #cb0023; }
		select.box {
			padding: 10px 10px;
			height: 45px;
			font-size: 16px;
		}
		.sub { top: 80px !important;background-color: #cb0023; }
		#subUser { right: 185px; }
		.sub li {
			line-height: 50px;
		}
		#myListing #thTitle {
			width: 45%;
		}
		@media(max-width: 720px) {
			#myListing #thTitle {
				width: 1500px;
			}
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
		<a href="./<?php echo $idhotel; ?>" target='_blank'><li id="adaSub">Hello <?php echo $namaPertama; ?> ! &nbsp; <i class="fa fa-angle-down"></i>
			<nav class="sub" id="subUser">
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
	<div class="wrap">
		<h4><div id="icon"><i class="fa fa-home"></i></div> My Listing
			<div class="ke-kanan rata-kanan">
				<div class="bag bag-5">
					Type
					<select class="box" id="loadType" onchange="loadType(this.value)">
						<option value="">All types</option>
						<?php
						foreach ($category as $key => $value) {
							echo "<option>".$value."</option>";
						}
						?>
					</select>
				</div>
				<div class="bag bag-5">
					Held
					<select class="box" id="loadBln" onchange="loadBln(this.value)">
						<option value="">All months</option>
						<?php
						foreach ($bulan as $key => $value) {
							echo "<option value='".$key."'>".$value."</option>";
						}
						?>
					</select>
				</div>
			</div>
		</h4>
		<div id="load"></div>
	</div>
</div>

<div class="bg"></div>
<div class="popupWrapper" id="hapusList">
	<div class="popup">
		<div class="wrap">
			<h3>Deleting listing
				<div class="ke-kanan" id="xHapus"><i class="fa fa-close"></i></div>
			</h3>
			<form id="formHapus">
				<input type="hidden" id="idevent">
				<p id="loadFormHapus">
					Sure want to delete <b><?php echo $namaEvent; ?></b> ?
				</p>
				<div class="bag-tombol">
					<button class="merah-2">Yes, Delete this</button>
				</div>
			</form>
		</div>
	</div>
</div>


<script src="../aset/js/embo.js"></script>
<script>
	function load() {
		ambil("../aksi/event/my.php", function(res) {
			tulis("#load", res)
		})
	}
	function setCookie(name, value) {
		let set = 'namakuki='+name+'&value='+value+'&durasi=3666'
		pos('../aksi/setCookie.php', set, () => {
			load()
		})
	}
	function loadType(val) {
		setCookie('category', val)
	}
	function loadBln(val) {
		setCookie('month', val)
	}
	load()
	klik("#cta", function() {
		mengarahkan("./add-listing")
	})

	function hapus(val) {
		let set = "namakuki=idevent&value="+val+"&durasi=365"
		pos("../aksi/setCookie.php", set, function() {
			munculPopup("#hapusList", pengaya("#hapusList", "top: 200px"))
			ambil("../aksi/event/formHapus.php", function(res) {
				tulis("#loadFormHapus", res)
			})
			pilih("#idevent").value = val
		})
	}

	tekan("Escape", function() {
		hilangPopup("#hapusList")
	})
	klik("#xHapus", function() {
		hilangPopup("#hapusList")
	})

	submit("#formHapus", function() {
		let id = pilih("#idevent").value
		let del = "id="+id
		pos("../aksi/event/delete.php", del, function() {
			hilangPopup("#hapusList")
			load()
		})
		return false
	})
</script>

</body>
</html>