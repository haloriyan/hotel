<?php
include '../ctrl/redeem.php';

$id = $_POST['idredeem'];
$redeem->cancel($id);