<?php
include '../ctrl/galeri.php';

$idhotel = $hotel->get($hotel->sesi(), "idhotel");
$load = $galeri->load($idhotel, "hotel");

if($load == "null") {
	die("ya");
}

foreach ($load as $row) {
	/*
	echo "<li class='galeri' onclick='seeImage()' value='".$row['gambar']."'>".
			"<img src='../aset/gbr/".$row['gambar']."'>".
		 "</li>";
		 */
		 ?>
		 <li class="galeri" onclick="seeImage(this.getAttribute('isi'))" isi="<?php echo $row['gambar']; ?>">
		 	<img src="../aset/gbr/<?php echo $row['gambar']; ?>">
		 </li>
	<?php
}