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
<a href="./dashboard"><div class="listWizard" aktif="ya">Dashboard</div></a>
	<a href="./detail"><div class="listWizard">Detail Information</div></a>
	<a href="./listing"><div class="listWizard">My Listings</div></a>
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