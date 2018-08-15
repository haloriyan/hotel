<?php

include 'aksi/ctrl/admin.php';

$sesi 	= $admin->sesi();
echo $sesi;
$title 	= $admin->get($sesi, "title");
$nama   = explode(" ", $title)[0];

if($_GET['idevent']) {
  $admin->deleteevent($_GET['idevent']);
  header("location: ./delete-events");
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>Dashboard</title>
	<link href='../aset/fw/build/fw.css' rel='stylesheet'>
	<link href='../aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<link href='../aset/css/style.index.css' rel='stylesheet'>
	<link href="../aset/css/style.explore-admin.css" rel="stylesheet">
  <style media="screen">
    .container {
      background-color: #fff;
      border: 1px solid ccc;
      color: #444;
    }
    .tbl-admin{
      background-color: #e74c3c;
      color: #fff;
      font-size: 15px;
      font-size: 18px;
    	padding: 9px 16px 10px 16px;
    	border: none;
      margin-top: 15px;
      margin-left: 658px;
    	border-radius: 5px;
    	transition: 0.45s;
    	cursor: pointer;
    }
    .atas { z-index: 2; }
    .bg { z-index: 3;}
    .popup { z-index: 5; }
    .popup .box {
      font-size: 16px;
      width: 100%;
    }
  </style>
</head>
<body>

<div class="atas merah-2">
	<img src= "../aset/gbr/logo.png" class="logoHome">
	<div class="pencarian">
		<i class="fa fa-search"></i>
		<input type="text" class="box" placeholder="Type your search...">
	</div>
	<nav class="menu">
    <a href="/hotel"><li>Home</li></a>
		<a href="../explore"><li>Explore</li></a>
		<a href="#"><li>City</li></a>
		<li>Hello <?php echo $nama; ?> !
			<div class="sub">
				<li></li>
			</div>
		</li>
    <button id="cta" class="tbl"><i class="fa fa-plus-circle"></i>
      Add Listing
    </button>
	</nav>
</div>

<div class="kiri">
<a href="./dashboard"><div class='listWizard'>Dashboard</div></a>
    <a href="./addadmin"><div class='listWizard'>Admin</div></a>
    <a href="./delete-events"><div class='listWizard' aktif='ya'>Events</div></a>
    <a href="./payment"><div class='listWizard'>Payments</div></a>
    <a href="./redeem"><div class='listWizard'>Redeem</div></a>
    <a href="./refund"><div class='listWizard'>Refunds</div></a>
    <a href="../logout"><div class='listWizard'>Logout</div></a>
</div>

<div class="container">
	<div class="wrap">
		<h4><div id="icon">&nbsp;<i class="fa fa-warning"></i>&nbsp;</div> Delete Event</h4>
    <table>
      <thead>
        <tr>
          <th> Events Name</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($admin->event() as $row) {
          echo "<tr>".
                "<td><a href='../event/".$row['idevent']."' target='_blank'>".$row['title']."</a>".
                  "<a href='delete-events&idevent=".$row['idevent']."' class='ke-kanan'><i class='fa fa-close'></i></a>".
                "</td>".
               "</tr>";
        }
        ?>
      </tbody>
    </table>

<script src="../aset/js/embo.js"></script>
</body>
</html>
