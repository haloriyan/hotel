<?php
include '../ctrl/social.php';

$id = $_POST['idsocial'];
$social->delete($id);