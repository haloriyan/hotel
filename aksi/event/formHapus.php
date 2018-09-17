<?php
include '../ctrl/event.php';

$id = $_COOKIE['idevent'];
$nama = $event->info($id, "title");

echo "Sure want to delete <b>".$nama."</b> ?";