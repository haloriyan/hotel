<?php
include 'aksi/ctrl/event.php';
error_reporting(0);

session_start();
$sesiHotel = $_SESSION['uhotel'];
if($sesiHotel == "") {
	$sesi = $user->sesi();
	$nama = $user->info($sesi, "nama");
	$sebagai = "public";
}else {
	$sesi = $hotel->sesi(1);
	$nama = $hotel->get($sesi, "nama");
	$sebagai = "hotel";
}
$namaPertama = explode(" ", $nama)[0];

if(isset($_GET['cat']) && $_GET['cat'] != "") {
	setcookie('category', $_GET['cat'], time() + 3650, "/");
}else {
	setcookie('category', '', time() + 1, "/");
}

$q = $_GET['q'];
if(empty($q)) {
	$q = $_COOKIE['kwExplore'];
}
if(isset($q)) {
	$subJudul = "- ".$q;
}else {
	$subJudul = "";
}

if($_GET['city'] != null) {
	setcookie('region', $_GET['city'], time() + 3666, "/");
}else {
	setcookie('region', '', time() + 1, "/");
}

$urlNow = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// delete cookie
setcookie('tglMulai', '', time() + 1, "/");
setcookie('tglAkhir', '', time() + 1, "/");
setcookie('kwExplore', '', time() + 1, "/");

if($_GET['q'] != "") {
	setcookie('kwExplore', $_GET['q'], time() + 3650, "/");
}

// Category
$category = ["Food and Beverage","Room","Venue","Sports and Wellness","Shopping","Recreation","Parties","Others"];
$cities = ["Bali","Bandung","Batam","Bogor","Jakarta","Lombok","Makassar","Malang","Pekalongan","Semarang","Solo","Surabaya","Yogyakarta"];
$city = ["Bali","Bandung","Jakarta","Lombok","Makassar","Malang","Semarang","Surabaya","Yogyakarta"];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale = 1'>
	<title>Explore <?php echo $subJudul; ?> on Dailyhotels</title>
	<link href='aset/fw/build/fw.css' rel='stylesheet'>
	<link href='aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='aset/css/jquery-ui.min.css' rel='stylesheet'>
	<link href='aset/css/style.index.css' rel='stylesheet'>
	<link href='aset/css/style.explore.css' rel='stylesheet'>
	<link href="aset/css/tambahanIndex.css" rel="stylesheet">
	<link href="aset/css/tambahanExplore.css" rel="stylesheet">
	<style>
		<?php if($sebagai == "public") { ?>
			#subUser {
				right: 0%;
			}
		<?php } ?>
	</style>
</head>
<body>

<div class="atas merah-2">
	<img src="aset/gbr/logo.png" class="logoHome">
	<div id="tblMenu" aksi="bkMenu"><i class="fa fa-bars"></i></div>
	<div class="pencarian">
		<i class="fa fa-search"></i>
		<input type="text" class="box" placeholder="Type your search..." oninput="cari(this.value)" value="<?php echo $q; ?>" id="q" autocomplete="off">
	</div>
	<nav class="menu">
		<a href="./"><li>Home</li></a>
		<a href="./"><li aktif='ya'>Explore</li></a>
		<?php
		if(empty($sesi)) { ?>
			<a href="#formLogin" id="tblLogin"><li><i class="fa fa-user"></i> &nbsp;Sign in</li></a>
			<?php
		}else {
			?>
			<li id="adaSub">Hello <?php echo $namaPertama; ?> <i class="fa fa-angle-down"></i>
				<nav class="sub merah-2" id="subUser">
					<?php
					if($sebagai == "public") {
					?>
					<a href="./my"><li><div id="icon"><i class="fa fa-briefcase"></i></div> My Listing</li></a>
					<a href="./detail"><li><div id="icon"><i class="fa fa-cog"></i></div> Settings</li></a>
					<a href="./logout"><li><div id="icon"><i class="fa fa-sign-out"></i></div> Logout</li></a>
					<?php
					}else if($sebagai == "hotel") {
					?>
					<a href="./hotel/detail"><li><div id="icon"><i class="fa fa-cog"></i></div> Settings</li></a>
					<a href="./hotel/galeri"><li><div id="icon"><i class="fa fa-image"></i></div> Gallery</li></a>
					<a href="./hotel/facility"><li><div id="icon"><i class="fa fa-cogs"></i></div> Facility</li></a>
					<a href="./hotel/social"><li><div id="icon"><i class="fa fa-user"></i></div> Social</li></a>
					<a href="./hotel/logout"><li><div id="icon"><i class="fa fa-sign-out"></i></div> Logout</li></a>
					<?php
					}
					?>
				</nav>
			</li>
			<?php
			if($sebagai == "hotel") { ?>
				<button id="cta" onclick="mengarahkan('./hotel/add-listing');" class="tbl" style="display: inline-block;margin-top: 18px;"><i class="fa fa-plus-circle"></i> Add Listing</button>
			<?php }
		}
		?>
	</nav>
</div>

<div class="kiri">
	<div class="wrap">
		<form id="filter">
			
		</form>
	</div>
</div>

<div class="container">
	<div class="wrap">
		<input type="hidden" id="urlNow" value="<?php echo $urlNow; ?>">
		<div id="load"></div>
	</div>
</div>

<div class="bg"></div>
<div class="formPopup" id="notif">
	<div class="wrap">
		<h4><i class="fa fa-info"></i> &nbsp; Alert!</h4>
		<p>
			<?php echo $_COOKIE['kukiLogin']; ?>
		</p>
		<div class="bag-tombol">
			<button class="merah-2" id="xNotif">CLOSE</button>
		</div>
	</div>
</div>

<script src='aset/js/embo.js'></script>
<script src='aset/js/jquery-3.1.1.js'></script>
<script src="aset/js/script.index.js"></script>
<script src='aset/js/jquery-ui.min.js'></script>
<script src='aset/js/script.explore.js'></script>
<script>
	// datepicker
	$("#fromDate").datepicker({
		dateFormat: 'yy-mm-dd',
		minDate: $("#tglSkrg").val(),
		maxDate: '2025-12-31',
		useCurrent: false,
		showClose: true
	})
	
	$("#toDate").datepicker({
		minDate: $("#tglSkrg").val(),
		maxDate: '2025-12-31',
		useCurrent: false,
		showClose: true,
		dateFormat: 'yy-mm-dd',
	})
	function loadFilter() {
		ambil("aksi/loadFilter.php", (res) => {
			tulis("#filter", res)
		})
	}
	loadFilter()
	klik("#tblLogin", () => {
		let urlNow = btoa(pilih("#urlNow").value)
		mengarahkan("./auth&r="+urlNow)
	})
</script>

<?php
if(isset($_COOKIE['kukiLogin'])) {
	echo '<script>
muncul(".bg")
muncul("#notif")
</script>';
}
?>

</body>
</html>