<?php
include 'aksi/ctrl/event.php';
error_reporting(0);
$sesi = $user->sesi();
$nama = $user->info($sesi, "nama");
$namaPertama = explode(" ", $nama)[0];

$q = $_GET['q'];
if(isset($q)) {
	$subJudul = "- ".$q;
}else {
	$subJudul = "";
}

// delete cookie
setcookie('tglMulai', '', time() + 1, "/");
setcookie('tglAkhir', '', time() + 1, "/");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale = 1'>
	<title>Explore <?php echo $subJudul; ?></title>
	<link href='aset/fw/build/fw.css' rel='stylesheet'>
	<link href='aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='aset/css/style.index.css' rel='stylesheet'>
	<link href='aset/css/style.explore.css' rel='stylesheet'>
	<style>
		.list {
			width: 47.5%;
			margin: 5px 10px;
			margin-bottom: 75px;
			height: 300px;
		}
		.list .ket {
			top: -305px;
			height: 300px;
			background: rgba(0,0,0,0.45);
		}
		.ket #keterangan { margin-top: 56%; }
		@media (max-width: 720px) {
			.list {
				float: none;
				width: 94%;
			}
		}
	</style>
</head>
<body>

<div class="atas merah-2">
	<img src= "aset/gbr/logo.png" class="logoHome">
	<div id="tblMenu" aksi="bkMenu"><i class="fa fa-bars"></i></div>
	<div class="pencarian">
		<i class="fa fa-search"></i>
		<input type="text" class="box" placeholder="Type your search..." oninput="cari(this.value)" value="<?php echo $q; ?>" id="q" autocomplete="off">
	</div>
	<nav class="menu">
		<a href="./"><li>Home</li></a>
		<a href="./explore"><li>Explore</li></a>
		<a href="#"><li>City</li></a>
		<?php
		if(empty($sesi)) { ?>
			<a href="#formLogin" id="tblLogin"><li><i class="fa fa-user"></i> &nbsp;Sign in</li></a>
			<?php
		}else {
			?>
			<li id="adaSub">Hello <?php echo $namaPertama; ?> <i class="fa fa-angle-down"></i>
				<ul class="sub merah-2">
					<a href="./my"><li><div id="icon"><i class="fa fa-briefcase"></i></div> My Listing</li></a>
					<a href="./settings"><li><div id="icon"><i class="fa fa-cog"></i></div> Settings</li></a>
					<a href="./logout"><li><div id="icon"><i class="fa fa-sign-out"></i></div> Logout</li></a>
				</ul>
			</li>
			<?php
		}
		?>
	</nav>
</div>

<div class="kiri">
	<div class="wrap">
		<form id="filter">
			<h3>Filter :</h3>
			<select class="box" onchange="order(this.value)">
				<option value="latest">Latest</option>
				<option value="lowest">Lowest Price</option>
			</select>
			<select class="box" onchange="category(this.value)">
				<option value="">Category...</option>
				<option>Food &amp; Beverage</option>
				<option>Room</option>
				<option>Venue</option>
				<option>Sports &amp; Wellness</option>
				<option>Shopping</option>
				<option>Recreation</option>
				<option>Parties</option>
			</select>
			<select class="box" onchange="city()">
				<option>City...</option>
			</select>
			<div class="bag bag-5">
				From :
				<input type="date" class="box" id="fromDate" onchange="tglMulai(this.value)">
			</div>
			<div class="bag bag-5">
				To :
				<input type="date" class="box" id="toDate" onchange="tglAkhir(this.value)">
			</div>
		</form>
	</div>
</div>

<div class="container">
	<div class="wrap">
		<div id="load"></div>
	</div>
</div>

<script src='aset/js/embo.js'></script>
<script src='aset/js/script.explore.js'></script>

</body>
</html>