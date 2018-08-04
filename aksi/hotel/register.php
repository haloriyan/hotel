<?php
include '../ctrl/hotel.php';

$id = rand(1, 999999);
$nama = $_POST['name'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$time = time();

$emailEncoded = base64_encode($email);

$hotel->register($id, $nama, $email, $pwd, $time);

$body = '<!DOCTYPE html>
    <html lang="en" dir="ltr">
      <table width="100%" align=center>
          <tbody>
              <td><!-- BEGIN MAIN CONTENT -->
                <table style="margin: auto;
                width: 700px;
                align: center;">
          <tbody>
            <td class="content" width="100%">
              <table style="border: #d2d2d2 1px solid;
              margin: auto;
              border-radius: 5px;
              -webkit-border-radius: 5px;
              -moz-border-radius: 5px;" width="100%" align=left>
          <tbody>
        <tr>
          <td style="border-top-left-radius: 5px;
          border-top-right-radius: 5px;
          -webkit-border-top-left-radius: 5px;
          -webkit-border-top-right-radius: 5px;
          -moz-border-radius-topleft: 5px;
          -moz-border-radius-topright: 5px;
          height: 21px;
          width: 100%;">
          </td>
        </tr>
    <tr>
        <td style="padding: 0 19px 0 21px;" align=right>
            <table width="100%">
          <tbody>
    <tr>
          <td align=right>
            <div class="logo" style="background-color: #cb0023; height: 90px;">
              <img src="http://berkas.riyansatria.tk/uploadan/logo.png" style="margin-right: 5%;">
            </div>
            </td>
          </tr>
        </tbody>
      </table>
    </td>
    </tr>
    <tr>
          <td height=12 width="100%">
        </td>
    </tr>
    <tr>
        <td style="padding: 0 45px 0 45px;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
        -webkit-border-bottom-right-radius: 5px;
        -webkit-border-bottom-left-radius: 5px;
        -moz-border-radius-bottomright: 5px;
        -moz-border-radius-bottomleft: 5px"><!-- Nested padding for body -->
            <table>
        <tbody>
    <tr>
        <td bgColor=#ffffff>
            <table cellSpacing=0 cellPadding=0 width="100%" align=center border=0>
        <tbody>
    <tr>
        <td style="font-size: 26px;
        font-family: Helvetica Neue, Helvetica, Arial, Verdana, sans-serif;
        font-weight: bold;
        color: #292929;
        padding-bottom: 20px;
        line-height: 1.2em;" width=600 align=center>Verifikasi email</td>
          </tr>
        </tbody>
      </table>
    </td>
    </tr>
    <tr>
          <td style="border-bottom-left-radius: 5px;
          border-bottom-right-radius: 5px;
          -webkit-border-bottom-right-radius: 5px;
          -webkit-border-bottom-left-radius: 5px;
          -moz-border-radius-bottomright: 5px;
          -moz-border-radius-bottomleft: 5px;
          background-color: #fff;">
            <table width="100%" align=center>
          <tbody>
    <tr>
          <td width="100%">
            <table width="100%">
          <tbody>
    <tr>
          <td style="font-size: 18px;
          font-family: Helvetica Neue, Helvetica, Arial, Verdana, sans-serif;
          padding-top: 4px;
          line-height: 1.6em;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </td>
    </tr>
          <td style="font-size: 18px;
          font-family: Helvetica Neue, Helvetica, Arial, Verdana, sans-serif;
          padding-top: 4px;
          line-height: 1.6em;">
      <a style="border: #cb0023 12px solid;
      border-radius: 5px;
      height: 28px;
      background: #cb0023;
      color: #fff;
      padding-left: 20px;
      padding-right: 20px;
      line-height: 28px;
      display: inline-block;
      text-decoration: none;" href="http://demo.riyansatria.tk/validate-hotel&e='.$emailEncoded.'">Verifikasi</A>
      </td>
    </tr>
    </html>
';

$to = $email;
$subjek = "Email Verification";
$headers = "From: " . strip_tags($_POST['req-email']) . "\r\n";
$headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
$headers .= "CC: susan@example.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = $body;

mail($to, $subjek, $message, $header);