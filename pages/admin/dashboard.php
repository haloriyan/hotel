<?php

include 'aksi/ctrl/admin.php';

$sesi 	= $admin->sesi();
$name 	= $admin->get($sesi, "username");
$nama   = explode(" ", $name)[0];

if(isset($_GET['idhotel'])) {
  $admin->cawang($_GET['idhotel']);
  header("location: ./dashboard");
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
		<button id="cta" class="tbl"><i class="fa fa-plus-circle"></i> Add Listing</button>
	</nav>
</div>

<div class="kiri">
<a href="./dashboard"><div class='listWizard' aktif='ya'>Dashboard</div></a>
    <a href="./addadmin"><div class='listWizard'>Admin</div></a>
    <a href="./delete-events"><div class='listWizard'>Events</div></a>
    <a href="./payment"><div class='listWizard'>Payments</div></a>
    <a href="./redeem"><div class='listWizard'>Redeem</div></a>
    <a href="./refund"><div class='listWizard'>Refunds</div></a>
    <a href="../logout"><div class='listWizard'>Logout</div></a>
</div>

<div class="container">
	<div class="wrap">
		<h4><div id="icon"><i class="fa fa-home"></i></div> Dashboard</h4>
    <table>
      <thead>
        <tr>
          <th>Hotel name</th>
          <th>Address</th>
          <th>City</th>
          <th>Phone</th>
          <th>Website</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($admin->all() as $row) {
          echo "<tr>".
                "<td>".$row['nama']."</td>".
                "<td>".$row['address']."</td>".
                "<td>".$row['city']."</td>".
                "<td>".$row['phone']."</td>".
                "<td>".$row['website']."</td>".
                "<td>".
                  "<a href='./dashboard&idhotel=".$row['idhotel']."'><i class='fa fa-check'></a>".
                "</td>".
               "</tr>";
        }
        ?>
      </tbody>
    </table>
	</div>
</div>
</body>
</html>
