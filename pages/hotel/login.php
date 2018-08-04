<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale = 1'>
	<title>Auth Hotel</title>
	<link href='../aset/fw/build/fw.css' rel='stylesheet'>
	<link href='../aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='../aset/css/style.auth-hotel.css' rel='stylesheet'>
</head>
<body class="merah-2">

<div class="container">
	<div class="logo merah-2">
		<div class="wrap"><img src="../aset/gbr/logo.png"></div>
	</div>
	<div class="wrap">
		<form id="formLogin">
			<h2>Login</h2>
			<input type="text" class="box" id="mailLog" placeholder="Email" autocomplete="off"><br />
			<input type="password" class="box" id="pwdLog" placeholder="Password" autocomplete="off"><br />
			<div class="bag-tombol">
				<button class="tbl merah-2">LOGIN</button>
			</div>
			<div class="opt rata-tengah">
				don't have hotel's account? <a href="#" id="linkReg">register</a> now!
			</div>
		</form>
		<form id="formRegist">
			<h2>Register</h2>
			<input type="text" class="box" id="nameReg" placeholder="Hotel's name" autocomplete="off"><br />
			<input type="email" class="box" id="mailReg" placeholder="Email" autocomplete="off"><br />
			<input type="password" class="box" id="pwdReg" placeholder="Password" autocomplete="off"><br />
			<div class="bag-tombol">
				<button class="tbl merah-2">REGISTER</button>
			</div>
		</form>
		<div id="suksesReg">
			<h2>Yo've been registered !</h2>
			<p>
				Next, you must verify your email address and then complete more information about your hotel before you can add an event
			</p>
		</div>
	</div>
</div>

<div class="bg"></div>
<div class="popupWrapper" id="notif">
	<div class="popup">
		<div class="wrap">
			<h3><i class="fa fa-info"></i> &nbsp; Alert!
				<div id="xNotif" class="ke-kanan"><i class="fa fa-close"></i></div>
			</h3>
			<p>
				<?php echo $_COOKIE['loginHotel']; ?>
			</p>
		</div>
	</div>
</div>

<script src='../aset/js/embo.js'></script>
<?php
if(isset($_COOKIE['loginHotel'])) {
	echo '<script>
munculPopup("#notif", pengaya("#notif", "top: 200px"))
</script>';
}
?>

<script src='../aset/js/script.auth-hotel.js'></script>

</body>
</html>