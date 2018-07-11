function load() {
	ambil("aksi/event/load.php", function(res) {
		tulis("#load", res)
	})
}

function cari(val) {
	let set = "namakuki=kwExplore&value="+val+"&durasi=1000"
	pos("aksi/setCookie.php", set, function() {
		load()
	})
}

load()

let val = pilih("#q").value
let set = "namakuki=kwExplore&value="+val+"&durasi=1000"
pos("aksi/setCookie.php", set, function() {
	load()
})