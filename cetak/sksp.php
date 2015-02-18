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
	$filename="Surat Penunjukan.pdf";
	$content = ob_get_clean();
	$year = date('Y');
	$month = date('m');
	$date = date('d');
	$now = date('Y-m-d');
	$date_now = getTglIndo($now);

	
	$sid = $_GET['sid'];

	$ds = getData("*","skripsi","sId='$sid'");
	$mhs = getData("*","mahasiswa","mNim='$ds[mNim]'");
	$jur = getData("*","jurusan","jId='$mhs[jId]'");
	$dsp = getData("*","ujian_proposal","sId='$sid'");

	$tglsp = getTglIndo($dsp[sTgl]);

	$nosk = $dsp['sNoSK'];

	$pem1 = getData("nip,nama_lengkap","dosen","id_dosen='$ds[sPem1]'");
	$pem2 = getData("nip,nama_lengkap","dosen","id_dosen='$ds[sPem2]'");
	$peng1 = getData("nip,nama_lengkap","dosen","id_dosen='$dsp[sPenguji1]'");
	$peng2 = getData("nip,nama_lengkap","dosen","id_dosen='$dsp[sPenguji2]'");
	$peng3 = getData("nip,nama_lengkap","dosen","id_dosen='$dsp[sPenguji3]'");

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
					<p align='center'><b><u>SURAT PENUNJUKAN</u></b><br>
					NO : $nosk
					</p>
					<p>
						Dengan Rahmat Allah SWT, Sehubungan dengan pelaksanaan <b>UJIAN SEMINAR PROPOSAL</b> 
						Mahasiswa <u>Program Studi Hukum $jur[jNama] Fakultas Hukum</u> Universitas Darussalam Ambon, maka: 
						<p align='center'>KETUA PROGRAM STUDI HUKUM $jur[jNama]</p>
						Menetapkan Tim Penguji Seminar Proposal Sebagai Berikut :
					</p>
					<p>
						<b>PEMBIMBING : </b>
						<ol type='1'>
    						<li>$pem1[nip] - $pem1[nama_lengkap]</li>
    						<li>$pem2[nip] - $pem2[nama_lengkap]</li>
    					</ol>
						<b>PENGUJI :</b>
						<ol type='1'>
    						<li>$peng1[nip] - $peng1[nama_lengkap]</li>
    						<li>$peng2[nip] - $peng2[nama_lengkap]</li>
    						<li>$peng3[nip] - $peng3[nama_lengkap]</li>
    					</ol>
    					Bertugas melaksanakan Ujian Seminar Proposal bagi mahasiswa :
					</p>
   				<table cellpadding='0' border='0' cellspacing='0' align='center'>
					<tr>
						<th align='center' width='20' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>No</th>
						<th align='center' width='150' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>NIM</th>
						<th align='center' width='300' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>Nama</th>
						<th align='center' width='100' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>Program Studi</th>
					</tr>
					<tr>
						<td style='border:1px solid #000; padding: 4px;' align='center' width='20'>1</td>
						<td style='border:1px solid #000; padding: 4px;' align='center' width='150'>$mhs[mNim]</td>
						<td style='border:1px solid #000; padding: 4px;' align='center' width='300'>$mhs[mNama]</td>
						<td style='border:1px solid #000; padding: 4px;' align='center' width='100'>$jur[jNama]</td>
					</tr>
   				</table>
					<br>
					<p>
						<b>Judul : </b>$ds[sJudul]<br><br>
						<b>Tanggal : </b>$tglsp<br><br>
						<b>Waktu : </b>$dsp[sJam]<br><br>
						<b>Tempat : </b>$dsp[sT4]<br><br>
						Demikian surat penujukan ini  di berikan dan dilaksanakan dengan penuh tanggung jawab dan amanah.
					</p>
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
					</table>";
			
			
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