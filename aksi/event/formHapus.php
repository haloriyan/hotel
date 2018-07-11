<?php
include '../ctrl/event.php';

$id = $_COOKIE['idevent'];
$nama = $event->info($id, "title");

echo "Yakin ingin menghapus <b>".$nama."</b> ?";