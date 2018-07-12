function loadGaleri() {
	ambil("../aksi/galeri/loadHotel2.php", function(res) {
		tulis("#loadGaleri", res)
	})
}

function fadeOut(el) {
	let op = 1;
	let element = pilih(el)
	let timer = setInterval(function() {
		if(op <= 0.01) {
			clearInterval(timer)
			element.style.display = "none"
		}
		element.style.opacity = op
		element.style.filter = 'alpha(opacity=' + op * 100 + ")";
       	op -= op * 0.1;
	}, 50)
}
function seeImage(val) {
	munculPopup("#popupSeeImage", pengaya("#popupSeeImage", "top: 40px"))
	pilih("#seeImage").setAttribute("src", "../aset/gbr/"+val)
}
window.addEventListener("scroll", function() {
	var skrol = window.pageYOffset
	if(skrol >= 40) {
		pengaya(".atas", "background: #cb0029")
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
klik("#tblLogin", function() {
	muncul(".bg")
	muncul("#formLogin")
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
klik("#allGallery", function() {
	scrollKe("#galeries")
	muncul("#galeries")
	hilang("#bawahKanan")
	hilang("#bawahKiri")
	loadGaleri()
})
klik("#xGaleri", function() {
	hilang("#galeries")
	muncul("#bawahKiri")
	muncul("#bawahKanan")
})
klik("#xSeeImg", function() {
	hilangPopup("#popupSeeImage")
})
tekan("Escape", function() {
	hilangPopup("#popupSeeImage")
})