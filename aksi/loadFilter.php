<?php
// Category
$category = ["Food and Beverage","Room","Venue","Sports and Wellness","Shopping","Recreation","Parties","Others"];
$cities = ["Bali","Bandung","Batam","Bogor","Jakarta","Lombok","Makassar","Malang","Pekalongan","Semarang","Solo","Surabaya","Yogyakarta"];
$city = ["Bali","Bandung","Jakarta","Lombok","Makassar","Malang","Semarang","Surabaya","Yogyakarta"];
?>
<h3>Filter :</h3>
<input type="hidden" id="tglSkrg" value="<?php echo date('Y-m-d'); ?>">
<select class="box" onchange="order(this.value)">
	<option value="latest">Latest</option>
	<option value="lowest">Lowest Price</option>
</select>
<div class="isi">Category :</div>
<select class="box" onchange="category(this.value)">
	<option value="">All Categories</option>
	<?php
	foreach ($category as $key => $value) {
		if($_COOKIE['category'] == $value) {
			$selected = "selected";
		}else {
			$selected = "";
		}
		echo "<option ".$selected.">".$value."</option>";
	}
	?>
</select>
<div class="isi">City :</div>
<select class='box' id='region' onchange='city(this.value)'>
	<option value="">All Cities</option>
	<?php
	foreach ($cities as $key => $value) {
		if($_COOKIE['region'] == $value) {
			$selected = "selected";
		}else {
			$selected = "";
		}
		echo "<option ".$selected.">".$value."</option>";
	}
	?>
</select>
<!--
<div class="bag bag-5">
	From :
	<input type="text" class="box" id="fromDate" onchange="tglMulai(this.value);tglMulai2(this.value)" placeholder='YYYY-MM-DD'>
</div>
-->
<div>
	Until :
	<input type="text" class="box" id="toDate" onchange="tglAkhir(this.value)" placeholder='YYYY-MM-DD'>
</div>