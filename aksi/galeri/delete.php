<?php
include '../ctrl/galeri.php';

$id = $_POST['idgambar'];

$gambar = $galeri->cek($id, "gambar");
$galeri->delete($id);

unlink("../../aset/gbr/".$gambar);