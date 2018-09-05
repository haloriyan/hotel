<?php
include 'aksi/ctrl/event.php';

$sesi 	= $user->sesi(1);
$name 	= $user->info($sesi, "nama");
$namaPertama = explode(" ", $name)[0];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>My Listing</title>
	<link href='aset/fw/build/fw.css' rel='stylesheet'>
	<link href='aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='aset/css/style.index.css' rel='stylesheet'>
	<link href="aset/css/style.explore-admin.css" rel="stylesheet">
	<style>
		body { background-color: #ecf0f1 !important; }
		#icon {
			line-height: 50px;
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
		td h4 { margin-top: 5px; }
		#tblStatus {
			padding: 15px 13px;
			font-size: 15px;
		}
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
		<a href="#"><li>Home</li></a>
		<a href="#"><li>Explore</li></a>
		<a href="#"><li>City</li></a>
		<li>Hello <?php echo $namaPertama; ?> !</li>
	</nav>
</div>

<div class="kiri">
	<a href="./hello"><div class="listWizard">Dashboard</div></a>
	<a href="./my"><div class="listWizard" aktif="ya">My Listings</div></a>
	<a href="./detail"><div class="listWizard">Detail Information</div></a>
	<a href="./logout"><div class="listWizard">Logout</div></a>
</div>

<div class="container">
	<div>
		<div class="wrap">
			<h4><div id="icon">&nbsp;<i class="fa fa-home"></i>&nbsp;</div> My Listing Event</h4>
			<div id="load"></div>
		</div>
	</div>
</div>

<script src="aset/js/embo.js"></script>
<script>
	function load() {
		ambil("aksi/user/myBooking.php", function(res) {
			tulis("#load", res)
		})
	}

	load()
</script>

</body>
</html>
