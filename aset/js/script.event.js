// munculPopup("#popupBook", pengaya("#popupBook", "top: 140px"))
// Date picker
$(function() {
	$("#tglBook").datepicker({
		minDate: $("#minDate").val(),
		maxDate: $("#maxDate").val(),
		dateFormat: 'yy-mm-dd',
		useCurrent: false,
    	showClose: true
	})
})

function munculContact() {
	muncul(".bg")
	pengaya(".listContact", "right: 2.5%")
	pengaya("#wa", "left: 0px")
	setTimeout(function() {
		pengaya("#call", "left: 0px")
	}, 400)
}
function hilangContact() {
	pengaya("#wa", "left: 300px")
	setTimeout(function() {
		pengaya("#call", "left: 300px")
	}, 400)
	setTimeout(function() {
		hilang(".bg")
		pengaya(".listContact", "right: -25%")
	}, 750)
}

klik("#phone", function() {
	let aksi = pilih("#phone").getAttribute("aksi")
	if(aksi == "on") {
		munculContact()
		pilih("#phone").setAttribute("aksi", "off")
	}else {
		hilangContact()
		pilih("#phone").setAttribute("aksi", "on")
	}
})
function track(tipe) {
	let idevent = pilih("#idevent").value
	let param = "tipe="+tipe+"&idevent="+idevent
	pos("../aksi/track.php", param, function() {
		console.log('tracked')
	})
}
window.addEventListener("scroll", function() {
	var skrol = window.pageYOffset
	if(skrol >= 40) {
		pengaya(".atas", "background: #cb0023")
	}else {
		pengaya(".atas", "background: none")
	}
})
klik("#tblMenu", function() {
	let tbl = pilih("#tblMenu")
	let aksi = tbl.getAttribute("aksi")
	if(aksi == "bkMenu") {
		pengaya(".menu", "left: 0%")
		tbl.setAttribute("aksi", "xMenu")
	}else {
		pengaya(".menu", "left: 100%")
		tbl.setAttribute("aksi", "bkMenu")
	}
})
tekan("Escape", function() {
	hilangContact()
	hilangPopup("#popupBook")
	hilangPopup("#suksesBook")
	hilang("#popupRegist")
})

klik("#xBook", function() {
	hilangPopup("#popupBook")
})
submit("#formSignIn", function() {
	let email = pilih("#mailLog").value
	let pwd = pilih("#pwdLog").value
	let log = "email="+email+"&pwd="+pwd
	if(email == "" || pwd == "") {
		return false
	}
	pos("../aksi/user/login.php", log, function() {
		location.reload()
	})
	return false
})
klik("#tblLogin", function() {
	muncul(".bg")
	muncul("#formLogin")
})
