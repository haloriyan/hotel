<?php
include '../ctrl/redeem.php';

$idhotel = $hotel->get($hotel->sesi(), "idhotel");
$saldo = $_POST['saldo'];

$redeem->request($idhotel, $saldo);