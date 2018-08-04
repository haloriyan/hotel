<?php
$facility = [
	"1" => "Wireless Internet",
	"2" => "Parking Street",
	"3" => "Smoking Allowed",
	"4" => "Accept Credit Cards",
	"5" => "Bike Parking",
	"6" => "Coupons"
];

$facSaya = ["1","3"];

for($i = 0; $i < count($facility); $i++) {
	echo $facility[$i]."<br />";
}