<?php
include 'aksi/ctrl/booking.php';

function toIdr($angka) {
	return 'Rp. '.strrev(implode('.', str_split(strrev(strval($angka)), 3)));
}

// Bagian User
$sesi = $user->sesi();
$nama = $user->info($sesi, "nama");
$namaPertama = explode(" ", $nama)[0];
$iduser = $user->info($sesi, "iduser");

// Bagian Event
$namaEvent = $event->info($idevent, "title");
$cover = $event->info($idevent, "covers");
$logo = $event->info($idevent, "logos");
$address = $event->info($idevent, "address");
$description = $event->info($idevent, "description");
$price = toIdr($event->info($idevent, "price"));

// Bagian Hotel
$idhotel = $event->info($idevent, "idhotel");
$hotelPhone = $hotel->get($idhotel, "phone");
$namaHotel = $hotel->get($idhotel, "nama");
$iconHotel = $hotel->get($idhotel, "icon");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale = 1'>
	<title><?php echo $namaEvent; ?> di Dailyhotels</title>
	<link href='../aset/fw/build/fw.css' rel='stylesheet'>
	<link href='../aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='../aset/css/style.index.css' rel='stylesheet'>
	<link href='../aset/css/style.profile.css' rel='stylesheet'>
	<link href="../aset/css/tambahanEvent.css" rel="stylesheet">
</head>
<body>

<div class="atas">
	<img src= "../aset/gbr/logo.png" class="logoHome">
	<div id="tblMenu" aksi="bkMenu"><i class="fa fa-bars"></i></div>
	<nav class="menu">
		<a href="../"><li>Home</li></a>
		<a href="../explore"><li>Explore</li></a>
		<a href="#"><li>City</li></a>
		<?php
		if(empty($sesi)) { ?>
			<a href="#formLogin" id="tblLogin"><li><i class="fa fa-user"></i> &nbsp;Sign in</li></a>
			<?php
		}else {
			?>
			<li id="adaSub">Hello <?php echo $namaPertama; ?> <i class="fa fa-angle-down"></i>
				<ul class="sub">
					<a href="../my"><li><div id="icon"><i class="fa fa-briefcase"></i></div> My Listing</li></a>
					<a href="../settings"><li><div id="icon"><i class="fa fa-cog"></i></div> Settings</li></a>
					<a href="../logout"><li><div id="icon"><i class="fa fa-sign-out"></i></div> Logout</li></a>
				</ul>
			</li>
			<?php
		}
		?>
		<a href="#tblBook"><li id="tblBook">Book</li></a>
	</nav>
</div>

<div class="bege"></div>
<div class="cover">
	<img src="../aset/gbr/<?php echo $cover; ?>">
</div>

<div class="cta">
	<li id="price"><i class="fa fa-money"></i> &nbsp; <?php echo $price; ?></li>
	<button id="book" class="merah-2">Book Now!</button>
	<button id="share"><i class="fa fa-share"></i></button>
</div>

<div class="bawah">
	<div class="nav">
		<div class="wrap">
			<img src="../aset/gbr/<?php echo $logo; ?>" class="iconHotel">
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
			<div class="ke-kiri" id="bawahKiri">
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
			<div class="ke-kanan" id="bawahKanan">
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
<div class="formPopup" id="formLogin">
	<form class="wrap" id="formSignIn">
		<h4><i class="fa fa-user"></i> &nbsp; Sign in
			<div id="xLog" class="ke-kanan"><i class="fa fa-close"></i></div>
		</h4>
		<input type="text" class="box" placeholder="Email" id="mailLog"><br />
		<input type="password" class="box" placeholder="Password" id="pwdLog"><br />
		<div class="bag-tombol">
			<button class="merah-2">Sign in</button>
		</div>
		<div class="bag bag-5">
			<input type="checkbox" id="rememberMe"> <label for="rememberMe">Remember me</label>
		</div>
		<div class="bag bag-5 rata-kanan">
			<a href="#">Forgot password?</a>
		</div>
		<br />
		<div class="rata-tengah" style="margin-bottom: 15px;">
			<a href="#popupRegist" id="linkLogin">Register</a> | <a href="./hotel/login">Marcom</a>
		</div>
	</form>
</div>

<div class="popupWrapper" id="popupBook">
	<div class="popup">
		<div class="wrap">
			<h3>Book Event
				<div id="xBook" class="ke-kanan"><i class="fa fa-close"></i></div>
			</h3>
			<form id="formBook">
				<input type="hidden" id="idevent" value="<?php echo $idevent; ?>">
			<?php
			if($booking->cek($idevent, $iduser) == "ada")  {
				echo "<p>You've booked this event. See your <a href='../my' target='_blank'>listing event</a></p>";
			}else {
			if($sesi != "") {
			?>
				<div class="bag bag-7">
					<div class="isi">Select date :</div>
					<input type="date" class="box" id="tglBook" style="font-size: 17px;width: 80%" required>
				</div>
				<div class="bag bag-3">
					<div class="isi">Quantity</div>
					<select class="box" id="qty">
						<?php
						for($i = 1; $i <= 10; $i++) {
							echo "<option>".$i."</option>";
						}
						?>
					</select>
				</div>
				<div class="bag-tombol">
					<button class="merah-2">Book Now!</button>
				</div>
			<?php
			}else { ?>
				<p>You must login before booking an event</p>
			<?php } }
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
<script src="../aset/js/script.event.js"></script>

</body>
</html>