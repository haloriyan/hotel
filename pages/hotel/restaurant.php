<?php
include 'aksi/ctrl/event.php';

$sesi 	= $hotel->sesi();
$idhotel = $hotel->get($sesi, "idhotel");
$name 	= $hotel->get($sesi, "nama");
$namaPertama = explode(" ", $name)[0];
$address = $hotel->get($sesi, "address");
$icon 	= $hotel->get($sesi, "icon");
$cover 	= $hotel->get($sesi, "cover");

$addrMin = explode(",", $address);
$addressMin = $addrMin[0];

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
		.sub { top: 80px !important;background-color: #cb0023; }
		#subUser { right: 185px; }
		.sub li {
			line-height: 50px;
		}
		.box { font-size: 17px; }
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
		let add = "name="+name
		pos("../aksi/resto/add.php", add, function() {
			mengarahkan("../resto/wizard&namaResto="+name)
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