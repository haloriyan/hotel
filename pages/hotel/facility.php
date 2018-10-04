<?php
include 'aksi/ctrl/hotel.php';

$sesi 	= $hotel->sesi();
$idhotel 	= $hotel->get($sesi, "idhotel");
$name 	= $hotel->get($sesi, "nama");
$namaPertama = explode(" ", $name)[0];

$facility = [
	"1" => "Wireless Internet",
	"2" => "Parking Street",
	"3" => "Smoking Allowed",
	"4" => "Accept Credit Cards",
	"5" => "Bike Parking",
	"6" => "Coupons"
];

$myFacility = $hotel->get($sesi, "facility");
$fac = explode(",", $myFacility);

setcookie('pakaiAkun', 'hotel', time() + 5555, '/');

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>Facility</title>
	<link href='../aset/fw/build/fw.css' rel='stylesheet'>
	<link href='../aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='../aset/css/style.index.css' rel='stylesheet'>
	<link href="../aset/css/style.explore-admin.css" rel="stylesheet">
	<style>
		#saved {
			padding: 15px 35px;
			background: rgba(76, 175, 80, 0.85);
			color: #fff;
			margin-bottom: -35px;
			margin-top: 10px;
			display: none;
		}
		.sub { top: 80px !important;background-color: #cb0023; }
		#subUser { right: 185px; }
		.sub li {
			line-height: 50px;
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
			<a href="./galeri"><div class="tab"><i class="fa fa-image"></i></div></a>
			<a href="#"><div class="tab" aktif='ya'><i class="fa fa-cogs"></i></div></a>
			<a href="./social"><div class="tab"><i class="fa fa-user"></i></div></a>
		</div>
	</div>
	<form id="formFac" style="margin-top: 120px;">
		<div class="wrap">
			<h4><div id="icon"><i class="fa fa-cogs"></i></div> Facility</h4>
			<table>
				<thead>
					<tr>
						<th style="width: 10%">Status</th>
						<th>Facility</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($facility as $key => $value) {
						if(in_array($key, $fac)) {
							$checked = "checked";
						}else {
							$checked = "";
						}
						echo "<tr>".
								"<td><input type='checkbox' name='facilities' class='fac' value='".$key."' id='facilities".$key."' onclick='save(this.value)' ".$checked."></span></td>".
								"<td><label for='facilities".$key."'>".$value."</label></td>".
							 "</tr>";
					}
					?>
				</tbody>
				</table>
			<div id="saved">
				<i class="fa fa-check"></i> &nbsp;Saved
			</div>
			<br /><br />
		</div>
	</form>
</div>

<script src="../aset/js/embo.js"></script>
<script src="../aset/js/jquery-3.1.1.js"></script>
<script>
	klik("#cta", function() {
		mengarahkan("./add-listing")
	})
	pilih("#formFac").onsubmit = function() {
		let tes = $("input[name=facilities]").val()
		console.log(tes)
		return false
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
</script>

</body>
</html>