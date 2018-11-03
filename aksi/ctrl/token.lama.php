<?php
include 'hotel.php';

class token extends hotel {
	public function generateToken() {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$charactersLength = strlen($characters);
    	$randomString = '';
    	$length = 25;
    	for ($i = 0; $i < $length; $i++) {
        	$randomString .= $characters[rand(0, $charactersLength - 1)];
    	}
    	return $randomString;
	}
	public function infoToken($token, $kolom) {
		$q = $this->tabel('token')->pilih($kolom)->dimana(['token' => $token])->eksekusi();
		$r = $this->ambil($q);
		return $r[$kolom];
	}
	public function createToken($email, $tipe) {
		if($tipe == "public") {
			$nama = user::info($email, 'nama');
		}else {
			$nama = hotel::get($email, 'nama');
		}
			$q = $this->tabel('token')
							->tambah([
								'idtoken' => null,
								'token'		=> 'y',
								'user'		=> $email,
								'tipe'		=> $tipe,
								'expired'	=> time() + 3600,
								'created'	=> time()
							])
							->eksekusi();
			setcookie('kukiForgot', 'Instruction for setting up your password was sent to your email. Please check immediately', time() + 45, '/');
		
		return $q;
	}
	public function deleteToken($id) {
		$del = $this->tabel('token')->hapus()->dimana(['idtoken' => $id])->eksekusi();
		return $del;
	}
	public function contoh() {
		$q = controller::tabel('token')->tambah(['idtoken' => rand(1, 99)])->eksekusi();
		setcookie('kukiForgot', 'sukses', time() + 35, '/');
		return $q;
	}
}

$token = new token();