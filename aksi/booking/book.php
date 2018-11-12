<?php
include '../ctrl/booking.php';

$id = null;
$idevent = $_POST['idevent'];
$iduser = $user->info($user->sesi(), "iduser");
$nama = $user->info($user->sesi(), "nama");
$qty = $_POST['qty'];
$tgl = $_POST['tgl'];

$booking->book($id, $idevent, $iduser, $nama, $qty, $tgl);