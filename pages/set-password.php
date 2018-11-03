<?php
include 'aksi/ctrl/token.php';

$getToken = $_GET['token'];

$tipe 	= $token->infoToken($getToken, "tipe");
$u 		= $token->infoToken($getToken, "user");
$exp 	= $token->infoToken($getToken, "expired");

if($tipe == "public") {
	$nama = $user->info($u, "nama");
	$id 	= $user->info($u, "iduser");
	$postTo = "aksi/user/change.php";
}else {
	$nama = $hotel->get($u, "nama");
	$id 	= $hotel->get($u, "idhotel");
	$postTo = "aksi/hotel/edit.php";
}
$namaPertama = explode(" ", $nama)[0];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale = 1'>
	<title>Setup New Password - Dailyhotels</title>
	<link href='aset/fw/build/fw.css' rel='stylesheet'>
	<link href='aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='aset/css/style.auth.css' rel='stylesheet'>
	<style>
		#notif {
			padding: 15px 25px;
			background-color: #2ecc71;
			color: #fff;
			display: none;
		}
		#simpanPwd[disabled] {
			background-color: #cb002350;
		}
	</style>
</head>
<body>

<div class="logoHome">
	<img src="aset/gbr/logo.png">
</div>

<div class="content">
	<div class="wrap">
		<?php
		if($u == "") {
			echo 'Invalid token';
		}else if(time() > $exp) {
			echo 'Expired token';
		}else {
		?>
		<p>Set up new password</p>
		<input type="hidden" id="id" value="<?php echo $id; ?>">
		<input type="hidden" id="postTo" value="<?php echo $postTo; ?>">
		<input type="hidden" id="token" value="<?php echo $getToken; ?>">
		<div class="isi">New password</div>
		<input type="password" class="box" id="newPwd">
		<div class="isi">Re-type password</div>
		<input type="password" class="box" oninput="reType(this.value)" id="rePwd">
		<br /><br />
		<button id="simpanPwd" disabled class="tbl merah-2">Save</button>
		<?php
		}
		?>
		<div id="notif">
			Password changed! &nbsp; <i class="fa fa-spinner"></i> redirecting...
		</div>
	</div>
</div>

<script src="aset/js/emboBaru.js"></script>
<script>
	function reType(val) {
		let pwd = $("#newPwd").isi()
		if(val != pwd) {
			$("#simpanPwd").setAttribute('disabled', 'disabled')
		}else {
			$("#simpanPwd").removeAttribute('disabled')
		}
	}
	$("#simpanPwd").klik(function() {
		let pwd = $("#newPwd").isi()
		let id = $("#id").isi()
		let token = $("#token").isi()
		let ganti = "pwd="+pwd+"&bag=pwd&id="+id+"&token="+token
		let postTo = $("#postTo").isi()
		pos(postTo, ganti, () => {
			$("#notif").muncul()
			setTimeout(function() {
				mengarahkan('./auth')
			}, 1050)
		})
	})
</script>

</body>
</html>