<?php
include '../ctrl/event.php';

$id = $_COOKIE['idevent'];
// $logo = $event->info($id, "logos");
// $cover = $event->info($id, "covers");

// unlink("../../aset/gbr/".$logo);
// unlink("../../aset/gbr/".$cover);

$event->delete($id);