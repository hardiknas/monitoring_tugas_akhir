<?php
if ($_GET[page]=='home'){
	include 'home.php';
}elseif($_GET[page]=='admin'){
	include 'mod/mod_admin/admin.php';
}elseif($_GET[page]=='periode'){
	include 'mod/mod_periode/periode.php';
}elseif($_GET[page]=='dosen'){
	include 'mod/mod_dosen/dosen.php';
}elseif($_GET[page]=='mahasiswa'){
	include 'mod/mod_mahasiswa/mahasiswa.php';
}elseif($_GET[page]=='jtabaru'){
	include 'mod/mod_jta/jtabaru.php';
}elseif($_GET[page]=='jtaterdaftar'){
	include 'mod/mod_jta/jtaterdaftar.php';
}elseif($_GET[page]=='jsp'){
	include 'mod/mod_jta/jsp.php';
}elseif($_GET[page]=='juh'){
	include 'mod/mod_jta/juh.php';
}elseif($_GET[page]=='jum'){
	include 'mod/mod_jta/jum.php';
}elseif($_GET[page]=='info'){
	include 'mod/mod_info/info.php';
}elseif($_GET[page]=='lap'){
	include 'mod/mod_laporan/laporan.php';
}else{
	include 'error.php';
}
?>