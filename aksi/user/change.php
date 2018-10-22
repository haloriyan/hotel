<?php
include '../ctrl/user.php';

$sesi = $user->sesi();

$id = $user->info($sesi, "iduser");
$name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$city = $_POST['city'];

$value = $name.",".$phone.",".$address.",".$city;
$kolom = "nama,telepon,alamat,city";

$v = explode(",", $value);
$k = explode(",", $kolom);
for ($i=0; $i < count($k); $i++) { 
	$user->ganti($id, $k[$i], $v[$i]);
}