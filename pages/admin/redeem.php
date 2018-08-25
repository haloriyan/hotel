<?php
include 'aksi/ctrl/booking.php';
$namaPertama = 'adm00n';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale = 1'>
    <title>Redeem Request</title>
    <link href='../aset/fw/build/fw.css' rel='stylesheet'>
    <link href='../aset/fw/build/font-awesome.min.css' rel='stylesheet'>
    <link href='../aset/css/style.index.css' rel='stylesheet'>
    <link href="../aset/css/style.explore-admin.css" rel="stylesheet">
    <style>
        #myListing img {
			width: 50px;
			height: 50px;
		}
        .myList {
            width: 31.46%;
            display: inline-block;
            box-shadow: 1px 1px 5px 1px #ddd;
            margin: 0px 10px;
            margin-bottom: 25px;
        }
        .myList:nth-child(1),.myList:nth-child(3n + 1) { margin-left: 0px; }
        .myList:nth-child(3n) { margin-right: 0px; }
        .myList img {
            width: 100%;
            height: 180px;
        }
        .myList .wrap { margin: 6% 10% 8% 10%; }
        .myList h3 { line-height: 35px; }
        .myList #icon {
            width: 20px;
            line-height: 30px;
            background: none;
            color: #444;
        }
    </style>
</head>
<body>

<div class='atas merah-2'>
    <img src="../aset/gbr/logo.png" class='logoHome'>
    <nav class='menu'>
        <a href="/hotel"><li>Home</li></a>
		<a href="../explore"><li>Explore</li></a>
        <a href="#"><li>City</li></a>
        <li>Hello <?php echo $namaPertama; ?>!</li>
    </nav>
</div>

<div class='kiri'>
    <a href="./dashboard"><div class='listWizard'>Dashboard</div></a>
    <a href="./addadmin"><div class='listWizard'>Admin</div></a>
    <a href="./delete-events"><div class='listWizard'>Events</div></a>
    <a href="./payment"><div class='listWizard'>Payments</div></a>
    <a href="./redeem"><div class='listWizard' aktif='ya'>Redeem</div></a>
    <a href="../logout"><div class='listWizard'>Logout</div></a>
</div>

<div class='container'>
    <div class='wrap'>
        <h4><div id="icon"><i class="fa fa-money"></i></div> Redeem Request</h4>
        <div id='load'></div>
    </div>
</div>

<script src='../aset/js/embo.js'></script>
<script>
    function load() {
        ambil("../aksi/redeem/redeemRequest.php", (res) => {
            tulis("#load", res)
        })
    }
    function cawang(val) {
        let set = "idredeem="+val
        pos("../aksi/redeem/cawang.php", set, () => {
            load()
        })
    }

    load()
</script>
</body>
</html>