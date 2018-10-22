function loadGaleri() {
	ambil("../aksi/galeri/loadHotel2.php", function(res) {
		tulis("#loadGaleri", res)
	})
}
function loadAlbum(val) {
	let set = "namakuki=idalbum&value="+val+"&durasi=3666"
	pos("../aksi/setCookie.php", set, () => {
		ambil("../aksi/galeri/loadAlbum.php", (res) => {
			tulis("#loadGaleri", res)
		})
	})
	let setPublic = "namakuki=public&value=1&durasi=3666"
	pos("../aksi/setCookie.php", setPublic, () => {
		console.log("hello")
	})
}
function loadExplore() {
	ambil("../aksi/hotel/ourEvent.php", function(res) {
		tulis("#loadExplore", res)
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
function gantiMenu(kecuali) {
	pilih("#showexplores").setAttribute("aktif", "tidak")
	// pilih("#showreviews").setAttribute("aktif", "tidak")
	// pilih("#showrents").setAttribute("aktif", "tidak")
	pilih("#showprofiles").setAttribute("aktif", "tidak")

	hilang("#explores")
	hilang("#galeries")
	hilang("#profiles")
	// hilang("#reviews")
	// hilang("#rents")

	muncul("#"+kecuali)
	pilih("#show"+kecuali).setAttribute("aktif", "ya")
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

klik("#allGallery", function() {
	scrollKe("#galeries")
	muncul("#galeries")
	hilang("#bawahKanan")
	hilang("#bawahKiri")
	loadGaleri()
})
klik("#showexplores", function() {
	scrollKe("#explores")
	gantiMenu("explores")
	loadExplore()
})
klik("#showprofiles", function() {
	scrollKe("#profiles")
	gantiMenu("profiles")
	loadExplore()
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
	hilang("#formLogin")
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