<?php
include "koneksi.php";
date_default_timezone_set('Asia/Makassar');

function getJumlah($tabel,$term){
	$jRec = mysql_num_rows(mysql_query("SELECT * FROM $tabel $term"));
	return $jRec;
}

function getData($field,$tabel,$term){
	$dt = mysql_fetch_array(mysql_query("SELECT $field FROM $tabel WHERE $term"));
	return $dt;
}

function getPAktif(){
	$dt = mysql_fetch_array(mysql_query("SELECT * FROM periode WHERE pAktif='1'"));
	$prId = $dt['pId'];
	
	$_SESSION['sesPr'] = $prId;
}

function getValue($field,$table,$term){
	$z = mysql_fetch_array(mysql_query("SELECT $field FROM $table WHERE $term"));
	return $z[0];
}

function getNumRows($query){
	$z = mysql_num_rows(mysql_query("$query"));
	return $z;
}

function getTahun(){
	$thn_s = date('Y');
	$start = 1995;
	$thn = array();
	for ($x = $start; $x <= $thn_s; $x++){
		array_push($thn, $x);
	}
	return $thn;
}

function getMRNum($field,$tabel,$term,$jslice){
	$q = mysql_fetch_array(mysql_query("SELECT MAX($field) as x FROM $tabel WHERE $term"));
	$d = $q[x];
	$not = substr($d, $jslice,5);

	if ($not==""){
		$y = "00001";
	}else{
		$i = $not;
		$i++;
		if (strlen($i)==1){
			$y="0000".$i;
		}elseif (strlen($i)==2){
			$y="000".$i;
		}elseif (strlen($i)==3){
			$y="00".$i;
		}elseif (strlen($i)==4) {
			$y="0".$i;
		}else{
			$y=$i;
		}
	}
	return $y; 
}

function rupiah($angka){
   $jadi="Rp.".number_format($angka,0,',','.');
   	return $jadi;
}

function getSK($x){
	$i = $x;
	if (strlen($i)==1){
		$y="00".$i;
	}elseif (strlen($i)==2) {
		$y="0".$i;
	}else{
		$y=$i;
	}
	return $y; 
}
?>