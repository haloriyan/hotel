<?php
include 'aksi/ctrl/booking.php';

$sesi 	= $hotel->sesi();
$name 	= $hotel->get($sesi, "nama");
$namaPertama = explode(" ", $name)[0];

$idhotel = $hotel->get($sesi, "idhotel");
$myResto = $resto->totMyResto($idhotel);
$myEvent = $event->totMyEvent($idhotel);
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
	<h1 class="logoHome" style="margin: 0;margin-left: 5%;font-size: 23px;font-family: OBold;">Event Management</h1>
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
    <a href="./dashboard"><div class="listWizard">Dashboard</div></a>
    <a href="./detail"><div class="listWizard">Detail Event</div></a>
    <a href="./guest-list"><div class="listWizard" aktif="ya">Guest List</div></a>
	<a href="../hotel/logout"><div class="listWizard">Logout</div></a>
</div>

</body>
</html>