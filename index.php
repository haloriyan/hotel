<?php
include 'aksi/ctrl/hotel.php';
error_reporting(1);

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

$city = ["Bali","Bandung","Jakarta","Lombok","Makassar","Malang","Semarang","Surabaya","Yogyakarta"];
$category = ["Food and Beverage","Room","Venue","Sports and Wellness","Shopping","Recreation","Parties","Others"];

$urlNow = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>Dailyhotels</title>
	<link href="aset/fw/build/fw.css" rel="stylesheet">
	<link href="aset/fw/build/font-awesome.min.css" rel="stylesheet">
	<link href="aset/css/style.home.css" rel="stylesheet">
	<link href="aset/css/style.index.css" rel="stylesheet">
	<link href="aset/css/tambahanIndex.css" rel="stylesheet">
	<style>
		body {
			background: url(aset/gbr/bg.png) no-repeat top center;
			background-size: cover;
			background-attachment: fixed;
		}
	</style>
</head>
<body>

<div class="bege"></div>
<div class="atas">
	<img src= "aset/gbr/logo.png" class="logoHome">
	<div id="tblMenu" aksi="bkMenu"><i class="fa fa-bars"></i></div>
	<nav class="menu">
		<a href="#"><li>Home</li></a>
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
		<?php
		if(empty($sesi)) { ?>
			<a href="#formLogin" id="tblLogin"><li><i class="fa fa-user"></i> &nbsp;Sign in</li></a>
			<?php
		}else {
			?>
			<li id="adaSub">Hello <?php echo $namaPertama; ?> <i class="fa fa-angle-down"></i>
				<nav class="sub" id="subUser">
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
				<button id="cta" class="tbl"><i class="fa fa-plus-circle"></i> Add Listing</button>
			<?php }
		}
		?>
	</nav>
</div>

<div class="container rata-tengah">
	<div class="wrap">
		<input type="hidden" value="<?php echo $urlNow; ?>" id="urlNow">
		<h1>Discover What's New in Hotel</h1>
		<h2>Find Great Places to Eat, Visit and Stay</h2>
		<div class="boxTengah">
			<div class="wrap">
				<form id="action" style="margin-top: 50px;">
					<div class="option">
						<input type="text" class="box" placeholder="What are you looking for?" id="q">
					</div>
					<div class="option">
						<select class="box" id="cat">
							<option value="">All categories</option>
							<option>Food & Beverages</option>
							<option>Room</option>
							<option>Venue</option>
							<option>Sports & Wellness</option>
							<option>Shopping</option>
							<option>Recreation</option>
							<option>Parties</option>
							<option>Others</option>
						</select>
					</div>
					<button id="search" class="tbl merah-2">
						<i class="fa fa-search"></i> Search
					</button>
				</form>
			</div>
		</div>
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

<div class="formPopup" id="suksesReg">
	<div class="wrap">
		<h4><i class="fa fa-info"></i> &nbsp; We've already sent an email verification</h4>
		<p>
			Click the link in the email that has been sent. Please check your spam if you aint find it. And let's exploring dailyhotels
		</p>
		<div class="bag-tombol">
			<button class="merah-2" id="xSukses">CLOSE</button>
		</div>
	</div>
</div>

<script src="aset/js/embo.js"></script>
<?php
if(isset($_COOKIE['kukiLogin'])) {
	echo '<script>
muncul(".bg")
muncul("#notif")
</script>';
}
if($_GET['auth']) {
	echo '<script>
munculPopup("#formLoginBaru", pengaya("#formLoginBaru", "top: 90px"))
</script>';
}
?>
<script src="aset/js/script.index.js"></script>
<script>
	klik("#xNotif", function() {
		hilang(".bg")
		hilang("#notif")
	})
	submit("#action", function() {
		let q = encodeURIComponent(pilih("#q").value)
		let cat = pilih("#cat").value
		mengarahkan("./explore&q="+q+"&cat="+cat)
		return false
	})
	klik("#cta", function() {
		mengarahkan('./hotel/add-listing');
	})
	klik("#tblLogin", () => {
		let redirect = btoa(pilih("#urlNow").value)
		mengarahkan("./auth&r="+redirect)
	})
</script>

</body>
</html>