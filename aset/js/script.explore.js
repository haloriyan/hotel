function setParam(key, value)
{
    key = encodeURI(key); value = encodeURI(value);

    var kvp = document.location.search.substr(1).split('&');

    var i=kvp.length; var x; while(i--) 
    {
        x = kvp[i].split('=');

        if (x[0]==key)
        {
            x[1] = value;
            kvp[i] = x.join('=');
            break;
        }
    }

    if(i<0) {kvp[kvp.length] = [key,value].join('=');}

    //this will reload the page, it's likely better to store this until finished
    // document.location.search = kvp.join('&'); 
}

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
	setUrlAddr("./explore&q="+encodeURIComponent(val))
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

function city(val) {
    setKuki("region", val)
}

load()

let val = pilih("#q").value
let set = "namakuki=kwExplore&value="+val+"&durasi=1000"
pos("aksi/setCookie.php", set, function() {
	load()
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
    pos("aksi/user/login.php", log, function() {
        location.reload()
    })
    return false
})