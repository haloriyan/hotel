<?php

$cookieNotif = $_COOKIE['kukiLogin'];

?>
<div class="popupWrapper" id="notif">
	<div class="popup">
		<div class="wrap">
			<h3><i class="fa fa-info"></i> &nbsp; Alert!
				<div class="ke-kanan" id="xNotif"><i class="fa fa-close"></i></div>
			</h3>
			<p>
				<?php echo $cookieNotif; ?>
			</p>
		</div>
	</div>
</div>
<script>
	let redirect = pilih("#redirect").value
	alert(redirect)
</script>