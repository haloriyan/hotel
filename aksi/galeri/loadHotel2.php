<?php
include '../ctrl/galeri.php';

$idhotel = $_COOKIE['idhotel'];
if (isset($_COOKIE['idresto'])) {
	$tipe = "resto";
}else {
	$tipe = "hotel";
}
$load = $galeri->load($idhotel, $tipe);

if($load == "null") {
	die("ya");
}

foreach ($load as $row) {
	?>
	<li class="galeri" onclick="seeImage(this.getAttribute('isi'))" isi="<?php echo $row['gambar']; ?>">
		<img src="../aset/gbr/<?php echo $row['gambar']; ?>">
	</li>
	<?php
}