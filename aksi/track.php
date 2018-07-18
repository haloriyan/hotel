<?php
include 'ctrl/track.php';

session_start();
$sesi = $_SESSION['upublic'];
if(empty($sesi)) {
	$iduser = $_SERVER['REMOTE_ADDR'];
}else {
	$iduser  = $user->info($sesi, "iduser");
}


$idevent = $_GET['idevent'];
$tipe	 = $_GET['tipe'];
$time	 = time();

echo $track->hit($idevent, $iduser, $tipe);