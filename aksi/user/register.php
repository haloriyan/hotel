<?php
include '../ctrl/user.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../aset/phpmailer/Exception.php';
require '../../aset/phpmailer/PHPMailer.php';
require '../../aset/phpmailer/SMTP.php';

$mail = new PHPMailer(true);

$name = $_POST['name'];

if($name == "") {
	echo $_COOKIE['msgReg'];
}else {
	$id = null;
	$email = $_POST['email'];
	$pwd = $_POST['pwd'];
	$added = time();

	$user->register($id, $email, $pwd, $name, $added);

	$emailEncoded = base64_encode($email);

	$body = '
<h2 style="background: #cb0023;line-height: 36px;margin: 0px;margin-bottom: 25px;">
<img src="http://explore.dailyhotels.id/test/aset/gbr/logo.png" style="width: 22%;margin-left: 5%;">
</h2>
<div class="container">
    <div class="wrap" style="margin: 4% 5% 4.5% 5%;">
        <p style="font-family: sans-serif;font-size: 17px;">
            Welcome to Daily Hotels, '.$name.'!<br /><br />
            Before you can use your account, you must verify your email by clicking this button below<br /><br />
            <a href="http://explore.dailyhotels.id/test/validate&e='.$emailEncoded.'" 
            style="background: #cb0023;color: #fff;padding: 15px 20px;border-radius: 5px;text-decoration: none;
            ">
            Verify</a>
            <br /><br />
            Best Regards,<br />
            Daily Hotels
        </p>
    </div>
</div>
';

// Server setting
  $mail->SMTPDebug = 2;
  $mail->isSMTP();
  $mail->Host     = 'mail.dailyhotels.id';
  $mail->SMTPAuth = true;
  $mail->Username = 'no-reply@dailyhotels.id';
  $mail->Password = 'Inikatasandi2908';
  $mail->SMTPSecure = 'ssl';
  $mail->Port = 465;
  $mail->isHTML(true);

  $to = $email;
  $subjek = "Welcome to Dailyhotels";
  $message = $body;

  $mail->setFrom('no-reply@dailyhotels.id', 'Daily Hotels');
  $mail->addAddress($to, $name);

  $mail->Subject = $subjek;
  $mail->Body = $message;
  $mail->send();
}