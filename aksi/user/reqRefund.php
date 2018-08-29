<?php
include '../ctrl/booking.php';

$id = $_POST['idbooking'];
$booking->reqRefund($id);