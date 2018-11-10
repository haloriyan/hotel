<?php
include '../ctrl/galeri.php';

$id = $_COOKIE['idalbum'];

$allGambar = $galeri->loadFromAlbum($id);
foreach ($allGambar as $row) {
	$file = $row['gambar'];
	unlink('../../aset/gbr/'.$file);
}

$galeri->deleteAlbum($id);