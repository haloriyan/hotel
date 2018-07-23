<?php
include '../ctrl/user.php';

$sesi = $user->sesi();

$id = $user->info($sesi, "iduser");
$name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];

$value = $name.",".$phone.",".$address;
$kolom = "nama,telepon,alamat";

$v = explode(",", $value);
$k = explode(",", $kolom);
for ($i=0; $i < count($k); $i++) { 
	$user->ganti($id, $k[$i], $v[$i]);
}