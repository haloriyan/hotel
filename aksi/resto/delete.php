<?php
include '../ctrl/resto.php';

$id = $_POST['id'];
$resto->delete($id);