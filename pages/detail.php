<?php
include 'aksi/ctrl/event.php';

$sesi 	= $user->sesi(1);
$name 	= $user->info($sesi, "nama");
$phone 	= $user->info($sesi, "telepon");
$address 	= $user->info($sesi, "alamat");
$myCity 	= $user->info($sesi, "city");
$namaPertama = explode(" ", $name)[0];

$city = ["Bali","Bandung","Jakarta","Lombok","Makassar","Malang","Semarang","Surabaya","Yogyakarta"];
$cities = ["Bali","Bandung","Batam","Bogor","Jakarta","Lombok","Makassar","Malang","Pekalongan","Semarang","Solo","Surabaya","Yogyakarta"];
$category = ["Food and Beverage","Room","Venue","Sports and Wellness","Shopping","Recreation","Parties","Others"];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>Detail Information</title>
	<link href='aset/fw/build/fw.css' rel='stylesheet'>
	<link href='aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='aset/css/style.index.css' rel='stylesheet'>
	<link href="aset/css/tambahanIndex.css" rel="stylesheet">
	<link href="aset/css/style.explore-admin.css" rel="stylesheet">
	<style>
		body { background-color: #ecf0f1 !important; }
		.container { margin-bottom: 45px; }
		.box { width: 99.9%;font-size: 16px;height: 50px;color: #555; }
		.bg { z-index: 4; }
		.atas { z-index: 3; }
		.popup { border-radius: 6px; }
	</style>
</head>
<body>

<div class="atas merah-2">
	<img src= "aset/gbr/logo.png" class="logoHome">
	<div class="pencarian">
		<i class="fa fa-search"></i>
		<input type="text" class="box" placeholder="Type your search...">
	</div>
	<nav class="menu">
		<a href="./"><li>Home</li></a>
		<a href="./explore"><li id="adaSub">Explore &nbsp; <i class="fa fa-angle-down"></i>
			<nav class="sub" id="subCat">
				<?php
				foreach ($category as $key => $value) {
					echo "<a href='./explore&q=&cat=".$value."'><li>".$value."</li></a>";
				}
				?>
			</nav>
		</li></a>
		<a href="#"><li id="adaSub">City &nbsp; <i class="fa fa-angle-down"></i>
			<nav class="sub" id="subCity">
				<?php
				foreach ($city as $key => $value) {
					echo "<a href='./explore&q=&cat=&city=".$value."'><li>".$value."</li></a>";
				}
				?>
			</nav>
		</li></a>
		<li>Hello <?php echo $namaPertama; ?> !</li>
	</nav>
</div>

<div class="kiri">
	<a href="./hello"><div class="listWizard">Dashboard</div></a>
	<a href="./my"><div class="listWizard">My Listings</div></a>
	<a href="./detail"><div class="listWizard" aktif="ya">Detail Information</div></a>
	<a href="./logout"><div class="listWizard">Logout</div></a>
</div>

<div class="container">
	<div>
		<div class="wrap">
			<h4><div id="icon">&nbsp;<i class="fa fa-pencil"></i>&nbsp;</div> Detail Information</h4>
			<div id="formView">
				<div class="isi">Name :</div>
				<div><?php echo $name; ?></div>
				<div class="isi">Phone :</div>
				<div><?php echo $phone; ?></div>
				<div class="isi">Address :</div>
				<div><?php echo $address; ?></div>
				<div class="isi">City :</div>
				<div><?php echo $myCity; ?></div>
				<div class="bag-tombol" style="margin-top: 25px;">
					<button class="merah-2" id="btnEdit">Edit</button>
				</div>
			</div>
			<form id="formDetail" style="display: none;">
				<div class="isi">Name :</div>
				<input type="text" class="box" id="name" autocomplete="off" value="<?php echo $name; ?>" required>
				<div class="isi">Phone :</div>
				<input type="number" class="box" id="phone" autocomplete="off" value="<?php echo $phone; ?>" required>
				<div class="isi">Address :</div>
				<textarea class="box" id="address" autocomplete="off"><?php echo $address; ?></textarea>
				<div class="isi">City :</div>
				<select class="box" id="city" required onchange="cekCity(this.value)">
					<option value="">Select city...</option>
					<?php
					if(!in_array($myCity, $cities) && $myCity != "") {
						echo "<option selected>".$myCity."</option>";
					}
					foreach ($cities as $key => $value) {
						if($myCity == $value) {
							$selected = 'selected';
						}else {
							$selected = '';
						}
						echo "<option ".$selected.">".$value."</option>";
					}
					?>
					<option>Other</option>
				</select>
				<input type="text" class="box" id="otherCity" placeholder="Input city..." style="display: none;">
				<br /><br />
				<button class="tbl merah-2">Save</button>
			</form>
		</div>
	</div>
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

<script src="aset/js/emboBaru.js"></script>
<script>
	function cekCity(val) {
		if(val == "Other") {
			$("#otherCity").muncul()
		}else {
			$("#otherCity").hilang()
		}
	}
	submit("#formDetail", function() {
		let name = $("#name").isi()
		let phone = $("#phone").isi()
		let address = $("#address").isi()
		let city = $("#city").isi()
		if(city == "Other") {
			city = $("#otherCity").isi()
			if(city == "") {
				alert('All field must be filled!')
				return false
			}
		}
		let detail = "name="+name+"&phone="+phone+"&address="+address+"&city="+city
		pos("aksi/user/change.php", detail, function() {
			munculPopup("#saved", $("#saved").pengaya("top: 210px"))
			setTimeout(function() {
				location.reload()
			}, 1100)
		})
		return false
	})

	tekan("Escape", function() {
		hilangPopup("#saved")
	})
	$("#xNotif").klik(function() {
		hilangPopup("#saved")
	})

	$("#btnEdit").klik(function() {
		$("#formView").hilang()
		$("#formDetail").muncul()
	})
</script>

</body>
</html>
