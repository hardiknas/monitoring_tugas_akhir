<?php
session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
date_default_timezone_set("Asia/Makassar");

include "../config/koneksi.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_thumb.php";
include "../config/fungsiku.php";
include '../config/konfigurasi.php';

if (empty($_SESSION['sesId'])){
	echo "<script>window.close();</script>";
}

else{
	require ("html2pdf/html2pdf.class.php");
	$filename="Laporan Tugas Akhir Yang Baru Terdaftar.pdf";
	$content = ob_get_clean();
	$year = date('Y');
	$month = date('m');
	$date = date('d');
	$now = date('Y-m-d');
	$date_now = getTglIndo($now);

	$content = "
				<small>Tanggal Print : $date_now</small>
				<hr>
				<table border='0' style='margin:10px 50px 50px 50px;'>
					<tr valign='middle'>
						<td><img src='$_CONFIG[syskop]' height='$_CONFIG[tinggikop]'></td>
						<td width='20'></td>
						<td>
							SISTEM MONITORING UJIAN FAKULTAS HUKUM<br>
							<h1>UNIVERSITAS DARUSSALAM AMBON</h1>
							Alamat : $_CONFIG[owneraddress] - $_CONFIG[ownercity] $_CONFIG[ownerpostalcode]<br>
							Telp. $_CONFIG[ownertelp] | Fax. $_CONFIG[ownerfax]	| Email : $_CONFIG[owneremail]
						</td>
					</tr>
				</table>
				<hr>
				<br><p align='center'><b><u>LAPORAN TUGAS AKHIR MAHASISWA YANG BARU TERDAFTAR</u></b></p>
				<br>

				<br>
				<table cellpadding='0' border='0' cellspacing='0' align='center'>
					<tr>
						<th align='center' width='15' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>No</th>
						<th align='center' width='80' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>NIM</th>
						<th align='center' width='200' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>Nama</th>
						<th align='center' width='400' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>Judul</th>
						<th align='center' width='100' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>Tanggal Daftar</th>
						<th align='center' width='40' style='border:1px solid #000; background-color: $_CONFIG[syscolor]; padding: 4px;'>Tahun</th>
					</tr>
			";
			$no = 0;
			
			$query = mysql_query("SELECT a.*,b.* FROM skripsi a
		 							  LEFT JOIN mahasiswa b ON a.mNim=b.mNim
		 							  WHERE a.sStatus='0' ORDER BY a.sId ASC");
			
			while ($d = mysql_fetch_array($query)){
				$no++;
				$tgl = getTglIndo($d[sTgl]);
	      	$thn = $d[sTahun];
				$content .= "<tr>
									<td style='border:1px solid #000; padding: 4px;' align='center' width='15'>$no</td>
									<td style='border:1px solid #000; padding: 4px;' align='center' width='80'>$d[mNim]</td>
									<td style='border:1px solid #000; padding: 4px;' width='200'>$d[mNama]</td>
									<td style='border:1px solid #000; padding: 4px;' width='400'>$d[sJudul]</td>
									<td style='border:1px solid #000; padding: 4px;' align='center'>$tgl</td>
									<td style='border:1px solid #000; padding: 4px;' align='center'>$thn</td>
								</tr>";
			}			
			$content .= "
					</table>
					<br>
					<table>
						<tr>
							<td width='700'></td>
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
		$html2pdf = new HTML2PDF('L','A4','fr', false, 'ISO-8859-15',array(10, 10, 10, 10)); //setting ukuran kertas dan margin pada dokumen anda
		// $html2pdf->setModeDebug();
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
}
?>