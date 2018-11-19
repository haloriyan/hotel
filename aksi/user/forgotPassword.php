<?php
include '../ctrl/token.php';

if($_POST['email'] == "") {
	echo "<div class='note'>".
			$_COOKIE['kukiForgot'].
			"<span class='ke-kanan' id='xNote' onclick='hide()'><i class='fa fa-close'></i></span>".
		 "</div>";
}else {
	$email = $_POST['email'];
	$tipes = $_POST['tipe'];
	$token->createToken($email, $tipes);
	if($tipes == "hotel") {
		$nama = $hotel->get($email, "nama");
	}else {
		$nama = $user->info($email, "nama");
	}

	$to = $email;
	$subjek = "Password Recovery";
	$body ='
<h2 style="background: #cb0023;line-height: 36px;margin: 0px;margin-bottom: 25px;">
	<img src="http://explore.dailyhotels.id/test/aset/gbr/logo.png" style="width: 22%;margin-left: 5%;">
</h2>
<div class="container">
	<div class="wrap" style="margin: 4% 5% 4.5% 5%">
		<p style="font-family: sans-serif;font-size: 17px">
			Hello '.$nama.'<br /><br />
			Click this link below to set up your new password<br /><br />
			<a href="#" style="background: #cb0023;color: #fff;padding:15px 20px;border-radius: 5px;text-decoration: none;">Set new password</a>
			<br /><br />
			Ignore this if you dont request a password reset<br /><br />
			Best Regards,<br />
			Daily Hotels
		</p>
	</div>
</div>
';
	// Server Setting
	$mail->SMTPDebug = 2;
	$mail->isSMTP();
	$mail->Host		= "mail.dailyhotels.id";
	$mail->SMTPAuth = true;
	$mail->Username = "no-reply@dailyhotels.id";
	$mail->Password = "Inikatasandi2908";
	$mail->SMTPSecure = "ssl";
	$mail->Port 	= 456;
	$mail->isHTML(true);

	$mail->setFrom('no-reply@dailyhotels.id', 'Daily Hotels');
	$mail->addAddress($to, $name);

	$mail->Subject 	= $subjek;
	$mail->Body		= $body;
	$mail->send();
}