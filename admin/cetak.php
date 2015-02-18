<?php
include "../config/koneksi.php";
include "../config/fungsiku.php";
include "../config/fungsi_indotgl.php";
$m=mysql_fetch_array(mysql_query("SELECT * FROM mahasiswa,skripsi,kampus,jurusan
										   WHERE mahasiswa.mNim=skripsi.mNim 
										   AND kampus.kId=jurusan.kId
										   AND skripsi.sId='$_GET[id]'"));
$tgl = getTglIndo(date("Y-m-d"));
$p  = mysql_fetch_array(mysql_query("SELECT * FROM dosen WHERE id_admin='$m[sPem1]'"));
$pp = mysql_fetch_array(mysql_query("SELECT * FROM dosen WHERE id_admin='$m[sPem2]'"));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Surat Keputusan Pembimbing</title>
</head>
<style>
body{
line-height:1.3em;
font-size:12px;
font-family:Arial, Helvetica, sans-serif
}
#main{
width:800px;
margin:auto;
padding:10px;
font-size:12px;
}
#main #header{
text-align:center;
}
#main #header span{
font-size:18px;
}
#main #header h2{
padding:0;
margin:5px;	
font-size:24px;
font-family:Georgia, "Times New Roman", Times, serif;
}
.spaceborder{
border-bottom:4px groove #999;
margin-bottom:50px;	
}
.sk{
width:550px;
margin:auto;
font-size:17px;
font-weight:bold;
text-align:center;	
}
.sk span{
font-size:14px;	
font-weight:normal;
}
table{
border-collapse:collapse;	
}
table tr td{
padding:5px;	
}
#main span{
text-transform:uppercase;
font-size:14px;
font-weight:bold;	
}
.sign{
float:right;	
}
</style>
<body>
<div id="main">
	<div id="header">
    	<center>
        <table width="100%">
        	<tr>
            	<td width="100">
                	<img src="../images/llogo.png" width="100"/>
                </td>
                <td align="center" valign="bottom">
                	<span>UNIVERSITAS DARUSSALAM AMBON</span><br />
                    FAKULTAS EKONOMI, FAKULTAS PERTANIAN, FAKULTAS TEKNIK, <br />FAKULTAS ILMU SOSIAL,
FAKULTAS KEGURUAN DAN  ILMU PENDIDIKAN, FAKULTAS HUKUM,<br />
FAKULTAS PERIKANAN DAN ILMU KELAUTAN<br />
<i><strong>Jl. Raya Tulehu KM 24 Ambon Kode Pos 97682 Telp. 0911-3303422<br />
Webside : www.elearning.darussalam.co.id Email : Unidar.darussalam@gmail.com</strong></i>
                </td>
            </tr>
        </table>
        </center>
    </div>
    <div class="spaceborder"></div>
    <div class="sk">SURAT KEPUTUSAN<br /><span>Dekan Fakultas Hukum Unversitas Darrusalam Ambon</span><br />Nomor : <?php echo $m['sId'];?> / SK/ FH.UD / 2014</div>
    <br /><br />''
    <strong>MENIMBANG</strong>: 
    <ul type="1">
    	<li>Bahwa bagi mahasiswa yang telah memenuhi persyaratan tertentu, perlu melaksanakan penelitian dan penyusunan Skripsi</li>
        <li>Bahwa untuk maksud diatas, maka perlu ditunjuk dan ditetapkan Dosen Pembimbing yang bertugas memberika bimbingan dan arahan kepada mahasiswa yang bersangkutan.</li>
        <li>Bahwa para dosen yang namanya tercantum pada lampiran keputusan ini dianggap mampu dan memenuhi syarat untuk ditetapkan sebagai Dosen Pembimbing Penelitian dan Penyusunan Skripsi.</li>
    </ul>
    <strong>MENGINGAT</strong>: 
    <ul type="1">
    	<li>Undang – undang Nomor 20 tahun 2003 tentang Sistem Pendidikan Nasional</li>
        <li>Peraturan Pemerintah Nomor 60 Tahun 1999 tentang Pendidikan Tinggi</li>
        <li>Keputusan Direktorat Jenderal Pendidikan Tinggi tentang Pemberian Ijin PenyelenggaraanProgram Studi pada Fakultas Hukum Universitas Darrusalam Ambon.</li>
        <li>Keputusan Rektor Universitas Darussalam Ambon Nomor : 19/SK/PTS.UD/2009 tentang Pengangkatan Dekan Fakultas Hukum Universitas Darussalam Ambon.</li>
    </ul>
   <strong> MEMUTUSKAN: </strong><br />
   Menetapkan
   <table width="100%">
   	<tr>
    	<td valign="top"><strong>Pertama</strong></td><td>Dosen yang namaya tercantum pada lampiran Keputusan ini bertugas dan bertanggung jawab dalam memberika bimbingan penelitian dan penyusunan skripsi bagi mahasiswa Fakultas Hukum Program Studi Hukum pidana.</td>
    </tr>
    <tr>
    	<td valign="top"><strong>Kedua</strong></td><td>Pembimbing bertugas mrmberi bimbingan dan arahan kepada Keputusan dalam menyusun rencana penelitian dan penulisan skripsi.</td>
    </tr>
    <tr>
    	<td valign="top"><strong>Ketiga</strong></td><td>Keputusan ini mulai berlaku  sejak tanggal ditetapkan dengan ketentuan apabila dikemudian hari terdapat kekeliruan akan diadakan perbaikan sebagiaman mestinya.</td>
    </tr>
   </table><br /><br /><br /><br /><br />
   <div class="sign">
   Ditetapkan di Ambon<br />
   Pada tanggal: <?php echo $tgl;?><br /><br /><br /><br /><br />
   <strong>ISMAIL.LESTALUHU, SH.MH</strong><br />
   NIP. 197330427 200212 2 005
   </div>
   Tembusan:
   <ul type="1">
   		<li>Rektor Universitas Darussalam Ambon (Sebagai Laporan)</li>
        <li>Ketua Program Studi Hukum Pidana</li>
        <li>Yang Bersangkutan</li>
        <li>Arsip</li>
   </ul><br /><br /><br /><br /><br />
Lampiran : Surat Keputusan Dekan Fakultas Hukum Universitas Darussalam Ambon<br />
Nomor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?=$m[sId];?> / SK/ FH.UD / 2014<br /><br /> 
<table border="1" width="100%">
            	<tr>
                	<td>Nama</td>
                	<td>Judul</td>
                    <td>Pembimbing</td>
                <tr>
                	<td><strong><?php echo $m['mNama'];?></strong><br /> <?php echo $m['mNim'];?></td>
                    <td><?php echo $m['sJudul'];?></td>
                    <td>1. <?php echo $pp;?><br />
                    	2. <?php echo $pp['nama_lengkap'];?>
					</td>
                </tr>
            </table><br /><br />
            <div class="sign">
               Ditetapkan di Ambon<br />
               Pada tanggal: <?php echo $tgl;?><br /><br /><br /><br /><br />
               <strong>ISMAIL.LESTALUHU, SH.MH</strong><br />
               NIP. 197330427 200212 2 005
               </div>
</div>
</body>
</html>