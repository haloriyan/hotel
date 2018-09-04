<?php
include 'aksi/ctrl/booking.php';

function toIdr($angka) {
	return 'Rp. '.strrev(implode('.', str_split(strrev(strval($angka)), 3)));
}

$event->hint($idevent);

// Bagian User
$sesi = $user->sesi();
$nama = $user->info($sesi, "nama");
$namaPertama = explode(" ", $nama)[0];
$iduser = $user->info($sesi, "iduser");

// Bagian Event
$namaEvent = $event->info($idevent, "title");
if($namaEvent == "") {
	die("error");
}
$cover = $event->info($idevent, "covers");
$logo = $event->info($idevent, "logos");
$address = $event->info($idevent, "address");
$description = $event->info($idevent, "description");
$price = toIdr($event->info($idevent, "price"));
$tglMulai = $event->info($idevent, "tgl_mulai");
$tglAkhir = $event->info($idevent, "tgl_akhir");
$qty = $event->info($idevent, "availableseat");
$quota = $event->info($idevent, "quota");

// Bagian Hotel
$idhotel = $event->info($idevent, "idhotel");
$hotelPhone = $hotel->get($idhotel, "phone");
$namaHotel = $hotel->get($idhotel, "nama");
$iconHotel = $hotel->get($idhotel, "icon");

// Disabled dates
function getDisabledDate() {
	$booking = new booking();
	$cekDate = $booking->cekAvailable("18846");
	foreach($cekDate as $key => $value) {
		$res .= '"'.$value.'",';
	}
	return $res;
}

setcookie('idevents', $idevent, time() + 3666, "/");

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
	<title><?php echo $namaEvent; ?> on Dailyhotels</title>
	<link href='../aset/fw/build/fw.css' rel='stylesheet'>
	<link href='../aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='../aset/css/jquery-ui.min.css' rel='stylesheet'>
	<link href='../aset/css/style.index.css' rel='stylesheet'>
	<link href='../aset/css/style.profile.css' rel='stylesheet'>
	<link href="../aset/css/tambahanIndex.css" rel="stylesheet">
	<link href="../aset/css/tambahanEvent.css" rel="stylesheet">
	<link rel="stylesheet" href="../aset/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="../aset/flatpickr/dist/themes/material_red.css">
</head>
<body>

<div class="atas">
	<img src= "../aset/gbr/logo.png" class="logoHome">
	<div id="tblMenu" aksi="bkMenu"><i class="fa fa-bars"></i></div>
	<nav class="menu">
		<a href="../"><li>Home</li></a>
		<a href="../explore"><li id="adaSub">Explore &nbsp; <i class="fa fa-angle-down"></i>
			<nav class="sub merah-2" id="subCat">
				<?php
				foreach ($category as $key => $value) {
					echo "<a href='../explore&q=&cat=".$value."'><li>".$value."</li></a>";
				}
				?>
			</nav>
		</li></a>
		<a href="#"><li id="adaSub">City &nbsp; <i class="fa fa-angle-down"></i>
			<nav class="sub merah-2" id="subCity">
				<?php
				foreach ($city as $key => $value) {
					echo "<a href='../explore&q=&cat=&city=".$value."'><li>".$value."</li></a>";
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
				<ul class="sub">
					<a href="../my"><li><div id="icon"><i class="fa fa-briefcase"></i></div> My Listing</li></a>
					<a href="../detail"><li><div id="icon"><i class="fa fa-cog"></i></div> Settings</li></a>
					<a href="../logout"><li><div id="icon"><i class="fa fa-sign-out"></i></div> Logout</li></a>
				</ul>
			</li>
			<?php
		}
		?>
	</nav>
</div>

<div class="bege"></div>
<div class="cover">
	<img src="../aset/gbr/<?php echo $cover; ?>">
</div>

<input type="hidden" id="availableseat" value="<?php echo $qty; ?>">

<div class="cta">
	<li id="price"><i class="fa fa-money"></i> &nbsp; <?php echo $price; ?></li>
	<button id="book" class="merah-2">Book Now!</button>
	<button id="share"><i class="fa fa-share"></i></button>
</div>

<div class="bawah">
	<div class="nav">
		<div class="wrap">
			<img src="../aset/gbr/<?php echo $iconHotel; ?>" class="iconHotel">
			<div class="ketHotel">
				<h2><?php echo $namaEvent; ?></h2>
				<p>
					<?php echo $address; ?>
				</p>
			</div>
			<div class="menuHotel">
				<a href="#"><li class="active">Details</li></a>
				<a href="#"><li>Comments <div class="tot">0</div></li></a>
			</div>
		</div>
	</div>
	<div class="bawahe">
		<div class="wrap">
			<div id="bawahKiri">
				<div class="bagian">
					<div class="wrap">
						<h3><i class="fa fa-align-justify"></i> &nbsp; Description</h3>
						<p>
							<?php
							echo $description;
							?>
						</p>
					</div>
				</div>
			</div>
			<div id="bawahKanan">
				<div class="bagian location">
					<div class="wrap">
						<h3><i class="fa fa-map-marker"></i> &nbsp; Location</h3>
						<p>
							<?php echo $address; ?>
						</p>
					</div>
				</div>
				<div class="bagian hosted">
					<div class="wrap">
						<a href="../hotel/<?php echo $idhotel; ?>" style="color: #444;text-decoration: none;">
						<h3><i class="fa fa-map-marker"></i> &nbsp; Hosted by</h3>
						<p>
							<img src="../aset/gbr/<?php echo $iconHotel; ?>" class="iconHotel"><br />
							<span><?php echo $namaHotel; ?></span>
						</p>
						</a>
					</div>
				</div>
			</div>	
		</div>
	</div>
</div>

<button id="phone" class="merah-2" aksi="on"><i class="fa fa-phone"></i></button>

<div class="bg"></div>
<div class="popupWrapper" id="formLoginBaru">
	<div id="xLog"><i class="fa fa-close"></i> UASU</div>
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
					<input type="email" class="box" id="emailLogMarcom" required>
					<div>Password :</div>
					<input type="password" class="box" id="pwdLogMarcom" required>
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
					<input type="text" class="box" id="nameRegMarcom" required>
					<div>E-Mail :</div>
					<input type="email" class="box" id="emailRegMarcom" required>
					<div>Password :</div>
					<input type="password" class="box" id="pwdRegMarcom" required>
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

<div class="popupWrapper" id="popupBook">
	<div class="popup">
		<div class="wrap">
			<h3>Book Event
				<div id="xBook" class="ke-kanan"><i class="fa fa-close"></i></div>
			</h3>
			<form id="formBook">
				<input type="hidden" id="minDate" value="<?php echo $tglMulai; ?>">
				<input type="hidden" id="maxDate" value="<?php echo $tglAkhir; ?>">
				<input type="hidden" id="idevent" value="<?php echo $idevent; ?>">
			<?php
			if($booking->cek($idevent, $iduser) == "ada")  {
				echo "<p>You've booked this event. See your <a href='../my' target='_blank'>listing event</a></p>";
			}else {
			if($sesi != "") {
			?>
				<div class="bag bag-7">
					<div class="isi">Select date :</div>
					<input type="text" class="box" id="tglBook" style="font-size: 17px;width: 80%;background: #fff;" required onchange='selectDate(this.value)' placeholder="YYYY-MM-DD" value=''>
				</div>
				<div class="bag bag-3">
					<div id="loadBoxQty"></div>
				</div>
				<div class="bag-tombol">
					<button class="merah-2">Book Now!</button>
				</div>
			<?php
			}else { ?>
				<p>You must login before booking an event</p>
			<?php } 
			}
			?>
			</form>
		</div>
	</div>
</div>

<div class="popupWrapper" id="suksesBook">
	<div class="popup">
		<div class="wrap">
			<h3>Event Booked!
				<div id="xSukses" class="ke-kanan"><i class="fa fa-close"></i></div>
			</h3>
			<p>
				
			</p>
		</div>
	</div>
</div>

<div class="listContact">
	<input type="hidden" id="telepon" value="<?php echo $hotelPhone; ?>">
	<a href="https://api.whatsapp.com/send?phone=<?php echo $hotelPhone; ?>" target="_blank" onclick='track(1)'><li id="wa"><div id="icon"><i class="fa fa-whatsapp"></i></div> Whatsapp</li></a>
	<a href="tel:+<?php echo $hotelPhone; ?>" onclick="track(2)"><li id="call"><div id="icon"><i class="fa fa-phone"></i></div> Call</li></a>
</div>

<script src='../aset/js/embo.js'></script>
<script src='../aset/js/jquery-3.1.1.js'></script>
<script src="../aset/flatpickr/dist/flatpickr.js"></script>
<script src="../aset/js/script.index.js"></script>
<script src="../aset/js/script.event.js"></script>

<script>
klik("#book", function() {
	munculPopup("#popupBook", pengaya("#popupBook", "top: 140px"))
})
submit("#formBook", function() {
	let idevent = pilih("#idevent").value
	let tgl = pilih("#tglBook").value
	if(tgl == "0000-00-00" || tgl == "") {
		return false
	}
	let qty = pilih("#qty").value
	let book = "idevent="+idevent+"&tgl="+tgl+"&qty="+qty
	pos("../aksi/booking/book.php", book, function() {
		hilangPopup("#popupBook")
		munculPopup("#suksesBook", pengaya("#suksesBook", "top: 230px"))
		setTimeout(() => {
			location.reload()
		}, 1200)
	})
	return false
})
function loadBoxQty() {
	ambil("../aksi/event/loadBoxQty.php", (res) => {
		tulis("#loadBoxQty", res)
	})
}
function selectDate(val) {
	let set = "namakuki=tglevent&value="+val+"&durasi=3666"
	pos("../aksi/setCookie.php", set, () => {
		loadBoxQty()
	})
}
flatpickr("#tglBook", {
	dateFormat: "Y-m-d",
	minDate: pilih("#minDate").value,
	maxDate: pilih("#maxDate").value,
	disable: [<?php echo getDisabledDate(); ?>]
})
submit("#formLoginPublic", () => {
	let email = pilih("#emailLogPublic").value
	let pwd = pilih("#pwdLogPublic").value
	let log = "email="+email+"&pwd="+pwd
	if (email == "" || pwd == "") {
		return false
	}
	pos("../aksi/user/login.php", log, (err) => {
		location.reload()
	})
	return false
})
submit("#formRegPublic", () => {
	let name = pilih("#nameRegPublic").value
	let email = pilih("#emailRegPublic").value
	let pwd = pilih("#pwdRegPublic").value
	let reg = "name="+name+"&email="+email+"&pwd="+pwd
	if(name == "" || email == "" || pwd == "") {
		return false
	}
	pos("../aksi/user/register.php", reg, () => {
		hilangPopup("#formLoginBaru")
		muncul(".bg")
		muncul("#suksesReg")
	})
	return false	
})
</script>

</body>
</html>