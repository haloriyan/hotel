klik("#linkReg", function() {
	hilang("#formLogin")
	muncul("#formRegist")
	pengaya(".container", "top: 60px")
})

pilih("#formRegist").onsubmit = function() {
	let name = pilih("#nameReg").value
	let email = pilih("#mailReg").value
	let pwd = pilih("#pwdReg").value
	let reg = "name="+name+"&email="+email+"&pwd="+pwd
	if(name == "" || email == "" || pwd == "") {
		return false
	}
	pos("../aksi/hotel/register.php", reg, function() {
		hilang("#formRegist")
		muncul("#suksesReg")
		pengaya(".container", "top:125px")
	})
	return false
}

pilih("#formLogin").onsubmit = function() {
	let email = pilih("#mailLog").value
	let pwd = pilih("#pwdLog").value
	let log = "email="+email+"&pwd="+pwd
	if(email == "" || pwd == "") {
		return false
	}
	pos("../aksi/hotel/login.php", log, function() {
		mengarahkan("../hotel/dashboard")
	})
	return false
}

klik("#xNotif", function() {
	hilangPopup("#notif")
})

tekan("Escape", function() {
	hilangPopup("#notif")
})