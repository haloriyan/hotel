<?php
$myResto = $resto->totMyResto($idhotel);
$myEvent = $event->totMyEvent($idhotel);
?>
<div class="profile">
	<img src="../aset/gbr/<?php echo $cover; ?>" class='cover'>
	<div class="ket">
		<div class="wrap">
			<img src="../aset/gbr/<?php echo $icon; ?>" class="icon">
			<h2><?php echo $name; ?></h2>
			<p id="alamat"><?php echo $addressMin; ?></p>
			<div class="profileTabs">
				<div class="profileTab">
					<span class="angka"><?php echo $myEvent; ?></span><br />
					<span class="kets">listings</span>
				</div>
				<div class="profileTab">
					<span class="angka"><?php echo $myResto; ?></span><br />
					<span class="kets">resto</span>
				</div>
				<div class="profileTab">
					<span class="angka">25</span><br />
					<span class="kets">listings</span>
				</div>
			</div>
		</div>
	</div>
</div>