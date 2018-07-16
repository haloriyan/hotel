<?php
include '../ctrl/resto.php';

$id = rand(1, 999999);
$idhotel = $hotel->get($hotel->sesi(), "idhotel");
$nama = $_POST['name'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$added = time();

$resto->add($id, $idhotel, $nama, $email, $pwd, $added);