<?php
include 'aksi/ctrl/booking.php';
$namaPertama = 'adm00n';
setcookie('statusRefund', '9', time() + 3666, "/");
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
		#myListing li {
			display: inline-block;
			color: #cb0023;
			cursor: pointer;
		}
		td a { font-size: 15px; }
		th {
			text-align: left;
			padding: 5px;
			background-color: #fff;
			border-bottom: 1px solid #ccc;
		}
		td {
			padding: 10px;
			border-bottom: 1px solid #ddd;
			background-color: #fff;
		}
		td h4 { margin-top: 5px; }
    </style>
</head>
<body>

<div class='atas merah-2'>
    <img src="../aset/gbr/logo.png" class='logoHome'>
    <nav class='menu'>
        <a href="#"><li>Home</li></a>
        <a href="#"><li>Explore</li></a>
        <a href="#"><li>City</li></a>
        <li>Hello <?php echo $namaPertama; ?>!</li>
    </nav>
</div>

<div class='kiri'>
    <a href="./dashboard"><div class='listWizard'>Dashboard</div></a>
    <a href="./addadmin"><div class='listWizard'>Add Admin</div></a>
    <a href="./delete-events"><div class='listWizard'>Events</div></a>
    <a href="./payment"><div class='listWizard'>Payments</div></a>
    <a href="./redeem"><div class='listWizard' aktif='ya'>Redeem</div></a>
    <a href="./redeem"><div class='listWizard'>Refund</div></a>
    <a href="../logout"><div class='listWizard'>Logout</div></a>
</div>

<div class='container'>
    <div class='wrap'>
        <h4><div id="icon"><i class="fa fa-money"></i></div> Redeem Request
            <div class='ke-kanan'>
                Status
                <select id="status" class='box' style='font-size: 16px;height: 45px;' onchange='status(this.value)'>
                    <option value="9">Requested</option>
                    <option value="8">Paid</option>
                </select>
            </div>
        </h4>
        <div id='load'></div>
    </div>
</div>

<script src='../aset/js/embo.js'></script>
<script>
    function load() {
        ambil("../aksi/booking/refundRequest.php", (res) => {
            tulis("#load", res)
        })
    }
    function status(val) {
        let set = "namakuki=statusRefund&value="+val+"&durasi=3666"
        pos("../aksi/setCookie.php", set, () => {
            load()
        })
    }
    function cawang(val) {
        let set = "idbooking="+val
        pos("../aksi/booking/cawangRefund.php", set, () => {
            load()
        })
    }
    function hapus(val) {
        let set = "idbooking="+val
        pos("../aksi/booking/delete.php", set, () => {
            load()
        })
    }

    load()
</script>
</body>
</html>