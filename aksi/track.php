<?php
// include 'ctrl/track.php';
include '../database/config.php';

session_start();
$sesi = $_SESSION['upublic'];
if(empty($sesi)) {
	$iduser = $_SERVER['REMOTE_ADDR'];
}else {
	$user = mysqli_fetch_array(mysqli_query($konek, "SELECT * FROM user WHERE email = '$sesi'"));
	$iduser  = $user['iduser'];
}

$idevent = $_POST['idevent'];
$tipe	 = $_POST['tipe'];
$now	 = time();

// echo $track->hit($idevent, $iduser, $tipe);
global $dbHost,$dbUsername,$dbPassword,$dbName;
$konek = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
$cek = mysqli_query($konek, "SELECT * FROM track WHERE idevent = '$idevent' AND iduser = '$iduser' AND tipe = '$tipe'");
		if(mysqli_num_rows($cek) != 0) {
			// pernah
			$r = mysqli_fetch_array($cek);
			$ubah = mysqli_query($konek, "UPDATE track SET hint = hint + 1, last_tracked = '$now' WHERE idtrack = '".$r['idtrack']."'");
		}else {
			// ga pernah
			$idtrack = rand(1, 999999999);
			$ins = mysqli_query($konek, "INSERT INTO track VALUES('$idtrack','$idevent','$iduser','$tipe','1','$now','$now')");
		}