<?php
// class paging untuk halaman administrator
class PagingInfo{
	// Fungsi untuk mencek halaman dan posisi data
	function cariPosisi($batas){
		if(empty($_GET['hal'])){
			$posisi=0;
			$_GET['hal']=1;
		}
		else{
			$posisi = ($_GET['hal']-1) * $batas;
		}
		return $posisi;
	}

	// Fungsi untuk menghitung total halagenda
	function jumlahHalaman($jmldata, $batas){
		$jmlhalaman = ceil($jmldata/$batas);
		return $jmlhalaman;
	}

	// Fungsi untuk link halaman 1,2,3 (untuk admin)
	function navHalaman($halaman_aktif, $jmlhalaman){
		$link_halaman = "";

		// Link ke halaman pertama (first) dan sebelumnya (prev)
		if($halaman_aktif > 1){
			$prev = $halaman_aktif-1;
			$link_halaman .= "<li><a href=$_SERVER[PHP_SELF]?p=info&hal=1>&laquo;</a></li>
			<li><a href=$_SERVER[PHP_SELF]?p=info&hal=$prev>&lsaquo;</a></li>";
		}
		else{ 
			$link_halaman .= "<li class='disabled'><a href=$_SERVER[PHP_SELF]?p=info&hal=1>&laquo;</a></li>
			<li class='disabled'><a href=$_SERVER[PHP_SELF]?p=info&hal=1>&lsaquo; </a></li>";
		}

		// Link halaman 1,2,3, ...
		$angka = ($halaman_aktif > 3 ? "<li class='disabled'><a ='#'> ... </a></li> " : " "); 
		for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
			if ($i < 1)
				continue;
			$angka .= "<li><a href=$_SERVER[PHP_SELF]?p=info&hal=$i>$i </a></li>";
		}
		$angka .= "<li class='active'><a href='#'><strong>$halaman_aktif</strong></a></li>";

		for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
			if($i > $jmlhalaman)
				break;
			$angka .= "<li><a href=$_SERVER[PHP_SELF]?p=info&hal=$i> $i </a></li>";
		}
		$angka .= ($halaman_aktif+2<$jmlhalaman ? "<li class='disabled'><a href='#'> ... </a></li><li><a href=$_SERVER[PHP_SELF]?p=info&hal=$jmlhalaman>$jmlhalaman</a></li>" : " ");

		$link_halaman .= "$angka";

		// Link ke halaman berikutnya (Next) dan terakhir (Last) 
		if($halaman_aktif < $jmlhalaman){
			$next = $halaman_aktif+1;
			$link_halaman .= " <li><a href=$_SERVER[PHP_SELF]?p=info&hal=$next>&rsaquo;</a></li>
			<li><a href=$_SERVER[PHP_SELF]?p=info&hal=$jmlhalaman>&raquo;</a></li>";
		}
		else{
			$link_halaman .= " <li class='disabled'><a href=$_SERVER[PHP_SELF]?p=info&hal=$jmlhalaman>&rsaquo;</a></li>
			<li class='disabled'><a href=$_SERVER[PHP_SELF]?p=info&hal=$jmlhalaman>&raquo;</a> </li>";
		}
		return $link_halaman;
	}
}
?>