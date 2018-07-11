<?php
include 'aksi/ctrl/hotel.php';

$sesi 	= $hotel->sesi();
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
	<div class="listWizard" aktif="ya">Dashboard</div>
	<a href="./listing"><div class="listWizard">My Listings</div></a>
	<a href="./detail"><div class="listWizard">Detail Information</div></a>
	<a href="./social"><div class="listWizard">Social Network</div></a>
	<a href="./logout"><div class="listWizard">Logout</div></a>
</div>

<div class="container">
	<form id="formFac">
		<div class="wrap">
			<h4><div id="icon"><i class="fa fa-home"></i></div> Facility</h4>
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
						echo "<tr>".
								"<td><input type='checkbox' name='facilities' class='fac' value='".$key."' id='facilities".$key."'></span></td>".
								"<td><label for='facilities".$key."'>".$value."</label></td>".
							 "</tr>";
					}
					?>
				</tbody>
				</table>
			<button class="ke-kanan tbl merah-2">Save</button>
			<br /><br />
		</div>
	</form>
</div>

<script src="../aset/js/embo.js"></script>
<script>
	klik("#cta", function() {
		mengarahkan("./add-listing")
	})
	pilih("#formFac").onsubmit = function() {
		let checkArr = [];
		let check = pilih(".fac:checked")
		for(i = 0; i < check.length; i++) {
			checkArr.push(check[i].value)
		}
		console.log(checkArr)
		return false
	}
</script>

</body>
</html>