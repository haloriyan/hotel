function load() {
	ambil("aksi/event/load.php", function(res) {
		tulis("#load", res)
	})
}
function setKuki(nama, val) {
	let set = "namakuki="+nama+"&value="+val+"&durasi=3766"
	pos("aksi/setCookie.php", set, function() {
		load()
	})
}

function cari(val) {
	setKuki("kwExplore", val)
}
function tglMulai(val) {
	setKuki("tglMulai", val)
}
function tglAkhir(val) {
	setKuki("tglAkhir", val)
}
function category(val) {
	setKuki("category", val)
}

load()

let val = pilih("#q").value
let set = "namakuki=kwExplore&value="+val+"&durasi=1000"
pos("aksi/setCookie.php", set, function() {
	load()
})