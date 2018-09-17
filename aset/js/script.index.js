window.addEventListener("scroll", function() {
		var skrol = window.pageYOffset
		if(skrol >= 40) {
			pengaya(".atas", "background: #cb0029")
			pengaya(".sub", "background: #cb0029")
		}else {
			pengaya(".atas", "background: none")
			pengaya(".sub", "background: none")
		}
	})

	klik(".bg", function() {
		hilang(".bg")
		hilang("#formLogin")
		hilang("#notif")
		hilangPopup("#formLoginBaru")
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