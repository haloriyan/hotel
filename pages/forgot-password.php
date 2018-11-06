<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale = 1'>
	<title>Forgot Password - Dailyhotels</title>
	<link href='aset/fw/build/fw.css' rel='stylesheet'>
	<link href='aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='aset/css/style.auth.css' rel='stylesheet'>
</head>
<body>

<div class="logoHome">
	<img src="aset/gbr/logo.png">
</div>

<div class="content">
	<div class="wrap">
		<h3>Forgot Password</h3>
		<p>
			Please provide your email address below to set up your new password
		</p>
		<form id="formForgot">
			<div class="isi">Email address</div>
			<input type="text" class="box" id="email">
			<input type="checkbox" id="cekHotel"> <label for="cekHotel">I am hotel account</label>
			<br /><br />
			<button class="tbl merah-2" id="submit">Remember my password</button>
		</form>
		<div id="notif">
			<!-- <div class="note">Instruction sent to your email <span id="xNote" class="ke-kanan"><i class="fa fa-close"></i></span></div> -->
		</div>
	</div>
</div>

<script src="aset/js/emboBaru.js"></script>
<script>
	submit('#formForgot', () => {
		let email = $("#email").isi()
		let cek = $("#cekHotel").checked
		let hotel
		if(cek == true) {
			hotel = 'hotel'
		}else {
			hotel = 'public'
		}
		let forgot = "email="+email+"&tipe="+hotel
		console.log(forgot)
		pos("aksi/user/forgotPassword.php", forgot, () => {
			ambil("aksi/user/forgotPassword.php", (res) => {
				$("#notif").tulis(res)
			})
		})
		return false
	})
	function hide() {
		$(".note").hilang()
	}
	tekan('Escape', () => {
		$(".note").hilang()
	})
</script>

</body>
</html>