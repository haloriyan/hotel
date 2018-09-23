<?php
include 'aksi/ctrl/event.php';

$sesi 	= $hotel->sesi();
$name 	= $hotel->get($sesi, "nama");
$namaPertama = explode(" ", $name)[0];

$idhotel = $hotel->get($sesi, "idhotel");
$myResto = $resto->totMyResto($idhotel);
$myEvent = $event->totMyEvent($idhotel);

setcookie('pakaiAkun', 'hotel', time() + 5555, '/');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>Dashboard</title>
	<link href='../aset/fw/build/fw.css' rel='stylesheet'>
	<link href='../aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='../aset/css/style.index.css' rel='stylesheet'>
	<link href="../aset/css/style.explore-admin.css" rel="stylesheet">
	<style>
		.card {
			display: inline-block;
			width: 31%;
			border-radius: 6px;
			margin-right: 15px;
			margin-bottom: 20px;
			cursor: pointer;
		}
		.card .wrap { margin: 4% 15% 8% 15%; }
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
		<a href="./<?php echo $idhotel; ?>" target='_blank'><li>Hello <?php echo $namaPertama; ?> !</li></a>
		<button id="cta" class="tbl"><i class="fa fa-plus-circle"></i> Add Listing</button>
	</nav>
</div>

<div class="kiri">
<a href="./dashboard"><div class="listWizard" aktif="ya">Dashboard</div></a>
	<a href="./detail"><div class="listWizard">Detail Information</div></a>
	<a href="./listing"><div class="listWizard">My Listings</div></a>
	<a href="./galeri"><div class="listWizard">Gallery</div></a>
	<a href="./facility"><div class="listWizard">Facility</div></a>
	<a href="./social"><div class="listWizard">Social Network</div></a>
	<a href="./restaurant"><div class="listWizard">Restaurant</div></a>
	<a href="./logout"><div class="listWizard">Logout</div></a>
</div>

<div class="container">
	<form>
		<div class="wrap">
			<h4><div id="icon"><i class="fa fa-home"></i></div> Dashboard</h4>
			<p>
				Hello <b><?php echo $name; ?></b> (not <b><?php echo $name; ?></b>? <a href="../logout">Log out</a>)
			</p>
			<p>
				From your account dashboard you can view your recent orders, manage your shipping and billing addresses and edit your password and account details.
			</p>
			<p>
				<div class="card merah-2" id='events'>
					<div class="wrap">
						<h2><?php echo $myEvent; ?></h2>
						<p>Listings</p>
					</div>
				</div>
				<div class="card merah-2" id='resto'>
					<div class="wrap">
						<h2><?php echo $myResto; ?></h2>
						<p>Restaurant</p>
					</div>
				</div>
			</p>
		</div>
	</form>
</div>

<script src="../aset/js/embo.js"></script>
<script>
	klik("#cta", function() {
		mengarahkan("./add-listing")
	})
	klik("#events", () => {
		mengarahkan("./listing")
	})
	klik("#resto", () => {
		mengarahkan("./restaurant")
	})
</script>

</body>
</html>