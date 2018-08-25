<?php
include 'aksi/ctrl/event.php';
error_reporting(0);
$sesi = $user->sesi();
$nama = $user->info($sesi, "nama");
$namaPertama = explode(" ", $nama)[0];

setcookie('kwExplore', $_GET['q'], time() + 3650, "/");
if(isset($_GET['cat'])) {
	setcookie('category', $_GET['cat'], time() + 3650, "/");
}

setcookie('region', '', time() + 1, "/");
setcookie('tglMulai', '', time() + 1, "/");
setcookie('tglAkhir', '', time() + 1, "/");

$q = $_GET['q'];
if(empty($q)) {
	$q = $_COOKIE['kwExplore'];
}
if(isset($q)) {
	$subJudul = "- ".$q;
}else {
	$subJudul = "";
}

// delete cookie
setcookie('tglMulai', '', time() + 1, "/");
setcookie('tglAkhir', '', time() + 1, "/");

// Category
$category = ["Food & Beverage","Room","Venue","Sports & Wellness","Shopping","Recreation","Parties"];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale = 1'>
	<title>Explore <?php echo $subJudul; ?></title>
	<link href='aset/fw/build/fw.css' rel='stylesheet'>
	<link href='aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='aset/css/jquery-ui.min.css' rel='stylesheet'>
	<link href='aset/css/style.index.css' rel='stylesheet'>
	<link href='aset/css/style.explore.css' rel='stylesheet'>
	<style>
		.container,.kiri {
			top: 75px;
		}
		.list {
			width: 47%;
			margin: 5px 10px;
			margin-bottom: 75px;
			height: 300px;
			cursor: default;
		}
		.list a {
			text-decoration: none;
			color: #fff;
		}
		.list .ket {
			top: -300px;
			height: 300px;
			background: rgba(0,0,0,0.45);
		}
		.ket #keterangan { margin-top: 56%; }
		.tgl {
			margin-top: -22px;
			position: relative;
			top: -160px;
			float: right;
		}
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
	<img src="aset/gbr/logo.png" class="logoHome">
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
			<input type="hidden" id="tglSkrg" value="<?php echo date('Y-m-d'); ?>">
			<select class="box" onchange="order(this.value)">
				<option value="latest">Latest</option>
				<option value="lowest">Lowest Price</option>
			</select>
			<div class="isi">Category :</div>
			<select class="box" onchange="category(this.value)">
				<option value="">All Categories</option>
				<?php
				foreach ($category as $key => $value) {
					if($_COOKIE['category'] == $value) {
						$selected = "selected";
					}else {
						$selected = "";
					}
					echo "<option ".$selected.">".$value."</option>";
				}
				?>
			</select>
			<div class="isi">City :</div>
			<select class='box' id='region' onchange='city(this.value)'>
				<option value="">City</option>
				<option>Bali</option>
				<option>Bandung</option>
				<option>Batam</option>
				<option>Bogor</option>
				<option>Jakarta</option>
				<option>Lombok</option>
				<option>Makassar</option>
				<option>Malang</option>
				<option>Pekalongan</option>
				<option>Semarang</option>
				<option>Solo</option>
				<option>Surabaya</option>
				<option>Yogyakarta</option>
			</select>
			<!--
			<div class="bag bag-5">
				From :
				<input type="text" class="box" id="fromDate" onchange="tglMulai(this.value);tglMulai2(this.value)" placeholder='YYYY-MM-DD'>
			</div>
			-->
			<div>
				Until :
				<input type="text" class="box" id="toDate" onchange="tglAkhir(this.value)" placeholder='YYYY-MM-DD'>
			</div>
		</form>
	</div>
</div>

<div class="container">
	<div class="wrap">
		<div id="load"></div>
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

<script src='aset/js/embo.js'></script>
<script src='aset/js/jquery-3.1.1.js'></script>
<script src='aset/js/jquery-ui.min.js'></script>
<script src='aset/js/script.explore.js'></script>
<script>
	// datepicker
	console.log($("#tglSkrg").val())
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
</script>

</body>
</html>