<?php
include 'aksi/ctrl/user.php';
error_reporting(1);
$sesi = $user->sesi();
$nama = $user->info($sesi, "nama");
$namaPertama = explode(" ", $nama)[0];

$city = ["Bali","Bandung","Jakarta","Lombok","Makassar","Malang","Semarang","Surabaya","Yogyakarta"];
$category = ["Food and Beverage","Room","Venue","Sports and Wellness","Shopping","Recreation","Parties","Others"];

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
				<ul class="sub" id="subUser">
					<a href="./my"><li><div id="icon"><i class="fa fa-briefcase"></i></div> My Listing</li></a>
					<a href="./detail"><li><div id="icon"><i class="fa fa-cog"></i></div> Settings</li></a>
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

<div class="popupWrapper" id="formLoginBaru">
	<div class="popup">
		<div id="loginPublic" class="bagLogin">
			<div class="wrap"> 
				<form id="formLoginPublic">
					<h3>Login User</h3>
					<div>E-Mail :</div>
					<input type="email" class="box" id="emailLogPublic">
					<div>Password :</div>
					<input type="password" class="box" id="pwdLogPublic">
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
					<input type="text" class="box" id="nameRegPublic">
					<div>E-Mail :</div>
					<input type="email" class="box" id="emailRegPublic">
					<div>Password :</div>
					<input type="password" class="box" id="pwdRegPublic">
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
				<form id="suksesRegMarcom">
					<h3>You've been registered !</h3>
					<p>
						Next, you must verify your email address and then complete more information about your hotel before you can add an event
					</p>
				</form>
			</div>
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
		let q = pilih("#q").value
		let cat = pilih("#cat").value
		mengarahkan("./explore&q="+q+"&cat="+cat)
		return false
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
	submit("#formLoginMarcom", () => {
		let email = pilih("#emailLogMarcom").value
		let pwd = pilih("#pwdLogMarcom").value
		let log = "email="+email+"&pwd="+pwd
		pos("aksi/hotel/login.php", log, () => {
			mengarahkan("./hotel/dashboard")
		})
		return false
	})
	submit("#formRegMarcom", () => {
		let name = pilih("#nameRegMarcom").value
		let email = pilih("#emailRegMarcom").value
		let pwd = pilih("#pwdRegMarcom").value
		let reg = "name="+name+"&email="+email+"&pwd="+pwd
		pos("aksi/hotel/register.php", reg, () => {
			hilang("#formRegMarcom")
			muncul("#suksesRegMarcom")
		})
		return false
	})
</script>

</body>
</html>