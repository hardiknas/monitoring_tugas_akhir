<?php
// ALL CONTENT
if ($_GET[page]=='home'){
	include 'home.php';
}elseif($_GET[page]=='jadwal'){
	include 'mod/dosen/jadwal.php';
}elseif($_GET[page]=='bimbingan'){
	include 'mod/dosen/bimbingan.php';
}elseif($_GET[page]=='komen'){
	include 'mod/dosen/komentarbaru.php';
}


elseif($_GET[page]=='konsul'){
	include 'mod/mahasiswa/konsultasi.php';
}elseif($_GET[page]=='ljudul'){
	include 'mod/mahasiswa/ljudul.php';
}elseif($_GET[page]=='dosen'){
	include 'mod/mahasiswa/dosen.php';
}


else{
	include 'error.php';
}
?>