<?php

$cookieNotif = $_COOKIE['kukiLogin'];
$redirect = $_GET['r'];
$aksi = $_GET['aksi'];
$decodedRedirect = base64_decode($redirect);
if($decodedRedirect == "") {
	header("location: ./auth&r=".base64_encode("./my"));
}

session_start();
$sesiHotel = $_SESSION['uhotel'];
if($aksi == "logout") {
	session_destroy();
	header("location: ./auth&r=".$redirect);
}else {
	if($sesiHotel != null) {
		header('location: ./hotel/dashboard');
	}
	if($_SESSION['upublic'] != null) {
		header('location: '.$decodedRedirect);
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale = 1'>
	<title>Auth - Dailyhotels</title>
	<link href='aset/fw/build/fw.css' rel='stylesheet'>
	<link href='aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='aset/css/style.auth.css' rel='stylesheet'>
</head>
<body>

<div class="logoHome">
	<img src="aset/gbr/logo.png">
</div>

<div class="container">
	<input type="hidden" id="redirect" value="<?php echo $redirect; ?>">
	<div class="bagLogin" id="loginPublic">
		<div class="wrap">
			<form id="formLoginPublic">
				<h2>Login</h2>
				<div>E-Mail</div>
				<input type="email" class="box" id="emailLogPublic" required autocomplete="off">
				<div>Password</div>
				<input type="password" class="box" id="pwdLogPublic" required autocomplete="off">
				<div class="bagTombol">
					<div class="bag bag-4">
						<button class="tbl">LOGIN</button>
					</div>
					<div class="bag bag-3" id="optLogin">
						or <a href="#" id="linkRegPublic">register</a>
					</div>
				</div>
			</form>
			<form id="formRegPublic">
				<h2>Register</h2>
				<div>Name</div>
				<input type="text" class="box" id="nameRegPublic" required autocomplete="off">
				<div>E-Mail</div>
				<input type="email" class="box" id="emailRegPublic" required autocomplete="off">
				<div>Password</div>
				<input type="password" class="box" id="pwdRegPublic">
				<div class="bagTombol">
					<div class="bag bag-4">
						<button class="tbl">REGISTER</button>
					</div>
					<div class="bag bag-3" id="optLogin">
						or <a href="#" id="linkLogPublic">login</a>
					</div>
				</div>
			</form>
			<form id="suksesRegPublic">
				<h2>We've already sent an email verification</h2>
				<p>
					Click the link in the email that has been sent. Please check your spam if you aint find it. And let's exploring dailyhotels
				</p>
			</form>
		</div>
	</div>
	<div class="bagLogin" id="loginMarcom">
		<div class="wrap">
			<form id="formLoginMarcom">
				<h2>Login as Hotel</h2>
				<div>E-Mail</div>
				<input type="text" class="box" id="emailLogMarcom" required autocomplete="off">
				<div>Password</div>
				<input type="password" class="box" id="pwdLogMarcom" required autocomplete="off">
				<div class="bagTombol">
					<div class="bag bag-5">
						<button class="tbl">LOGIN</button>
					</div>
					<div class="bag bag-3" id="optLogin">
						or <a href="#" id="linkRegMarcom">register</a>
					</div>
				</div>
			</form>
			<form id="formRegMarcom">
				<h2>Register as Hotel</h2>
				<div>Name</div>
				<input type="text" class="box" id="nameRegMarcom" required autocomplete="off">
				<div>E-Mail</div>
				<input type="email" class="box" id="emailRegMarcom" required autocomplete="off">
				<div>Password</div>
				<input type="password" class="box" id="pwdRegMarcom" required autocomplete="off">
				<div class="bagTombol">
					<div class="bag bag-5">
						<button class="tbl">REGISTER</button>
					</div>
					<div class="bag bag-3" id="optLogin">
						or <a href="#" id="linkLogMarcom">login</a>
					</div>
				</div>
			</form>
			<form id="suksesRegMarcom">
				<h2>You've been registered!</h2>
				<p>
					Next, you must verify your email address and then complete more information about your hotel before you can add an event
				</p>
				<div class="bagTombol" id="optLogin">
					<a href="#" id="linkLogMarcom2">back to login</a>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="bg"></div>
<div class="popupWrapper" id="notif">
	<div class="popup">
		<div class="wrap">
			<h3><i class="fa fa-info-circle"></i> &nbsp; Alert!
				<div class="ke-kanan" id="xNotif"><i class="fa fa-close"></i></div>
			</h3>
			<p>
				<?php echo $cookieNotif; ?>
			</p>
		</div>
	</div>
</div>

<script src='aset/js/embo.js'></script>
<script>
	function validasi_input(inputs) {
   		let pola_username=/^[a-zA-Z0-9\_\-]{6,100}$/;
   		if (!pola_username.test(inputs)){
      		return 'salah';
   		}
		return 'benar';
	}
	tekan("Escape", () => {
		hilangPopup("#notif")
	})
	klik("#xNotif", () => {
		hilangPopup("#notif")
	})
	klik("#linkLogMarcom", () => {
		hilang("#formRegMarcom")
		muncul("#formLoginMarcom")
	})
	klik("#linkLogMarcom2", () => {
		hilang("#suksesRegMarcom")
		hilang("#formRegMarcom")
		muncul("#formLoginMarcom")
	})
	klik("#linkRegMarcom", () => {
		hilang("#formLoginMarcom")
		muncul("#formRegMarcom")
	})
	klik("#linkLogPublic", () => {
		hilang("#formRegPublic")
		muncul("#formLoginPublic")
	})
	klik("#linkRegPublic", () => {
		hilang("#formLoginPublic")
		muncul("#formRegPublic")
	})

	let redirect
	let getRedirect = pilih("#redirect").value
	if(getRedirect != "" || getRedirect != 0) {
		redirect = atob(getRedirect)
	}else {
		redirect = getRedirect
	}

	submit("#formRegPublic", () => {
		let name = pilih("#nameRegPublic").value
		let email = pilih("#emailRegPublic").value
		let pwd = pilih("#pwdRegPublic").value
		let reg = "name="+name+"&email="+email+"&pwd="+pwd

		if(validasi_input(pwd) == "salah") {
			alert ('Username must at least 6 characters and can only be letters or numbers!');
			return false
		}

		pos("aksi/user/register.php", reg, () => {
			// hilangkan
			pilih("#nameRegPublic").value = ''
			pilih("#emailRegPublic").value = ''
			pilih("#pwdRegPublic").value = ''

			hilang("#formRegPublic")
			muncul("#suksesRegPublic")
			console.log("registered")
		})
		return false
	})
	submit("#formLoginPublic", () => {
		let email = pilih("#emailLogPublic").value
		let pwd = pilih("#pwdLogPublic").value
		let log = "email="+email+"&pwd="+pwd
		pos("aksi/setCookie.php", "namakuki=bagLogin&value=public&durasi=1255", () => {
			//
		})
		pos("aksi/user/login.php", log, () => {
			if(redirect == "" || redirect == 0) {
				mengarahkan("./my")
			}else {
				mengarahkan(redirect)
			}
		})
		return false
	})
	submit("#formRegMarcom", () => {
		let name = pilih("#nameRegMarcom").value
		let email = pilih("#emailRegMarcom").value
		let pwd = pilih("#pwdRegMarcom").value
		let reg = "name="+name+"&email="+email+"&pwd="+pwd

		if(validasi_input(pwd) == "salah") {
			alert ('Username minimal 6 karakter dan hanya boleh Huruf atau Angka!');
			return false
		}
		pos("aksi/hotel/register.php", reg, () => {
			// hilangkan
			pilih('#nameRegMarcom').value = ''
			pilih('#emailRegMarcom').value = ''
			pilih('#pwdRegMarcom').value = ''

			hilang("#formRegMarcom")
			muncul("#suksesRegMarcom")
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
</script>

<?php
if($cookieNotif != "") {
	echo '<script>
munculPopup("#notif", pengaya("#notif", "top: 170px"))
</script>';
}
?>

</body>
</html>