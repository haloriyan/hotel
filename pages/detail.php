<?php
include 'aksi/ctrl/event.php';

$sesi 	= $user->sesi(1);
$name 	= $user->info($sesi, "nama");
$phone 	= $user->info($sesi, "phone");
$address 	= $user->info($sesi, "address");
$namaPertama = explode(" ", $name)[0];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>Dashboard</title>
	<link href='aset/fw/build/fw.css' rel='stylesheet'>
	<link href='aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='aset/css/style.index.css' rel='stylesheet'>
	<link href="aset/css/style.explore-admin.css" rel="stylesheet">
	<style>
		body { background-color: #ecf0f1 !important; }
		#icon {
			width: 60px;
			line-height: 50px;
			padding-top: 12px;
			padding-bottom: 12px;
		}
		.container { margin-bottom: 45px; }
		.box { width: 100%;font-size: 16px;height: 50px;color: #555; }
	</style>
</head>
<body>

<div class="atas merah-2">
	<img src= "aset/gbr/logo.png" class="logoHome">
	<div class="pencarian">
		<i class="fa fa-search"></i>
		<input type="text" class="box" placeholder="Type your search...">
	</div>
	<nav class="menu">
		<a href="#"><li>Home</li></a>
		<a href="#"><li>Explore</li></a>
		<a href="#"><li>City</li></a>
		<li>Hello <?php echo $namaPertama; ?> !</li>
	</nav>
</div>

<div class="kiri">
	<a href="./hello"><div class="listWizard">Dashboard</div></a>
	<a href="./my"><div class="listWizard">My Listings</div></a>
	<a href="./detail"><div class="listWizard" aktif="ya">Detail Information</div></a>
	<a href="./social"><div class="listWizard">Social Network</div></a>
	<a href="./logout"><div class="listWizard">Logout</div></a>
</div>

<div class="container">
	<div>
		<div class="wrap">
			<h4><div id="icon"><i class="fa fa-pencil"></i></div> Detail Information</h4>
			<form id="formDetail">
				<div class="isi">Name :</div>
				<input type="text" class="box" id="name" value="<?php echo $name; ?>">
				<div class="isi">Phone :</div>
				<input type="text" class="box" id="phone" value="<?php echo $phone; ?>">
				<div class="isi">Address :</div>
				<textarea class="box" id="address"><?php echo $address; ?></textarea>
				<br /><br />
				<button class="tbl merah-2">Save</button>
			</form>
		</div>
	</div>
</div>

<script src="aset/js/embo.js"></script>
<script>
	submit("#formDetail", function() {
		let name = pilih("#name").value
		let phone = pilih("#phone").value
		let address = pilih("#address").value
		let detail = "name="+name+"&phone="+phone+"&address="+address
	})
</script>

</body>
</html>