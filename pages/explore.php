<?php
include 'aksi/ctrl/event.php';
error_reporting(0);
$sesi = $user->sesi();
$nama = $user->info($sesi, "nama");
$namaPertama = explode(" ", $nama)[0];

setcookie('kwExplore', $_GET['q'], time() + 3650, "/");
if(isset($_GET['cat']) && $_GET['cat'] != "") {
	setcookie('category', $_GET['cat'], time() + 3650, "/");
}
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

if($_GET['city'] != null) {
	setcookie('region', $_GET['city'], time() + 3666, "/");
}

// delete cookie
setcookie('tglMulai', '', time() + 1, "/");
setcookie('tglAkhir', '', time() + 1, "/");

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
				<nav class="sub merah-2" id="subUser">
					<a href="./my"><li><div id="icon"><i class="fa fa-briefcase"></i></div> My Listing</li></a>
					<a href="./detail"><li><div id="icon"><i class="fa fa-cog"></i></div> Settings</li></a>
					<a href="./logout"><li><div id="icon"><i class="fa fa-sign-out"></i></div> Logout</li></a>
				</nav>
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
				<?php
				foreach ($cities as $key => $value) {
					if($_COOKIE['region'] == $value) {
						$selected = "selected";
					}else {
						$selected = "";
					}
					echo "<option ".$selected.">".$value."</option>";
				}
				?>
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
<div class="popupWrapper" id="formLoginBaru">
	<div id="xLog"><i class="fa fa-close"></i> UASU</div>
	<div class="popup">
		<div id="loginPublic" class="bagLogin">
			<div class="wrap"> 
				<form id="formLoginPublic">
					<h3>Login User</h3>
					<div>E-Mail :</div>
					<input type="email" class="box" id="emailLogPublic" required>
					<div>Password :</div>
					<input type="password" class="box" id="pwdLogPublic" required>
					<div class="bag bag-3">
						<button class="tbl tblLogins">LOGIN</button>
					</div>
					<div class="bag bag-4" id="optLogin">
						or <a href="#" id="linkRegPublic">register</a>
					</div>
				</form>
				<form id="formRegPublic">
					<h3>Register User</h3>
					<div>Name :</div>
					<input type="text" class="box" id="nameRegPublic" required>
					<div>E-Mail :</div>
					<input type="email" class="box" id="emailRegPublic" required>
					<div>Password :</div>
					<input type="password" class="box" id="pwdRegPublic" required>
					<div class="bag bag-4">
						<button class="tbl tblLogins">REGISTER</button>
					</div>
					<div class="bag bag-4" id="optLogin">
						or <a href="#" id="linkLogPublic">login</a>
					</div>
				</form>
			</div>
		</div>
		<div id="loginMarcom" class="bagLogin">
			<div class="wrap"> 
				<form id="formLoginMarcom">
					<h3>Login as Hotel</h3>
					<div>E-Mail :</div>
					<input type="email" class="box" id="emailLogMarcom">
					<div>Password :</div>
					<input type="password" class="box" id="pwdLogMarcom">
					<div class="bag bag-5">
						<button class="tbl putih tblLogins">LOGIN</button>
					</div>
					<div class="bag bag-4" id="optLogin">
						or <a href="#" id="linkRegMarcom">register</a>
					</div>
				</form>
				<form id="formRegMarcom">
					<h3>Register as Hotel</h3>
					<div>Hotel's name :</div>
					<input type="text" class="box" id="nameRegMarcom">
					<div>E-Mail :</div>
					<input type="email" class="box" id="emailRegMarcom">
					<div>Password :</div>
					<input type="password" class="box" id="pwdRegMarcom">
					<div class="bag bag-5">
						<button class="tbl putih tblLogins">REGISTER</button>
					</div>
					<div class="bag bag-4" id="optLogin">
						or <a href="#" id="linkLogMarcom">login</a>
					</div>
				</form>
			</div>
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
	submit("#formLoginPublic", () => {
		let email = pilih("#emailLogPublic").value
		let pwd = pilih("#pwdLogPublic").value
		let log = "email="+email+"&pwd="+pwd
		pos("aksi/user/login.php", log, (err) => {
			location.reload()
		})
		return false
	})
	submit("#formRegPublic", () => {
		let name = pilih("#nameRegPublic").value
		let email = pilih("#emailRegPublic").value
		let pwd = pilih("#pwdRegPublic").value
		let reg = "name="+name+"&email="+email+"&pwd="+pwd
		pos("aksi/user/register.php", reg, () => {
			hilangPopup("#formLoginBaru")
			muncul(".bg")
			muncul("#suksesReg")
		})
		return false	
	})
</script>

</body>
</html>