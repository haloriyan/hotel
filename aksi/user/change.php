<?php
include '../ctrl/user.php';

$sesi = $user->sesi();

$id = $user->info($sesi, "iduser");
$name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$city = $_POST['city'];

$bag = $_POST['bag'];

if($bag == "") {
	$value = $name.",".$phone.",".$address.",".$city;
	$kolom = "nama,telepon,alamat,city";

	$v = explode(",", $value);
	$k = explode(",", $kolom);
	for ($i=0; $i < count($k); $i++) { 
		$user->ganti($id, $k[$i], $v[$i]);
	}
}else if($bag == "pwd") {
	$pwd = $_POST['pwd'];
	$idUser = $_POST['id'];
	$token = $_POST['token'];
	$user->ganti($idUser, "password", $pwd);

	// delete token
	$ctrl->tabel('token')->hapus()->dimana(['token' => $token])->eksekusi();
}