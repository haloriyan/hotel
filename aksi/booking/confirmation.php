<?php
include '../ctrl/booking.php';

$id = $_POST['id'];
$bukti = $_POST['bukti'];

$booking->confirm($id, $bukti);