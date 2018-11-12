<?php
include '../ctrl/hotel.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../aset/phpmailer/Exception.php';
require '../../aset/phpmailer/PHPMailer.php';
require '../../aset/phpmailer/SMTP.php';

$mail = new PHPMailer(true);

$id = null;
$nama = $_POST['name'];
if($nama == "") {
  echo $_COOKIE['msgRegister'];
}else {
$id = rand(1, 999999);
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$time = time();

$emailEncoded = base64_encode($email);

$hotel->register($id, $nama, $email, $pwd, $time);

$body = '
<h2 style="background: #cb0023;line-height: 36px;margin: 0px;margin-bottom: 25px;">
<img src="http://explore.dailyhotels.id/test/aset/gbr/logo.png" style="width: 22%;margin-left: 5%;">
</h2>
<div class="container">
    <div class="wrap" style="margin: 4% 5% 4.5% 5%;">
        <p style="font-family: sans-serif;font-size: 17px;">
            Welcome to Daily Hotels, '.$nama.'!<br /><br />
            Before you can use your account, you must verify your email by clicking this button below<br /><br />
            <a href="http://explore.dailyhotels.id/test/validate-hotel&e='.$emailEncoded.'" 
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
  $subjek = "Email Verification";
  $message = $body;

  $mail->setFrom('no-reply@dailyhotels.id', 'Daily Hotels');
  $mail->addAddress($to, $nama);

  $mail->Subject = $subjek;
  $mail->Body = $message;
  $mail->send();
  
}