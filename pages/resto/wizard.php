<?php
include 'aksi/ctrl/resto.php';

$nama = $_GET['namaResto'];
$cities = ["Bali","Bandung","Batam","Bogor","Jakarta","Lombok","Makassar","Malang","Pekalongan","Semarang","Solo","Surabaya","Yogyakarta"];

$resto->login($nama);

session_start();
$sesi = $_SESSION['uresto'];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>Creating Restaurant</title>
	<link href='../aset/fw/build/fw.css' rel='stylesheet'>
	<link href='../aset/fw/build/font-awesome.min.css' rel='stylesheet'>
	<style>
		body { background: #ecf0f1;color: #555; }
		.container {
			position: absolute;
			top: 150px;left: 15%;right: 15%;
			background-color: #fff;
			color: #555;
			border: 1px solid #ddd;
			border-radius: 6px;
		}
		.container .wrap { margin: 5%; }
		.container p {
			font-size: 20px;
			font-family: OLight;
			line-height: 40px;
		}
		select.box { font-size: 18px; }
		form button { margin-top: 15px; }
		.container form { display: none; }
		#formCity { display: block; }

		.myStep {
			z-index: 2;
			text-align: center;
			position: fixed;
			top: 30px;left: 15%;right: 15%;
			padding: 15px 100px;
		}
		.step {
			border: 2px solid #777;
			color: #777;
			font-size: 16px;
			font-family: Arial;
			width: 60px;
			line-height: 60px;
			text-align: center;
			border-radius: 90px;
			display: inline-block;
			cursor: pointer;
		}
		.step[aktif=ya] { border: 2px solid #cb0023;color: #cb0023; }
		.after {
			display: inline-block;
			width: 75px;
			height: 2px;
			background-color: #888;
			position: relative;
			top: -5px;
		}
		.after[aktif=ya] { background-color: #cb0023; }
	</style>
</head>
<body>

<div class="myStep">
	<div class="step" id="stepOne" aktif='ya'><i class="fa fa-map-marker"></i></div>
	<div class="after" id="afterOne"></div>
	<div class="step" id="stepTwo"><i class="fa fa-phone"></i></div>
	<div class="after" id="afterTwo"></div>
	<div class="step" id="stepThree"><i class="fa fa-globe"></i></div>
	<div class="after" id="afterThree"></div>
	<div class="step" id="stepFour"><i class="fa fa-pencil"></i></div>
</div>

<div class="container">
	<div class="wrap">
		<form id="formCity">
			<h1>Hello <b><?php echo $nama; ?></b>!</h1>
			<p>
				After create a restaurant, you must fill in some detail information which needed. First, which city is your restaurant in?
			</p>
			<select class="box" id="city" required>
				<option value="">Select city...</option>
				<?php
				foreach ($cities as $key => $value) {
					echo "<option>".$value."</option>";
				}
				?>
			</select>
			<button id="toTwo" class="tbl merah-2">Next</button>
		</form>
		<form id="formAddr">
			<h1><span id="showCity"></span> is a great city!</h1>
			<p>
				But, please fill the detail address of <?php echo $nama; ?> restaurant
			</p>
			<textarea class="box" id="address" required></textarea>
			<br />
			<button class="tbl merah-2" id="toThree">Next</button>
		</form>
		<form id="formPhone">
			<h1>Nice place!</h1>
			<p>
				To be easy to find, people can ask the location of the restaurant by phone. Please provide phone number
			</p>
			<input type="number" class="box" id="phone" placeholder="ex : 628123456789" required>
			<button class="tbl merah-2" id="toFour">Next</button>
		</form>
		<form id="formWeb">
			<p>
				If you have, please fill URL address of your restaurant website
			</p>
			<input type="text" class="box" id="website" placeholder="ex : https://dailyhotels.id">
			<button class="tbl merah-2">Next</button>
		</form>
		<form id="formDesc">
			<p>Now, please fill short description about <?php echo $nama; ?> restaurant</p>
			<textarea id="description" class="box"></textarea>
			<button class="tbl merah-2">Finish</button>
		</form>
	</div>
</div>

<script src="../aset/js/emboBaru.js"></script>
<script>
	function validUrl(str) {
	    let regExp = /^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/;

	    if(!regExp.test(str)) {
			return 'gavalid'
	    }else {
	    	return '1'
	    }
	}

	submit('#formCity', () => {
		let city = $("#city").isi()
		$("#formCity").hilang()
		$("#formAddr").muncul()
		$("#showCity").tulis(city)
		return false
	})
	submit('#formAddr', () => {
		$("#formAddr").hilang()
		$("#formPhone").muncul()
		$('#afterOne').atribut('aktif', 'ya')
		$('#stepTwo').atribut('aktif', 'ya')
		return false
	})
	submit('#formPhone', () => {
		$("#formPhone").hilang()
		$("#formWeb").muncul()
		$('#afterTwo').atribut('aktif', 'ya')
		$('#stepThree').atribut('aktif', 'ya')
		return false
	})
	submit('#formWeb', () => {
		let urlAddr = $("#website").isi()
		if(validUrl(urlAddr) == "gavalid") {
			alert("URL isn't valid")
			return false
		}else {
			$("#formWeb").hilang()
			$("#formDesc").muncul()
			$('#afterThree').atribut('aktif', 'ya')
			$('#stepFour').atribut('aktif', 'ya')
		}
		return false
	})
	submit('#formDesc', () => {
		let city 	= $("#city").isi()
		let address = $("#address").isi()
		let phone 	= $("#phone").isi()
		let website = $("#website").isi()
		let desc 	= $("#description").isi()

		let y = "city="+city+"&address="+address+"&phone="+phone+"&web="+website+"&description="+desc+"&bag=detil&activate=1"
		pos("../aksi/resto/edit.php", y, () => {
			mengarahkan("./detail")
		})
		return false
	})
</script>

</body>
</html>