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

// get all facility
function getAllFacility() {
	$ctrl = new controller();
	$get = $ctrl->tabel('facility')->pilih()->dimana(['tipe' => '2'])->eksekusi();
	while($row = $ctrl->ambil($get)) {
		$hasil[] = $row;
	}
	return $hasil;
}

$myFacility = $resto->info($sesi, "facility");
$fac = explode(",", $myFacility);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>Facility</title>
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
		<a href="../restoran/<?php echo $idresto; ?>" target='_blank'><li id="adaSub">Hello <?php echo $namaPertama; ?> ! &nbsp; <i class="fa fa-angle-down"></i>
			<nav class="sub" id="subUser">
				<a href="./detail"><li><div id="icon"><i class="fa fa-cog"></i></div> Settings</li></a>
				<a href="./galeri"><li><div id="icon"><i class="fa fa-image"></i></div> Gallery</li></a>
				<a href="./facility"><li><div id="icon"><i class="fa fa-cogs"></i></div> Facility</li></a>
				<a href="./social"><li><div id="icon"><i class="fa fa-user"></i></div> Social</li></a>
				<a href="./cuisine"><li><div id="icon"><i class="fa fa-cutlery"></i></div> Cuisine</li></a>
				<a href="./logout"><li><div id="icon"><i class="fa fa-sign-out"></i></div> Logout</li></a>
			</nav>
		</li></a>
		<button id="cta" class="tbl"><i class="fa fa-plus-circle"></i> Add Listing</button>
	</nav>
</div>

<div class="kiri">
	<a href="./dashboard"><div class="listWizard">Dashboard</div></a>
	<a href="./detail"><div class="listWizard" aktif="ya">Detail Information</div></a>
	<a href="./listing"><div class="listWizard">My Listings</div></a>
</div>

<div class="container">
	<div class="tabs">
		<div class="wrap">
			<a href="./detail"><div class="tab" resto='ya'><i class="fa fa-pencil"></i></div></a>
			<a href="./galeri"><div class="tab" resto='ya'><i class="fa fa-image"></i></div></a>
			<a href="#"><div class="tab" resto='ya' aktif='ya'><i class="fa fa-cogs"></i></div></a>
			<a href="./cuisine"><div class="tab" resto='ya'><i class="fa fa-cutlery"></i></div></a>
			<a href="./social"><div class="tab" resto='ya'><i class="fa fa-user"></i></div></a>
		</div>
	</div>
	<form id="formFac" style="margin-top: 120px">
		<div class="wrap">
			<h4><div id="icon"><i class="fa fa-home"></i></div> Facility</h4>
			<table id="myListing">
				<thead>
					<tr>
						<th style="width: 10%">Status</th>
						<th>Facility</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach (getAllFacility() as $row) {
						$key = $row['idfacility'];
						if(in_array($key, $fac)) {
							$checked = "checked";
						}else {
							$checked = "";
						}
						echo "<tr>".
								"<td><input type='checkbox' name='facilities' class='fac' value='".$key."' id='facilities".$key."' onclick='save(this.value)' ".$checked."></span></td>".
								"<td><label for='facilities".$key."'>".$row['nama']."</label></td>".
							 "</tr>";
					}
					?>
				</tbody>
				</table>
			<div id="saved">
				<i class="fa fa-check"></i> &nbsp;Saved
			</div>
			<br /><br />
		</div>
	</form>
</div>

<script src="../aset/js/embo.js"></script>
<script src="../aset/js/jquery-3.1.1.js"></script>
<script>
	klik("#cta", function() {
		mengarahkan("./add-listing")
	})
	pilih("#formFac").onsubmit = function() {
		let tes = $("input[name=facilities]").val()
		console.log(tes)
		return false
	}
	function save(val) {
		let save = "idfac="+val+"&bag=facility"
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