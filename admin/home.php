<?php
	$hari_s = getHari(date("w"));
	echo "
	<h1 class='page-header'>SELAMAT DATANG</h1>
	<hr>
	<p>Hai <b>$_SESSION[sesNama]</b>, selamat datang di halaman Administrator.<br> Silahkan klik menu pilihan yang berada 
	di sebelah kiri untuk mengelola konten website anda. </p>
	<p>&nbsp;</p<p>&nbsp;</p>
	<p>Login : $hari_s, ".getTglIndo(date('Y m d'))." | ".date('H:i:s')." WITA</p>";
?>