<?php
include '../ctrl/komentar.php';

$id = rand(1, 999999);
$idevent = $_POST['idevent'];
$iduser = $_POST['iduser'];
$komentar = $_POST['komentar'];

$komen->store($id, $idevent, $iduser, $komentar);