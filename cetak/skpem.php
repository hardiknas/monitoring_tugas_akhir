<?php
session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
date_default_timezone_set("Asia/Makassar");

include "../config/koneksi.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_thumb.php";
include "../config/fungsiku.php";
include '../config/konfigurasi.php';

if (empty($_SESSION['sesId'])&&(empty($_SESSION['uId']))){
	echo "<script>window.close();</script>";
}

else{
	require ("html2pdf/html2pdf.class.php");
	$filename="SK Pembimbing Tugas Akhir.pdf";
	$content = ob_get_clean();
	$year = date('Y');
	$month = date('m');
	$date = date('d');
	$now = date('Y-m-d');
	$date_now = getTglIndo($now);

	
	$sid = $_GET['sid'];

	$nosk = getValue("sNoSKPembimbing","skripsi","sId='$_GET[sid]'");

	$content = "
				<small>Tanggal Print : $date_now</small>
				<hr>
				<table border='0' style='margin:10px 50px 50px 50px;'>
					<tr valign='middle'>
						<td><img src='$_CONFIG[syskop]' height='$_CONFIG[tinggikop]'></td>
						<td width='20'></td>
						<td>
							FAKULTAS HUKUM<br>
							<h1>UNIVERSITAS DARUSSALAM AMBON</h1>
							Alamat : $_CONFIG[owneraddress] - $_CONFIG[ownercity] $_CONFIG[ownerpostalcode]<br>
							Telp. $_CONFIG[ownertelp] | Fax. $_CONFIG[ownerfax]	| Email : $_CONFIG[owneremail]
						</td>
					</tr>
				</table>
				<hr>
					<br>
					<p align='center'><b><u>SURAT KEPUTUSAN</u></b><br>
					DEKAN FAKULTAS HUKUM UNIVERSITAS DARUSSALAM AMBON<br>
					NO : $nosk
					</p>
					<b>MENIMBANG :</b><br>
					<p>
						<ol type='1'>
    						<li>Bahwa bagi mahasiswa yang telah memenuhi persyaratan tertentu, perlu melaksanakan penelitian dan penyusunan Skripsi</li>
        					<li>Bahwa untuk maksud diatas, maka perlu ditunjuk dan ditetapkan Dosen Pembimbing yang bertugas memberika bimbingan dan arahan kepada mahasiswa yang bersangkutan.</li>
        					<li>Bahwa para dosen yang namanya tercantum pada lampiran keputusan ini dianggap mampu dan memenuhi syarat untuk ditetapkan sebagai Dosen Pembimbing Penelitian dan Penyusunan Skripsi.</li>
    					</ol>
					</p>
					<b>MENGINGAT :</b><br>
					<p>
						<ol type='1'>
    						<li>Undang - undang Nomor 20 tahun 2003 tentang Sistem Pendidikan Nasional</li>
        					<li>Peraturan Pemerintah Nomor 60 Tahun 1999 tentang Pendidikan Tinggi</li>
        					<li>Keputusan Direktorat Jenderal Pendidikan Tinggi tentang Pemberian Ijin PenyelenggaraanProgram Studi pada Fakultas Hukum Universitas Darrusalam Ambon.</li>
        					<li>Keputusan Rektor Universitas Darussalam Ambon Nomor : 19/SK/PTS.UD/2009 tentang Pengangkatan Dekan Fakultas Hukum Universitas Darussalam Ambon.</li>
    					</ol>
					</p>
					<strong>MEMUTUSKAN: </strong><br/>
   				Menetapkan
   				<table width='100'>
   				<tr>
    					<td valign='top'><strong>Pertama</strong></td><td>Dosen yang namaya tercantum pada lampiran Keputusan ini bertugas dan bertanggung jawab dalam<br> memberikan bimbingan penelitian dan penyusunan skripsi bagi mahasiswa Fakultas Hukum Program<br>Studi Hukum pidana.</td>
    				</tr>
    				<tr>
    					<td valign='top'><strong>Kedua</strong></td><td>Pembimbing bertugas memberi bimbingan dan arahan kepada Keputusan dalam menyusun rencana<br>penelitian dan penulisan skripsi.</td>
    				</tr>
    				<tr>
    					<td valign='top'><strong>Ketiga</strong></td><td>Keputusan ini mulai berlaku sejak tanggal ditetapkan dengan ketentuan apabila dikemudian hari<br> terdapat kekeliruan akan diadakan perbaikan sebagiaman mestinya.</td>
    				</tr>
   				</table>
					<br>
					<table>
						<tr>
							<td width='400'></td>
							<td align='center'>
								Ambon, $date_now<br>
								Mengetahui :<br>
								<b>DEKAN FAKULTAS HUKUM</b>
								<br><br><br><br><br>								
								<b><u>$_SESSION[sesNamaDekan]</u></b><br>
								$_SESSION[sesNipDekan]
							</td>
						</tr>
					</table>
					<table>
						<tr>
							<td width='400'>
								Tembusan:
							   <ol type='1'>
							   		<li>Rektor Universitas Darussalam Ambon (Sebagai Laporan)</li>
							        <li>Ketua Program Studi Hukum Pidana</li>
							        <li>Yang Bersangkutan</li>
							        <li>Arsip</li>
							   </ol>
							</td>
						</tr>
					</table>
					
					<br><br><br><br><br><br><br>
					<small>Tanggal Print : $date_now</small>
					<hr>
					<table border='0' style='margin:10px 50px 50px 50px;'>
						<tr valign='middle'>
							<td><img src='$_CONFIG[syskop]' height='$_CONFIG[tinggikop]'></td>
							<td width='20'></td>
							<td>
								FAKULTAS HUKUM<br>
								<h1>UNIVERSITAS DARUSSALAM AMBON</h1>
								Alamat : $_CONFIG[owneraddress] - $_CONFIG[ownercity] $_CONFIG[ownerpostalcode]<br>
								Telp. $_CONFIG[ownertelp] | Fax. $_CONFIG[ownerfax]	| Email : $_CONFIG[owneremail]
							</td>
						</tr>
					</table>
					<hr>
					<br>
					<p align='left'>
						<b>Lampiran : </b>Surat Keputusan Dekan Fakultas Hukum Universitas Darussalam Ambon<br>
						<b>Nomor : </b> $nosk
					</p>
					<br><br><br><br>
					<table cellpadding='0' border='0' cellspacing='0' align='center'>
					<tr>
						<th align='center' width='150' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>Nama</th>
						<th align='center' width='250' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>Judul</th>
						<th align='center' width='250' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>Pembimbing</th>
					</tr>";
			
					$query = mysql_query("SELECT a.*,b.* FROM skripsi a
					 							  LEFT JOIN mahasiswa b ON a.mNim=b.mNim
					 							  WHERE a.sId='$sid'");
					while ($d = mysql_fetch_array($query)){
						$no++;
						$p1 = getValue("nama_lengkap","dosen","id_dosen='$d[sPem1]'");
						$p2 = getValue("nama_lengkap","dosen","id_dosen='$d[sPem2]'");
						$content .= 
							"<tr>
								<td style='border:1px solid #000; padding: 4px;' align='center' width='80' valign='middle'>
									$d[mNim]<br>$d[mNama]
								</td>
								<td style='border:1px solid #000; padding: 4px;' width='200' valign='middle'>$d[sJudul]</td>
								<td style='border:1px solid #000; padding: 4px;'>
									<b>Pembimbing I : </b><br>$p1<br><br>
      							<b>Pembimbing II : </b><br>$p2<br>
      						</td>
							</tr>";
					}			
			$content .= "
					</table>
					<br><br><br><br>
					<table>
						<tr>
							<td width='400'></td>
							<td align='center'>
								Ambon, $date_now<br>
								Mengetahui :<br>
								<b>DEKAN FAKULTAS HUKUM</b>
								<br><br><br><br><br>								
								<b><u>$_SESSION[sesNamaDekan]</u></b><br>
								$_SESSION[sesNipDekan]
							</td>
						</tr>
					</table>
				";
			
			
	// conversion HTML => PDF
	try
	{
		$html2pdf = new HTML2PDF('P','A4','fr', false, 'ISO-8859-15',array(10, 10, 10, 10)); //setting ukuran kertas dan margin pada dokumen anda
		// $html2pdf->setModeDebug();
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
}
?>