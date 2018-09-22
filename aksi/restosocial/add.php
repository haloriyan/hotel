<?php
include '../ctrl/social.php';

$sesi = $resto->sesi();

$id = rand(1,999999);
$idresto = $resto->info($sesi, "idresto");
$type = $_POST['type'];
$url = $_POST['url'];

$social->add($id, $idresto, $type, $url, "restoran");