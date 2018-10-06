<?php
include 'aksi/ctrl/resto.php';

// login to resto account
if($_GET['id'] !== null) {
	$resto->login($_GET['id']);
}else if($_GET['namaResto'] != null) {
	$resto->login($_GET['namaResto']);
}

$sesi 	= $resto->sesi();
$idresto = $resto->info($sesi, "idresto");
$name 	= $resto->info($sesi, "nama");
$namaPertama = explode(" ", $name)[0];

function getAllCuisine() {
	$ctrl = new controller();
	$q = $ctrl->tabel('cuisine')->pilih()->eksekusi();
	while($r = $ctrl->ambil($q)) {
		$hasil[] = $r;
	}
	return $hasil;
}

$myCuisine = $resto->info($sesi, 'cuisine');
$cui = explode(',', $myCuisine);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>Cuisine</title>
	<link href='../aset/fw/build/fw.css' rel='stylesheet'>
	<link href='../aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='../aset/css/style.index.css' rel='stylesheet'>
	<link href="../aset/css/style.explore-admin.css" rel="stylesheet">
	<style>
		#saved {
			padding: 15px 35px;
			background: rgba(76, 175, 80, 0.85);
			color: #fff;
			margin-bottom: -35px;
			margin-top: 10px;
			display: none;
		}
		#myListing img {
			width: 50px;
			height: 50px;
		}
		#myListing li {
			display: inline-block;
			color: #cb0023;
			cursor: pointer;
		}
		td a { font-size: 15px; }
		th {
			text-align: left;
			padding: 5px;
			background-color: #fff;
			border-bottom: 1px solid #ccc;
		}
		td {
			padding: 10px;
			border-bottom: 1px solid #ddd;
			background-color: #fff;
		}
		td h4 { margin-top: 5px; }
	</style>
</head>
<body>

<div class="atas merah-2">
	<img src= "../aset/gbr/logo.png" class="logoHome">
	<div class="pencarian">
		<i class="fa fa-search"></i>
		<input type="text" class="box" placeholder="Type your search...">
	</div>
	<nav class="menu">
		<a href="../restoran/<?php echo $idresto; ?>" target='_blank'><li>Hello <?php echo $namaPertama; ?> !</li></a>
		<button id="cta" class="tbl"><i class="fa fa-plus-circle"></i> Add Listing</button>
	</nav>
</div>

<div class="kiri">
	<a href="./dashboard"><div class="listWizard">Dashboard</div></a>
	<a href="./detail"><div class="listWizard">Detail Information</div></a>
	<a href="./listing"><div class="listWizard">My Listings</div></a>
	<a href="./galeri"><div class="listWizard">Gallery</div></a>
	<a href="./facility"><div class="listWizard" aktif="ya">Facility</div></a>
	<a href="./social"><div class="listWizard">Social Network</div></a>
	<a href="./logout"><div class="listWizard">Logout</div></a>
</div>

<div class="container">
	<form id="formCuisine">
		<div class="wrap">
			<h4><div id="icon"><i class="fa fa-cutlery"></i></div> Cuisine</h4>
			<table id="myListing">
				<thead>
					<tr>
						<th style="width: 10%">Status</th>
						<th>Cuisine</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach(getAllCuisine() as $row) {
						$key = $row['idcuisine'];
						if(in_array($key, $cui)) {
							$checked = "checked";
						}else {
							$checked = "";
						}
						echo "<tr>".
								"<td><input type='checkbox' onclick='save(this.value)' value='".$key."' id='cuisines".$key."' ".$checked."></td>".
								"<td><label for='cuisines".$key."'>".$row['nama']."</label></td>".
							 "</tr>";
					}
					?>
				</tbody>
			</table>
			<div id="saved">
				<i class="fa fa-check"></i> &nbsp;Saved
			</div>
		</div>
	</form>
</div>

<script src="../aset/js/embo.js"></script>
<script>
	klik("#cta", function() {
		mengarahkan("./add-listing")
	})
	function save(val) {
		let save = "idcui="+val+"&bag=cuisine"
		pos("../aksi/resto/edit.php", save, function() {
			muncul("#saved")
			setTimeout(function() {
				hilang("#saved")
			}, 1200)
		})
	}
</script>

</body>
</html>