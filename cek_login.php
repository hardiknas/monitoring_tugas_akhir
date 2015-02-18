<?php
include "config/koneksi.php";
include "config/fungsiku.php";
function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

$username = anti_injection($_POST['username']);
$pass     = anti_injection(md5($_POST['password']));

// pastikan username dan password adalah berupa huruf atau angka.
if (!ctype_alnum($username) OR !ctype_alnum($pass)){
  header('location:index.php');
}else{
	if($_POST['level']=="2"){
		$login=mysql_query("SELECT * FROM dosen WHERE username_login='$username' AND password_login='$pass'");
		$ketemu=mysql_num_rows($login);
		$r=mysql_fetch_array($login);
		$uid = $r['id_dosen'];
		$ukey = $r['nip'];
		$uuser = $r['username_login'];
		$unama = $r['nama_lengkap'];
		$ufoto = $r['foto'];
		$ulevel = "2";
	}else{
		$login=mysql_query("SELECT * FROM mahasiswa WHERE username='$username' AND password='$pass'");
		$ketemu=mysql_num_rows($login);
		$r=mysql_fetch_array($login);
		$uid = $r['mNim'];
		$ukey = $r['mNim'];
		$uuser = $r['username'];
		$unama = $r['mNama'];
		$ufoto = $r['mFoto'];
		$ulevel = "3";
	}
		
	// Apabila username dan password ditemukan
	if ($ketemu > 0){
	  session_start();
	  include "timeout.php";
	  
	  $_SESSION['uId'] = $uid;
	  $_SESSION['uKey'] = $ukey;
	  $_SESSION['uUser'] = $uuser;
	  $_SESSION['uNama'] = $unama;
	  $_SESSION['uLevel'] = $ulevel;
	  $_SESSION['uFoto'] = $ufoto;
	  getPAktif();
	
	  timer();
	  header('location:index.php?rl=1');
	}else{
	  echo "<script>parent.location='index.php?rl=0';</script>";
	}
}
?>
