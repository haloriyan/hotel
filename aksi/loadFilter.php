<?php
// Category
$category = ["Food and Beverage","Room","Venue","Sports and Wellness","Shopping","Recreation","Parties","Others"];
$cities = ["Bali","Bandung","Batam","Bogor","Jakarta","Lombok","Makassar","Malang","Pekalongan","Semarang","Solo","Surabaya","Yogyakarta"];
$city = ["Bali","Bandung","Jakarta","Lombok","Makassar","Malang","Semarang","Surabaya","Yogyakarta"];
$allMonths = ["01" => "January", "02" => "February", "03" => "March", "04" => "April", "05" => "May", "06" => "June", "07" => "July", "08" => "August", "09" => "September", "10" => "October", "11" => "November", "12" => "December"];
$blnSkrg = date('m');
?>
<h3>Filter :</h3>
<input type="hidden" id="tglSkrg" value="<?php echo date('Y-m-d'); ?>">
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
	<br />
	<div class="bag bag-6">
		<select class="box" id="filterBln">
			<?php
			for($i = $blnSkrg; $i <= count($allMonths); $i++) {
				echo "<option>".$allMonths[$i]."</option>";
			}
			?>
		</select>
	</div>
	<div class="bag bag-4">
		<select class="box" id="filterThn">
			<?php
			for ($i=date('Y'); $i < (date('Y') + 5); $i++) { 
				echo "<option>".$i."</option>";
			}
			?>
		</select>
	</div>
</div>