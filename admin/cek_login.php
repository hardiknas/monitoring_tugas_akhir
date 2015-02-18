<?php
include "../config/koneksi.php";
include "../config/fungsiku.php";

function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

$uname = anti_injection($_POST['username']);
$upass = anti_injection(md5($_POST['password']));

// pastikan username dan password adalah berupa huruf atau angka.
if (!ctype_alnum($uname) OR !ctype_alnum($upass)){
  header('location:index.php');
}else{
	$login=mysql_query("SELECT * FROM admin WHERE username='$uname' AND password='$upass'");	
	$ketemu=mysql_num_rows($login);
	$r=mysql_fetch_array($login);

	$uid=$r['id_admin'];
	$uname=$r['username'];
	$unama=$r['nama_lengkap'];

	$paktif = getData("pTahun,pDekan,pDNip,pQSP,pQUH,pQUM","periode","pAktif='1'");
	
	
	// apabila username dan password ditemukan
	if ($ketemu > 0){
		session_start();
		include "timeout.php";
		
		$_SESSION['sesId'] = $uid;
		$_SESSION['sesUser'] = $uname;
		$_SESSION['sesNama'] = $unama;
		$_SESSION['sesLevel'] = 1;
		getPAktif();

		// session timeout
    	timer();
    	$sid_lama = session_id();
    	session_regenerate_id();
    	$sid_baru = session_id();
    	mysql_query("UPDATE admin SET id_session='$sid_baru' WHERE username='$username'");
		header('location:media.php?page=home');
	}else{
		echo "<script>parent.location = 'index.php?result=error';</script>";  
	}
}
?>
