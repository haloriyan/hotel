<?php
include 'aksi/ctrl/social.php';

setcookie('idhotel', $idhotel, time() + 3900, "/");
setcookie('idresto', '', time() + 1, "/");
setcookie('public', '1', time() + 3699, "/");

$namaHotel = $hotel->get($idhotel, "nama");
$address = $hotel->get($idhotel, "address");
$city = $hotel->get($idhotel, "city");
$icon = $hotel->get($idhotel, "icon");
$cover = $hotel->get($idhotel, "cover");
$website = $hotel->get($idhotel, "website");
$description = $hotel->get($idhotel, "description");
$coords = $hotel->get($idhotel, "coords");
$hotelPhone = $hotel->get($idhotel, "phone");

$c = explode("|", $coords);
$lat = $c[0];
$lng = $c[1];

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

$totExplore = $ctrl->hitung($ctrl->tabel("event")->pilih()->dimana(["idhotel" => $idhotel])->eksekusi());

$urlNow = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// Category
$category = ["Food and Beverage","Room","Venue","Sports and Wellness","Shopping","Recreation","Parties","Others"];
$cities = ["Bali","Bandung","Batam","Bogor","Jakarta","Lombok","Makassar","Malang","Pekalongan","Semarang","Solo","Surabaya","Yogyakarta"];
$cities2 = ["Bali","Bandung","Jakarta","Lombok","Makassar","Malang","Semarang","Surabaya","Yogyakarta"];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title><?php echo $namaHotel; ?></title>
	<link href="../aset/fw/build/fw.css" rel="stylesheet">
	<link href="../aset/fw/build/font-awesome.min.css" rel="stylesheet">
	<link href="../aset/css/bootstrap.min.css">
	<link href="../aset/css/style.index.css" rel="stylesheet">
	<link href="../aset/css/tambahanIndex.css" rel="stylesheet">
	<link href="../aset/css/style.profile.css" rel="stylesheet">
	<link href="../aset/css/style.explore.css" rel="stylesheet">
	<link href="../aset/css/tambahanProfile.css" rel="stylesheet">
	<style>
		<?php if($sebagai == "hotel") { ?>
			#subCity {
				right: 17.5%;
			}
			#subCat { right: 20%; }
			@media (max-width: 720px) {
				#subCat,#subCity {
					right: 0%;
				}
			}
		<?php }else if($sebagai == "public") { ?>
			#subUser {
				right: 0%;
			}
		<?php } ?>
		@media (max-width: 720px) {
			.logoHome { display: block; }
		}
	</style>
</head>
<body>

<div class="atas">
	<img src= "../aset/gbr/logo.png" class="logoHome">
	<div id="tblMenu" aksi="bkMenu"><i class="fa fa-bars"></i></div>
	<nav class="menu">
		<a href="../"><li>Home</li></a>
		<a href="../explore"><li id="adaSub">Explore &nbsp; <i class="fa fa-angle-down"></i>
			<nav class="sub" id="subCat">
				<?php
				foreach ($category as $key => $value) {
					echo "<a href='../explore&q=&cat=".$value."'><li>".$value."</li></a>";
				}
				?>
			</nav>
		</li></a>
		<a href="#"><li id="adaSub">City &nbsp; <i class="fa fa-angle-down"></i>
			<nav class="sub" id="subCity">
				<?php
				foreach ($cities2 as $key => $value) {
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
					<a href="./dashboard"><li><div id="icon"><i class="fa fa-home"></i></div> Dashboard</li></a>
					<a href="./detail"><li><div id="icon"><i class="fa fa-user"></i></div> Profile</li></a>
					<a href="./listing"><li><div id="icon"><i class="fa fa-pencil"></i></div> Listing</li></a>
					<a href="./restaurant"><li><div id="icon"><i class="fa fa-cutlery"></i></div> Restaurant</li></a>
					<a href="./logout"><li><div id="icon"><i class="fa fa-sign-out"></i></div> Logout</li></a>
					<?php
					}
					?>
				</nav>
			</li>
			<?php
			if($sebagai == "hotel") { ?>
				<button id="cta" style="display: inline-block;" onclick="mengarahkan('../hotel/add-listing');" class="tbl"><i class="fa fa-plus-circle"></i> Add Listing</button>
			<?php }
		}
		?>
	</nav>
</div>

<div class="bege"></div>
<div class="cover">
	<img src="../aset/gbr/<?php echo $cover; ?>">
</div>

<div class="cta">
	<input type="hidden" id='idevent' value='<?php echo $idhotel; ?>'>
	<a href='<?php echo $website; ?>' target='_blank' onclick='track(3)'><button id="book" class="merah-2">Visit Website</button></a>
	<button id="share"><i class="fa fa-share"></i></button>
</div>

<button id="phone" class="merah-2" aksi="on"><i class="fa fa-phone"></i></button>
<div class="sharer">
	<div class="tombol" tipe='facebook' onclick="ogShare()"><i class="fa fa-facebook"></i></div>
	<div class="tombol" tipe='twitter' onclick="shareTwitter()"><i class="fa fa-twitter"></i></div>
</div>

<div class="listContact">
	<input type="hidden" id="telepon" value="<?php echo $hotelPhone; ?>">
	<a href="https://api.whatsapp.com/send?phone=<?php echo $hotelPhone; ?>" target="_blank" onclick='track(1)'><li id="wa"><div id="icon"><i class="fa fa-whatsapp"></i></div> Whatsapp</li></a>
	<a href="tel:+<?php echo $hotelPhone; ?>" onclick="track(2)"><li id="call"><div id="icon"><i class="fa fa-phone"></i></div> Call</li></a>
</div>

<div class="bawah">
	<input type="hidden" id="urlNow" value="<?php echo $urlNow; ?>">
	<div class="nav">
		<div class="wrap">
			<img src="../aset/gbr/<?php echo $icon; ?>" class="iconHotel">
			<div class="ketHotel">
				<h2><?php echo $namaHotel; ?></h2>
				<p>
					<?php echo $city; ?>
				</p>
			</div>
			<div class="menuHotel">
				<a href="#profiles"><li id="showprofiles" aktif="ya">Profile</li></a>
				<!-- <a href="#loadReviews"><li id="showreviews">Reviews <div class="tot">0</div></li></a> -->
				<!-- <a href="#"><li id="showreviews">Reviews <div class="tot">0</div></li></a> -->
				<!-- <a href="#loadReviews"><li id="showreviews">Reviews <div class="tot">0</div></li></a> -->
				<a href="#explores"><li id="showexplores">Explore <div class="tot"><?php echo $totExplore; ?></div></li></a>
				<!-- <a href="#"><li id="showrents">Rent <div class="tot">4</div></li></a> -->
			</div>
		</div>
	</div>
	<div class="bawahe">
		<div class="wrap">
			<div class="hiddenBawah" id="rents">
				<div class="wrap">
					<h3>Rents</h3>
				</div>
			</div>
			<div class="hiddenBawah" id="reviews">
				<div class="wrap">
					<h3>Reviews</h3>
					<div id="loadReviews">
					</div>
				</div>
			</div>
			<div class="hiddenBawah" id="explores">
				<h3>Explore</h3>
				<div id="loadExplore"></div>
			</div>
			<div class="hiddenBawah" id="galeries">
				<div class="wrap">
					<h2>
						Gallery
						<div id="xGaleri" class="ke-kanan"><i class="fa fa-close"></i></div>
					</h2>
					<div id="loadGaleri"></div>
				</div>
			</div>
			<div id="profiles">
			<div class="ke-kiri" id="bawahKiri">
				<div class="bagian">
					<div class="wrap">
						<h3><i class="fa fa-align-justify"></i> &nbsp; Description</h3>
						<p>
							<?php echo $description; ?>
						</p>
					</div>
				</div>
				<div class="bagian location">
					<div class="wrap">
						<h3><i class="fa fa-map-marker"></i> &nbsp; Location</h3>
						<input type="hidden" id="latInput">
						<input type="hidden" id="lngInput">
						<textarea id="address" class="box" readonly><?php echo $address; ?></textarea>
						<div id="myMaps" style="height: 300px;"></div>
					</div>
				</div>
				<div class="bagian location" id="socialNetwork">
					<div class="wrap">
						<h3><i class="fa fa-map-marker"></i> &nbsp; Follow Us</h3>
						<?php
						foreach($social->all($idhotel) as $row) {
							echo "<a href='".$row['url']."' target='_blank'>".
								 "<div class='listFac'>".
									"<div class='tot'><i class='fa fa-".strtolower($row['type'])."'></i></div>".
									"&nbsp; ".$row['type'].
								 "</div>".
								 "</a>";
						}
						?>
						<a href='<?php echo $website; ?>' target="_blank">
							<div class="listFac">
								<div class="tot"><i class="fa fa-link"></i></div>
								&nbsp;
								Website
							</div>
						</a>
					</div>
				</div>
			</div>
			<div class="ke-kanan" id="bawahKanan">
				<div class="bagian galeriBag">
					<div class="wrap">
						<h3><i class="fa fa-image"></i> &nbsp; Galeri
							<a id="allGallery" class="ke-kanan" style="font-family: OLight;cursor: pointer;">see more images</a>
						</h3>
						<div class="imgCollection">
							<?php
							$image = $ctrl->tabel("galeri")->pilih()->dimana(["idhotel" => $idhotel, "tipe" => "hotel"])->batas(0, 3)->eksekusi();
							while($r = $ctrl->ambil($image)) {
								echo "<img src='../aset/gbr/".$r['gambar']."'>";
							}
							?>
						</div>
					</div>
				</div>
				<div class="bagian facilities">
					<div class="wrap">
						<h3><i class="fa fa-times-square"></i> &nbsp; Facilities</h3>
						<?php
						$myFac = $hotel->get($idhotel, "facility");
						$fac = explode(",", $myFac);
						foreach ($fac as $key => $value) {
							$nama = $hotel->infoFac($value, "nama");
							$icon = $hotel->infoFac($value, "icon");
							echo "<div class='listFac'>".
									"<div class='tot'><i class='".$icon."'></i></div>".
									"&nbsp; ".
									$nama.
								 "</div>";
						}
						?>
					</div>
				</div>
				<div class="bagian">
					<div class="wrap">
						<h3><i class="fa fa-cutlery"></i> &nbsp; Restaurant</h3>
						<?php
						$ourResto = $hotel->ourResto($idhotel);
						?>
						<div id="ourResto">
							<?php
							foreach ($ourResto as $row) {
								echo "<a href='../restoran/".$row['idresto']."'>".
										"<li>".
											"<img src='../aset/gbr/".$row['icon']."' class='ke-kiri'>".
											"<h3 class='ke-kiri'>".$row['nama']."</h3>".
										"</li>".
									 "</a>";
							}
							?>
						</div>
					</div>
				</div>
			</div>	
			</div>
		</div>
	</div>
</div>

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
			<a href="#popupRegist" id="linkLogin">Register</a> | <a href="../hotel/login">Hotel</a>
		</div>
	</form>
</div>
<div class="popupWrapper" id="popupSeeImage">
	<div class="popup">
		<div class="wrap">
			<h3>
				<div id="xSeeImg" class="ke-kanan"><i class="fa fa-close"></i></div>
			</h3>
			<br />
			<div class="rata-tengah">
				<img src="" id="seeImage">
			</div>
		</div>
	</div>
</div>

<script src="../aset/js/embo.js"></script>
<script type="text/javascript" src='https://maps.google.com/maps/api/js?libraries=places&key=AIzaSyDqYJGuWw9nfoyPG8d9L1uhm392uETE-mA'></script>
<script src="../aset/js/jquery-3.1.1.js"></script>
<script src="../aset/js/locationpicker.jquery.min.js"></script>
<script src="../aset/js/profileHotel.js"></script>
<script>
	function munculContact() {
		muncul(".bg")
		pengaya(".listContact", "right: 2.5%")
		pengaya("#wa", "left: 0px")
		setTimeout(function() {
			pengaya("#call", "left: 0px")
		}, 400)
	}
	function hilangContact() {
		pengaya("#wa", "left: 300px")
		setTimeout(function() {
			pengaya("#call", "left: 300px")
		}, 400)
		setTimeout(function() {
			hilang(".bg")
			pengaya(".listContact", "right: -25%")
		}, 750)
	}
	tekan("Escape", () => {
		hilangContact()
		hilangShare()
	})
	klik(".bg", () => {
		hilangContact()
		hilangShare()
	})

	klik("#phone", function() {
		let aksi = pilih("#phone").getAttribute("aksi")
		if(aksi == "on") {
			munculContact()
			pilih("#phone").setAttribute("aksi", "off")
		}else {
			hilangContact()
			pilih("#phone").setAttribute("aksi", "on")
		}
	})
	function track(tipe) {
		let idevent = pilih("#idevent").value
		let param = "tipe="+tipe+"&idevent="+idevent
		pos("../aksi/track.php", param, function() {
			console.log('tracked')
		})
	}
	function munculShare() {
		muncul(".bg")
		muncul(".sharer")
		muncul("#phone")
	}
	function hilangShare() {
		hilang(".bg")
		hilang(".sharer")
		hilang("#phone")
	}
	klik("#share", () => {
		munculShare()
	})
	let redirect = btoa(pilih("#urlNow").value)
	$('#myMaps').locationpicker({
		location: {
			latitude: <?php echo $lat; ?>,
			longitude: <?php echo $lng; ?>
		},
		radius: 0,
		inputBinding: {
			latitudeInput: $('#latInput'),
			longitudeInput: $('#lngInput')
		},
		draggable: false,
		onchanged: function() {
			//
		},
		enableAutocomplete: true,
	})
	klik("#tblLogin", function() {
		mengarahkan("../auth&r="+redirect)
	})
</script>

</body>
</html>
