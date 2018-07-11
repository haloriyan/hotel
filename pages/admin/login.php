<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale = 1'>
	<title>Auth Admin</title>
	<link href='../aset/fw/build/fw.css' rel='stylesheet'>
	<link href='../aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='../aset/css/style.admin.css' rel='stylesheet'>
</head>
<body class="merah-2">

<div class="container">
	<div class="logo merah-2">
		<div class="wrap"><img src="../aset/gbr/logo.png"></div>
	</div>
	<div class="wrap">
		<form id="formLogin">
			<h2>Login</h2>
			<input type="text" class="box" id="usernameLog" placeholder="username" autocomplete="off"><br />
			<input type="password" class="box" id="pwdLog" placeholder="Password" autocomplete="off"><br />
			<div class="bag-tombol">
				<button class="tbl merah-2">LOGIN</button>
			</div>
    </form>
<div class="bg"></div>
<div class="popupWrapper" id="notif">
	<div class="popup">
		<div class="wrap">
			<h3><i class="fa fa-info"></i> &nbsp; Alert!
				<div id="xNotif" class="ke-kanan"><i class="fa fa-close"></i></div>
			</h3>
			<p>
				<?php echo $_COOKIE['loginAdmin']; ?>
			</p>
		</div>
	</div>
</div>

<script src='../aset/js/embo.js'></script>
<?php
if(isset($_COOKIE['loginAdmin'])) {
	echo '<script>
munculPopup("#notif", pengaya("#notif", "top: 200px"))
</script>';
}
?>

<script src='../aset/js/script.admin.js'></script>

</body>
</html>
