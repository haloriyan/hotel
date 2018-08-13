<?php
include '../ctrl/resto.php';

$id = rand(1, 999999);
$idhotel = $hotel->get($hotel->sesi(), "idhotel");
$nama = $_POST['name'];
$added = time();

$resto->add($id, $idhotel, $nama, $added);