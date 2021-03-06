function gantiMenu(kecuali) {
	pilih("#showdetails").setAttribute("aktif", "tidak")
	// pilih("#showreviews").setAttribute("aktif", "tidak")
	// pilih("#showrents").setAttribute("aktif", "tidak")
	pilih("#showcomments").setAttribute("aktif", "tidak")

	hilang("#details")
	hilang("#comments")
	// hilang("#reviews")
	// hilang("#rents")

	muncul("#"+kecuali)
	pilih("#show"+kecuali).setAttribute("aktif", "ya")
}
function munculContact() {
	muncul(".bg")
	pengaya(".listContact", "right: 2.5%")
	pengaya("#wa", "left: 0px")
	setTimeout(function() {
		pengaya("#call", "left: 0px")
	}, 400)
}
klik("#showcomments", () => {
	gantiMenu("comments")
})
klik("#showdetails", () => {
	gantiMenu("details")
})

function munculShare() {
	muncul(".bg")
	muncul(".sharer")
	muncul("#phone")
}
function hilangShare() {
	hilang(".bg")
	hilang(".sharer")
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
		pilih(".atas").setAttribute("class", "atas merah-2")
	}else {
		pilih(".atas").setAttribute("class", "atas")
	}
})
// klik("#tblMenu", function() {
// 	alert('y')
// 	let tbl = pilih("#tblMenu")
// 	let aksi = tbl.getAttribute("aksi")
// 	if(aksi == "bkMenu") {
// 		pengaya(".menu", "left: 0%")
// 		tbl.setAttribute("aksi", "xMenu")
// 	}else {
// 		pengaya(".menu", "left: 100%")
// 		tbl.setAttribute("aksi", "bkMenu")
// 	}
// })
tekan("Escape", function() {
	hilang(".bg")
	hilang("#notif")
	hilangContact()
	hilangPopup("#popupBook")
	hilangPopup("#suksesBook")
	hilangShare()
})
klik(".bg", () => {
	hilangContact()
	hilangShare()
})

klik("#xBook", function() {
	hilangPopup("#popupBook")
})