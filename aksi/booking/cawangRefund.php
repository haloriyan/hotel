<?php
include '../ctrl/booking.php';

$idbooking = $_POST['idbooking'];
$booking->cawangRefund($idbooking);