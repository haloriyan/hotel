<?php
include 'aksi/ctrl/social.php';

setcookie('idhotel', $idhotel, time() + 3900, "/");
setcookie('idresto', '', time() + 1, "/");

$namaHotel = $hotel->get($idhotel, "nama");
$address = $hotel->get($idhotel, "address");
$city = $hotel->get($idhotel, "city");
$icon = $hotel->get($idhotel, "icon");
$cover = $hotel->get($idhotel, "cover");
$website = $hotel->get($idhotel, "website");

$sesi = $user->sesi();
$nama = $user->info($sesi, "nama");
$namaPertama = explode(" ", $nama)[0];

$totExplore = $ctrl->hitung($ctrl->tabel("event")->pilih()->dimana(["idhotel" => $idhotel])->eksekusi());

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
	<link href="../aset/css/style.profile.css" rel="stylesheet">
	<link href="../aset/css/style.explore.css" rel="stylesheet">
	<link href="../aset/css/tambahanProfile.css" rel="stylesheet">
	<script src="../aset/js/embo.js"></script>
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
					<a href="./my"><li><div id="icon"><i class="fa fa-briefcase"></i></div> My Listing</li></a>
					<a href="./settings"><li><div id="icon"><i class="fa fa-cog"></i></div> Settings</li></a>
					<a href="./logout"><li><div id="icon"><i class="fa fa-sign-out"></i></div> Logout</li></a>
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

<div class="cta">
	<input type="hidden" id='idevent' value='<?php echo $idhotel; ?>'>
	<a href='<?php echo $website; ?>' target='_blank' onclick='track(3)'><button id="book" class="merah-2">Book Hotel</button></a>
	<button id="share"><i class="fa fa-share"></i></button>
</div>

<div class="bawah">
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
				<a href="#"><li id="showreviews">Reviews <div class="tot">0</div></li></a>
				<a href="#explores"><li id="showexplores">Explore <div class="tot"><?php echo $totExplore; ?></div></li></a>
				<a href="#"><li id="showrents">Rent <div class="tot">4</div></li></a>
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
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
						</p>
					</div>
				</div>
				<div class="bagian location">
					<div class="wrap">
						<h3><i class="fa fa-map-marker"></i> &nbsp; Location</h3>
						<p>
							<?php echo $address; ?>
						</p>
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
							<!--
							<a href="#">
								<li>
									<img src="../aset/gbr/download (1).jpg" class="ke-kiri">
									<h3 class="ke-kiri">Hisana Pret Ciken</h3>
								</li>
							</a>
							-->
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
			<a href="#popupRegist" id="linkLogin">Register</a> | <a href="./hotel/login">Marcom</a>
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
				<img src="../aset/gbr/dummy.jpg" id="seeImage">
			</div>
		</div>
	</div>
</div>

<script src="../aset/js/profileHotel.js"></script>
<script>
	function track(tipe) {
		let idevent = pilih("#idevent").value
		let param = "tipe="+tipe+"&idevent="+idevent
		pos("../aksi/track.php", param, function() {
			console.log('tracked')
		})
	}
</script>

</body>
</html>