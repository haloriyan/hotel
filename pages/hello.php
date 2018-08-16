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
	<title>Dashboard</title>
	<link href='aset/fw/build/fw.css' rel='stylesheet'>
	<link href='aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='aset/css/style.index.css' rel='stylesheet'>
	<link href="aset/css/style.explore-admin.css" rel="stylesheet">
	<style>
		body { background-color: #ecf0f1 !important; }
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
	<div class="listWizard" aktif="ya">Dashboard</div>
	<a href="./my"><div class="listWizard">My Listings</div></a>
	<a href="./refund"><div class="listWizard">My Refunds</div></a>
	<a href="./detail"><div class="listWizard">Detail Information</div></a>
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
		</div>
	</form>
</div>

<script src="aset/js/embo.js"></script>
<script>
	//
</script>

</body>
</html>
