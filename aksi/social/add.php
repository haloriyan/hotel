<?php
include '../ctrl/social.php';

$sesi = $hotel->sesi();

$id = rand(1,999999);
$idhotel = $hotel->get($sesi, "idhotel");
$type = $_POST['type'];
$url = $_POST['url'];

$social->add($id, $idhotel, $type, $url);