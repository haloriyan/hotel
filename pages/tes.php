<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<title>an</title>
	<link href="aset/rangeSlider/css/ion.rangeSlider.css" rel="stylesheet">
	<link href="aset/rangeSlider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet">
	<link href="aset/rangeSlider/css/normalize.css" rel="stylesheet">
</head>
<body style="text-align: center;">

<div style="width: 80%;display: inline-block;">
	<input id="myRange">
</div>

<script src="aset/js/jquery-3.1.1.js"></script>
<script src="aset/rangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
<script>
	$("#myRange").ionRangeSlider({
		type: "double",
		min: 0,
		max: 100000,
		from: 10000,
		to: 15000,
	    grid: false
	})
</script>

</body>
</html>