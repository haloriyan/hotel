<?php
include 'aksi/ctrl/booking.php';

function toIdr($angka) {
	return 'Rp. '.strrev(implode('.', str_split(strrev(strval($angka)), 3)));
}

$idevent = $booking->info($idinvoice, "idevent");
$qty = $booking->info($idinvoice, "qty");
$price = $event->info($idevent, "price");
$title = $event->info($idevent, "title");
$total = $price * $qty;
$bukti = $booking->info($idinvoice, "bukti");

if ($idevent == "") {
    die("error");
}

?>
<html>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale = 1'>
    <title>Invoice</title>
    <link href='../aset/fw/build/fw.css' rel='stylesheet'>
    <link href='../aset/fw/build/font-awesome.min.css' rel='stylesheet'>
    <link href='../aset/css/style.invoice.css' rel='stylesheet'>
</head>
<body>
    
<div class="atas merah-2">
	<img src= "../aset/gbr/logo.png" class="logoHome">
</div>

<div class='container'>
    <div class='wrap'>
        <h2 class='rata-tengah'>Invoice for <?php echo $title; ?></h2>
        <hr size='1' color='#ddd'>
        <p>
            <b>BRI</b><br />
            No. Rekening : 115601021344500<br />
            a.n : Dailyhotels Indonesia
        </p>
        <p>
            <b>BRI</b><br />
            No. Rekening : 115601021344500<br />
            a.n : Dailyhotels Indonesia
        </p>
        <p>
            <b>BRI</b><br />
            No. Rekening : 115601021344500<br />
            a.n : Dailyhotels Indonesia
        </p>
        <p>
            After sending payment, you can confirm your payment by clicking these button
            <br /><br />
            <?php
            if($bukti == "") {
            ?>
                <button class='tbl merah-2' id='confirmBtn'>Confirm</button>
            <?php
            }else {
                echo "This is invoice was paid";
            }
            ?>
        </p>
    </div>
</div>

<div class='ringkasan'>
    <div class='wrap'>
        <h2>Summary</h2>
        <hr size='1' color='#ddd'>
        <table style='text-align: left;'>
            <thead>
                <tr style='background: none;'>
                    <th style='width: 30%'>Qty</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <tr style='background: none;'>
                    <td><?php echo $qty; ?></td>
                    <td><?php echo toIdr($price); ?></td>
                </tr>
            </tbody>
        </table>
        <h3>Total : <?php echo toIdr($total); ?></h3>
    </div>
</div>

<div class='bg'></div>
<div class='popupWrapper' id='formPay'>
    <div class='popup'>
        <div class='wrap'>
            <h3>Payment Confirmation
                <div id='xPay' class='ke-kanan'><i class='fa fa-close'></i></div>
            </h3>
            <form id='pay'>
                <div class='isi'>Upload evidence</div>
                <input type="hidden" id='idbooking' value='<?php echo $idinvoice; ?>'>
                <input type="hidden" id='buktis'>
                <input type="file" class='box' id='bukti'>
                <div class='bag-tombol'>
                    <button class='merah-2'>Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class='popupWrapper' id='afterPay'>
    <div class='popup'>
        <div class='wrap'>
            <h3>Payment Confirmed
                <div id='xConf' class='ke-kanan'><i class='fa fa-close'></i></div>
            </h3>
            <p>
                Your payment has been sent
            </p>
        </div>
    </div>
</div>

<div class='popupWrapper' id='notif'>
    <div class='popup'>
        <div class='wrap'>
            <h3><i class='fa fa-info'></i> Alert!
                <div id='xNotif' class='ke-kanan'><i class='fa fa-close'></i></div>
            </h3>
            <p id='isiNotif'></p>
        </div>
    </div>
</div>

<script src='../aset/js/embo.js'></script>
<script src='../aset/js/jquery-3.1.1.js'></script>
<script src='../aset/js/insert.js'></script>
<script>
    // munculPopup("#formPay", pengaya("#formPay", "top: 100px"))

    tekan("Escape", () => {
        hilangPopup("#formPay")
        hilangPopup("#afterPay")
        hilangPopup("#notif")
    })

    klik("#confirmBtn", () => {
        munculPopup("#formPay", pengaya("#formPay", "top: 135px"))
    })

    submit('#pay', () => {
        let bukti = pilih("#buktis").value
        let id = pilih("#idbooking").value
        let pays = "id="+id+"&bukti="+bukti
        pos("../aksi/booking/confirmation.php", pays, () => {
            hilangPopup("#formPay")
        })
        hilangPopup("#formPay")
        munculPopup("#afterPay", pengaya("#afterPay", "top: 150px"))
        return false
    })
    
    klik("#xConf", () => {
        hilangPopup("#afterPay")
    })
    klik("#xPay", () => {
        hilangPopup("#formPay")
    })
    klik("#xNotif", () => {
        hilangPopup("#notif")
    })

    $("#bukti").on("change", () => {
        let allowed = ["jpg","jpeg","png","bmp"]
        let bukti = $("#bukti").val()
        let p = bukti.split("fakepath")
        let nama = p[1].substr(1, 2999)

        $("#buktis").val(nama)
        let ext = getExt(nama)

        if(!inArray(ext, allowed)) {
            hilangPopup("#formPay")
            $("#bukti").val('')
            munculPopup("#notif", pengaya("#notif", "top: 225px"))
			tulis("#isiNotif", "Image format not allowed")
			return false
        }

        var file = $(this)[0].files[0];
		var upload = new Upload(file);
		upload.doUpload();
    })

    function getExt(val) {
		let re =/(?:\.([^.]+))?$/
		let ext = re.exec(val)[1]
		return ext
	}

    function sukses() {
        console.log("uploaded")
    }
</script>

</body>
</html>