<?php
include '../ctrl/event.php';

$id = $_COOKIE['idevent'];
$logo = $event->info($id, "logo");
$cover = $event->info($id, "cover");

unlink("../../aset/gbr/".$logo);
unlink("../../aset/gbr/".$cover);

$event->delete($id);