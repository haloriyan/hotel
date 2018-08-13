<?php
include '../ctrl/galeri.php';

$idhotel = $_COOKIE['idhotel'];
if ($_COOKIE['idresto'] !== null) {
	$idhotel = $_COOKIE['idresto'];
	$tipe = "resto";
}else {
	$tipe = "hotel";
}

$load = $galeri->load($idhotel, $tipe);

if($load == "null") {
	die("<h3>No any image available</h3>");
}

foreach ($load as $row) {
	?>
	<li class="galeri" onclick="seeImage(this.getAttribute('isi'))" isi="<?php echo $row['gambar']; ?>">
		<img src="../aset/gbr/<?php echo $row['gambar']; ?>">
	</li>
	<?php
}