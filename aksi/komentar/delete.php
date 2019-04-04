<?php
include '../ctrl/komentar.php';

$id = $_POST['id'];
$komen->delete($id);