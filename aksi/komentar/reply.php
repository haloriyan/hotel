<?php
include '../ctrl/komentar.php';

$id = $_POST['id'];
$reply = $_POST['reply'];

$komen->reply($id, $reply);