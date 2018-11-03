<?php
include 'aksi/ctrl/booking.php';

function toIdr($angka) {
	return 'Rp. '.strrev(implode('.', str_split(strrev(strval($angka)), 3)));
}
function sayDate($date) {
	$d = explode("-", $date);
	$thn = $d[0];
	$bln = $d[1];
	$tgl = $d[2];

	$blns = ["01" => "January","02" => "February","03" => "March", "04" => "April", "05" => "May", "06" => "June", "07" => "July", "08" => "August", "09" => "September", "10" => "October", "11" => "November", "12" => "December"];

	return $blns[$bln]." ".$tgl.", ".$thn;
}

$event->hint($idevent);

// Bagian User
session_start();
$sesiHotel = $_SESSION['uhotel'];
if($sesiHotel == "") {
	$sesi = $user->sesi();
	$nama = $user->info($sesi, "nama");
	$sebagai = "public";
}else {
	$sesi = $hotel->sesi(1);
	$nama = $hotel->get($sesi, "nama");
	$sebagai = "hotel";
}
$namaPertama = explode(" ", $nama)[0];
$iduser = $user->info($sesi, "iduser");

// Bagian Event
global $idevent;
$namaEvent = $event->info($idevent, "title");
if($namaEvent == "") {
	die("error");
}
$cover = $event->info($idevent, "covers");
$alamat = $event->info($idevent, "alamat");
$region = $event->info($idevent, "region");
$description = $event->info($idevent, "description");
$price = toIdr($event->info($idevent, "price"));
$tglMulai = $event->info($idevent, "tgl_mulai");
$tglAkhir = $event->info($idevent, "tgl_akhir");
$qty = $event->info($idevent, "availableseat");
$quota = $event->info($idevent, "quota");

$tglSkrg = date('Y-m-d');
if($tglAkhir < $tglSkrg) {
	$statusExp = "1";
}else {
	$statusExp = "0";
}

// Bagian Hotel
$idhotel = $event->info($idevent, "idhotel");
$hotelPhone = $hotel->get($idhotel, "phone");
$namaHotel = $hotel->get($idhotel, "nama");
$iconHotel = $hotel->get($idhotel, "icon");

// Disabled dates
function getDisabledDate() {
	$booking = new booking();
	global $idevent;
	$cekDate = $booking->cekAvailable($idevent);
	foreach($cekDate as $key => $value) {
		$res .= '"'.$value.'",';
	}
	return $res;
}

setcookie('idevents', $idevent, time() + 3666, "/");
$urlNow = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

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
	<meta property="og:url"                content="<?php echo $urlNow; ?>" />
	<meta property="og:type"               content="article" />
	<meta property="og:title"              content="<?php echo $namaEvent; ?>" />
	<meta property="og:description"        content="<?php substr($description, 0,150); ?>" />
	<meta property="og:image"              content="http://localhost/hotel/aset/gbr/<?php echo $cover; ?>" />
	<title><?php echo $namaEvent; ?> on Dailyhotels</title>
	<link href='../aset/fw/build/fw.css' rel='stylesheet'>
	<link href='../aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='../aset/css/jquery-ui.min.css' rel='stylesheet'>
	<link href='../aset/css/style.index.css' rel='stylesheet'>
	<link href='../aset/css/style.profile.css' rel='stylesheet'>
	<link href="../aset/css/tambahanIndex.css" rel="stylesheet">
	<link href="../aset/css/tambahanEvent.css" rel="stylesheet">
	<style>
		<?php if($sebagai == "hotel") { ?>
			#subCity {
				right: 17.5%;
			}
			#subCat { right: 20%; }
		<?php } ?>
	</style>
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
		if($sesi == "") { ?>
			<a href="#formLogin" id="tblLogin"><li><i class="fa fa-user"></i> &nbsp;Sign in</li></a>
			<?php
		}else if($sesi != "") {
			?>
			<li id="adaSub">Hello <?php echo $namaPertama; ?> <i class="fa fa-angle-down"></i>
				<nav class="sub" id="subUser">
					<?php
					if($sebagai == "public") {
					?>
					<a href="../my"><li><div id="icon"><i class="fa fa-briefcase"></i></div> My Listing</li></a>
					<a href="../detail"><li><div id="icon"><i class="fa fa-cog"></i></div> Settings</li></a>
					<a href="../logout"><li><div id="icon"><i class="fa fa-sign-out"></i></div> Logout</li></a>
					<?php
					}else if($sebagai == "hotel") {
					?>
					<a href="../hotel/detail"><li><div id="icon"><i class="fa fa-cog"></i></div> Settings</li></a>
					<a href="../hotel/galeri"><li><div id="icon"><i class="fa fa-image"></i></div> Gallery</li></a>
					<a href="../hotel/facility"><li><div id="icon"><i class="fa fa-cogs"></i></div> Facility</li></a>
					<a href="../hotel/social"><li><div id="icon"><i class="fa fa-user"></i></div> Social</li></a>
					<a href="../hotel/logout"><li><div id="icon"><i class="fa fa-sign-out"></i></div> Logout</li></a>
					<?php
					}
					?>
				</nav>
			</li>
			<?php
			if($sebagai == "hotel") { ?>
				<button id="cta" class="tbl"><i class="fa fa-plus-circle"></i> Add Listing</button>
			<?php }
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
	<?php if($statusExp == 0) { ?>
	<button id="book" class="merah-2">Book Now!</button>
	<?php } else { ?>
	This event has expired
	<?php } ?>
</div>

<div class="bawah">
	<input type="hidden" id="urlNow" value="<?php echo $urlNow; ?>">
	<div class="nav">
		<div class="wrap">
			<img src="../aset/gbr/<?php echo $iconHotel; ?>" class="iconHotel">
			<div class="ketHotel">
				<h2><?php echo $namaEvent; ?></h2>
				<p>
					<?php echo $region; ?>
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
							<?php echo $alamat; ?>
						</p>
					</div>
				</div>
				<div class="bagian tgl">
					<div class="wrap">
						<h3><i class="fa fa-calendar"></i> &nbsp; Date</h3>
						<p>
							<?php echo sayDate($tglMulai)." - ".sayDate($tglAkhir); ?>
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
<div class="sharer">
	<div class="tombol" tipe='facebook' onclick="ogShare()"><i class="fa fa-facebook"></i></div>
	<div class="tombol" tipe='twitter' onclick="shareTwitter()"><i class="fa fa-twitter"></i></div>
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
				if($sebagai == "hotel") {
					$urlLogout = "../auth&r=".base64_encode($urlNow)."&aksi=logout";
					echo "You can't book event as hotel account. Please <a href='".$urlLogout."'>logout</a> and login as regular account instead";
				}else {
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

<?php
if($sesi == "") {
	echo '<script>
klik("#book", function() {
	mengarahkan("../auth&r='.base64_encode($urlNow).'")
})
</script>';
}else {
	echo '<script>
	klik("#book", function() {
		munculPopup("#popupBook", pengaya("#popupBook", "top: 140px"))
	})
</script>';
}
?>

<script type="text/javascript" src="//connect.facebook.net/en_US/sdk.js"></script>
<script>
flatpickr("#tglBook", {
	dateFormat: "Y-m-d",
	minDate: pilih("#minDate").value,
	maxDate: pilih("#maxDate").value,
	disable: [<?php echo getDisabledDate(); ?>]
})
</script>
<script src="../aset/js/tambahanEvent.js"></script>
<?php
if(isset($_COOKIE['kukiLogin'])) {
	echo '<script>
muncul(".bg")
muncul("#notif")
</script>';
}
?>

</body>
</html>