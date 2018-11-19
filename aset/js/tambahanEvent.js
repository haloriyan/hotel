/* facebook share start */
// init FB
window.fbAsyncInit = function() {
	FB.init({
		appId: '360288181377346',
		autoLogAppEvents: true,
		xfbml: true,
		version: 'v3.1'
	})
}
// load SDK
(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement(s); js.id = id;
	js.src = "https://connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
// func ogshare
function ogShare() {
	FB.ui({
  		method: 'share',
  		href: pilih("#urlNow").value
	}, function(response){
		console.log(response)
	});
}
function shareTwitter() {
	let urlToShare = 'http://twitter.com/share?text=Awesome event!&url='+pilih('#urlNow').value;
	let urlToShares = 'http://twitter.com/share?text=Awesome event!&url=https://www.facebook.com/BelajarNgewebID'
	window.open(urlToShare, '_blank').focus()
}

submit("#formBook", function() {
	let idevent = pilih("#idevent").value
	let tgl = pilih("#tglBook").value
	if(tgl == "0000-00-00" || tgl == "") {
		return false
	}
	let qty = pilih("#qty").value
	let book = "idevent="+idevent+"&tgl="+tgl+"&qty="+qty
	pos("../aksi/booking/book.php", book, function() {
		hilangPopup("#popupBook")
		munculPopup("#suksesBook", pengaya("#suksesBook", "top: 230px"))
		setTimeout(() => {
			location.reload()
		}, 1200)
	})
	return false
})
let redirect = btoa(pilih("#urlNow").value)
function loadBoxQty() {
	ambil("../aksi/event/loadBoxQty.php", (res) => {
		tulis("#loadBoxQty", res)
	})
}
function selectDate(val) {
	let set = "namakuki=tglevent&value="+val+"&durasi=3666"
	pos("../aksi/setCookie.php", set, () => {
		loadBoxQty()
	})
}
klik("#tblLogin", () => {
	mengarahkan("../auth&r="+redirect)
})