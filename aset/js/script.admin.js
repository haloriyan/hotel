pilih("#formLogin").onsubmit = function() {
	let username = pilih("#usernameLog").value
	let pwd = pilih("#pwdLog").value
	let log = "username="+username+"&pwd="+pwd
	if(username == "" || pwd == "") {
		return false
	}
	pos("../aksi/admin/login.php", log, function() {
		mengarahkan("../admin/dashboard")
	})
	return false
}

klik("#xNotif", function() {
	hilangPopup("#notif")
})

tekan("Escape", function() {
	hilangPopup("#notif")
})
