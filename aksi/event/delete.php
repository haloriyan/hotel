<?php
include '../ctrl/event.php';

$id = $_POST['idevent'];
if($id == "") {
	$id = $_COOKIE['idevent'];
}
$logo = $event->info($id, "logos");
$cover = $event->info($id, "covers");

unlink("../../aset/gbr/".$logo);
unlink("../../aset/gbr/".$cover);

$event->delete($id);