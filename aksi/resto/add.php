<?php
include '../ctrl/resto.php';

$id = null;
$idhotel = $hotel->get($hotel->sesi(), "idhotel");
$nama = $_POST['name'];
$added = time();

$resto->add($id, $idhotel, $nama, $added);