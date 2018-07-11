<?php
include '../ctrl/galeri.php';

$id = rand(1, 999999);
$idhotel = $hotel->get($hotel->sesi(), "idhotel");
$tipe = $_POST['tipe'];
$gambar = $_POST['gambar'];

$galeri->add($id, $idhotel, $tipe, $gambar);