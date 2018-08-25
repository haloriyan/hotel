<?php
include '../ctrl/galeri.php';

$id = $_COOKIE['idalbum'];

$galeri->deleteAlbum($id);