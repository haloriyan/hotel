<?php
include 'aksi/ctrl/hotel.php';

$email = base64_decode($_GET['e']);
if (empty($email)) {
	header("location: ./error/403");
}

echo $hotel->validate($email);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale = 1'>
	<title>validate-hotel</title>
	<link href='aset/fw/build/fw.css' rel='stylesheet'>
	<link href='aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='aset/css/style.validate.css' rel='stylesheet'>
</head>
<body>

<div class="container">
	<div class="merah-2 top">
		<div class="wrap">
			<img src="aset/gbr/logo.png">
		</div>
	</div>
	<div class="wrap">
		<div class="rata-tengah" style="margin-top: 35px;margin-bottom: 45px;">
			<i class="fa fa-check" style="font-size: 45px;"></i>
			<p>
				Your account was verified. Click <a href="./auth-hotel">here</a> for login
			</p>
		</div>
	</div>
</div>

<script src='aset/js/embo.js'></script>
<script src='aset/js/script.validate.js'></script>

</body>
</html>