<?php
include 'aksi/ctrl/user.php';
error_reporting(1);
$sesi = $user->sesi();
$nama = $user->info($sesi, "nama");
$namaPertama = explode(" ", $nama)[0];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>DAILYHOTEL</title>
	<link href="aset/fw/build/fw.css" rel="stylesheet">
	<link href="aset/fw/build/font-awesome.min.css" rel="stylesheet">
	<link href="aset/css/bootstrap.min.css">
	<link href="aset/css/style.home.css" rel="stylesheet">
	<link href="aset/css/style.index.css" rel="stylesheet">
	<style>
		body {
			background: url(aset/gbr/bg.png) no-repeat top center;
			background-size: cover;
		}
		.sub { right: 0%; }
	</style>
</head>
<body>

<div class="bege"></div>
<div class="atas">
	<img src= "aset/gbr/logo.png" class="logoHome">
	<div id="tblMenu" aksi="bkMenu"><i class="fa fa-bars"></i></div>
	<nav class="menu">
		<a href="#"><li>Home</li></a>
		<a href="./explore"><li>Explore</li></a>
		<a href="#"><li>City</li></a>
		<?php
		if(empty($sesi)) { ?>
			<a href="#formLogin" id="tblLogin"><li><i class="fa fa-user"></i> &nbsp;Sign in</li></a>
			<?php
		}else {
			?>
			<li id="adaSub">Hello <?php echo $namaPertama; ?> <i class="fa fa-angle-down"></i>
				<ul class="sub">
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

<div class="container rata-tengah">
	<div class="wrap">
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

<div class="bawah rata-tengah" style="display: none;">
	<div class="wrap">
		<h4>Categories</h4>
		<h2>What do you need to find?</h2>
		<div id="index">
			<div class="list">
				<img src="aset/gbr/squid.jpg">
				<div class="ket">
					<div class="wrap">
						<div id="iconKet"><i class="fa fa-facebook"></i></div>
						<div id="keterangan">
							<h3>Room</h3>
							<p>4 listings</p>
						</div>
					</div>
				</div>
			</div>
			<div class="list">
				<img src="aset/gbr/squid.jpg">
				<div class="ket">
					<div class="wrap">
						<div id="iconKet"><i class="fa fa-facebook"></i></div>
						<div id="keterangan">
							<h3>Room</h3>
							<p>4 listings</p>
						</div>
					</div>
				</div>
			</div>
			<div class="list">
				<img src="aset/gbr/squid.jpg">
				<div class="ket">
					<div class="wrap">
						<div id="iconKet"><i class="fa fa-facebook"></i></div>
						<div id="keterangan">
							<h3>Room</h3>
							<p>4 listings</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<h4>Latest</h4>
		<h2>Explore Hotels</h2>
		<div id="index">
			<div class="listHotel">
				<img src="aset/gbr/sponbob.jpg">
				<div class="ketBuka">
					<div id="open">OPEN</div>
				</div>
				<div class="ketHotel rata-tengah">
					<img src="aset/gbr/sponbob.jpg" id="iconHotel">
					<h4>ARTOTEL Surabaya</h4>
					<p>
						Designed with colonial architecture and twist of
					</p>
				</div>
			</div>
			<div class="listHotel">
				<img src="aset/gbr/sponbob.jpg">
				<div class="ketBuka">
					<div id="open">OPEN</div>
				</div>
				<div class="ketHotel rata-tengah">
					<img src="aset/gbr/sponbob.jpg" id="iconHotel">
					<h4>ARTOTEL Surabaya</h4>
					<p>
						Designed with colonial architecture and twist of
					</p>
				</div>
			</div>
			<div class="listHotel">
				<img src="aset/gbr/sponbob.jpg">
				<div class="ketBuka">
					<div id="open">OPEN</div>
				</div>
				<div class="ketHotel rata-tengah">
					<img src="aset/gbr/sponbob.jpg" id="iconHotel">
					<h4>ARTOTEL Surabaya</h4>
					<p>
						Designed with colonial architecture and twist of
					</p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="bg"></div>
<div class="formPopup" id="formLogin">
	<form class="wrap" id="formSignIn">
		<h4><i class="fa fa-user"></i> &nbsp; Sign in
			<div id="xLog" class="ke-kanan"><i class="fa fa-close"></i></div>
		</h4>
		<input type="text" class="box" placeholder="Email" id="mailLog"><br />
		<input type="password" class="box" placeholder="Password" id="pwdLog"><br />
		<div class="bag-tombol">
			<button class="merah-2">Sign in</button>
		</div>
		<div class="bag bag-5">
			<input type="checkbox" id="rememberMe"> <label for="rememberMe">Remember me</label>
		</div>
		<div class="bag bag-5 rata-kanan">
			<a href="#">Forgot password?</a>
		</div>
		<br />
		<div class="rata-tengah" style="margin-bottom: 15px;">
			<a href="#popupRegist" id="linkLogin">Register</a> | <a href="./hotel/login">Hotel</a>
		</div>
	</form>
</div>

<div class="formPopup" id="popupRegist">
	<div class="wrap">
		<h4><i class="fa fa-user"></i> &nbsp; Register
			<div id="xReg" class="ke-kanan"><i class="fa fa-close"></i></div>
		</h4>
		<form id="formRegist">
			<input type="text" class="box" id="nameReg" placeholder="Name"><br />
			<input type="email" class="box" id="mailReg" placeholder="Email"><br />
			<input type="password" class="box" id="pwdReg" placeholder="Password"><br />
			<div class="bag-tombol" style="margin-top: 10px;">
				<button class="merah-2" id="register">REGISTER</button>
			</div>
		</form>
	</div>
</div>
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
muncul(".bg")
muncul("#formLogin")
</script>';
}
?>
<script>
	window.addEventListener("scroll", function() {
		var skrol = window.pageYOffset
		if(skrol >= 40) {
			pengaya(".atas", "background: #cb0029")
			pengaya(".sub", "background: #cb0029")
		}else {
			pengaya(".atas", "background: none")
			pengaya(".sub", "background: none")
		}
	})

	klik(".bg", function() {
		hilang(".bg")
		hilang("#formLogin")
		hilang("#notif")
	})
	klik("#xNotif", function() {
		hilang(".bg")
		hilang("#notif")
	})

	klik("#linkLogin", function() {
		hilang("#formLogin")
		muncul("#popupRegist")
	})

	klik("#tblMenu", function() {
		let tbl = pilih("#tblMenu")
		let aksi = tbl.getAttribute("aksi")
		if(aksi == "bkMenu") {
			pengaya(".menu", "left: 0%")
			tbl.setAttribute("aksi", "xMenu")
		}else {
			pengaya(".menu", "left: 100%")
			tbl.setAttribute("aksi", "bkMenu")
		}
	})

	submit("#formSignIn", function() {
		let email = pilih("#mailLog").value
		let pwd = pilih("#pwdLog").value
		let log = "email="+email+"&pwd="+pwd
		if(email == "" || pwd == "") {
			return false
		}
		pos("aksi/user/login.php", log, function() {
			mengarahkan("./")
		})
		return false
	})
	submit("#formRegist", function() {
		let name = pilih("#nameReg").value
		let email = pilih("#mailReg").value
		let pwd = pilih("#pwdReg").value
		let reg = "name="+name+"&email="+email+"&pwd="+pwd
		if(name == "" || email == "" || pwd == "") {
			return false
		}
		pos("aksi/user/register.php", reg, function() {
			hilang("#popupRegist")
			muncul("#suksesReg")
		})
		return false
	})
	submit("#action", function() {
		let q = pilih("#q").value
		let cat = pilih("#cat").value
		mengarahkan("./explore&q="+q+"&cat="+cat)
		return false
	})

	function hilangForm() {
		hilang(".bg")
		hilang(".formPopup")
		hilang("#popupRegist")
		hilang("#notif")
		hilang("#suksesReg")
	}
	tekan("Escape", function() {
		hilangForm()
	})
	klik("#xLog", function() {
		hilangForm()
	})
	klik("#xReg", function() {
		hilangForm()
	})
	klik("#tblLogin", function() {
		muncul(".bg")
		muncul("#formLogin")
	})
</script>

</body>
</html>
