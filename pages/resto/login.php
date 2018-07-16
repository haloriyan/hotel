<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale = 1'>
	<title>Login Restaurant</title>
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
			<input type="text" class="box" id="mailLog" placeholder="Email" autocomplete="off" required><br />
			<input type="password" class="box" id="pwdLog" placeholder="Password" autocomplete="off" required><br />
			<div class="bag-tombol">
				<button class="tbl merah-2">LOGIN</button>
			</div>
		</form>
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
				<?php echo $_COOKIE['loginResto']; ?>
			</p>
		</div>
	</div>
</div>

<script src='../aset/js/embo.js'></script>
<?php
if(isset($_COOKIE['loginResto'])) {
	echo '<script>
munculPopup("#notif", pengaya("#notif", "top: 200px"))
</script>';
}
?>

<script>
	submit("#formLogin", function() {
		let email = pilih("#mailLog").value
		let pwd = pilih("#pwdLog").value
		let log = "email="+email+"&pwd="+pwd
		pos("../aksi/resto/login.php", log, function() {
			mengarahkan("./dashboard")
		})
		return false
	})

	tekan("Escape", function() {
		hilangPopup("#notif")
	})
	klik("#xNotif", function() {
		hilangPopup("#notif")
	})
</script>

</body>
</html>