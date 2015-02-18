<?php
	$hari_s = getHari(date("w"));
	echo "
	<h1 class='page-header'>SELAMAT DATANG</h1>
	<p>Hai <b>$_SESSION[uNama]</b>, selamat datang di halaman Sistem Monitoring Ujian Akhir.<br> Silahkan klik menu pilihan yang berada 
	di sebelah kiri untuk mengelola akun anda. </p>
	<p>&nbsp;</p>
	<p>Login : $hari_s, ".getTglIndo(date('Y m d'))." | ".date('H:i:s')." WITA</p><hr>";



	if ($_SESSION['uLevel']==3){
		$qujian = mysql_fetch_array(mysql_query("SELECT * FROM skripsi WHERE mNim='$_SESSION[uId]'"));
		if ($qujian['sStatus']=='2'){
			$jp = getData("*","ujian_proposal","sId='$qujian[sId]'");
			$jh = getData("*","ujian_hasil","sId='$qujian[sId]'");
			$jm = getData("*","ujian_meja","sId='$qujian[sId]'");

			if (isset($jp['sId'])){
				$mjp = "<b>Tanggal : </b>".getTglIndo($jp['sTgl'])."<br>
						  <b>Jam : </b>$jp[sJam]<br>
						  <b>Tempat : </b>$jp[sT4]<br>
						  <b>Penguji 1 : </b>".getValue("nama_lengkap","dosen","id_dosen='$jp[sPenguji1]'")."<br>
						  <b>Penguji 2 : </b>".getValue("nama_lengkap","dosen","id_dosen='$jp[sPenguji2]'")."<br>
						  <b>Penguji 3 : </b>".getValue("nama_lengkap","dosen","id_dosen='$jp[sPenguji3]'")."<br>";
			}else{
				$mjp = "<div class='alert alert-error'>Belum Ditentukan</div>";
			}

			if (isset($jh['sId'])){
				$mjh = "<b>Tanggal : </b>".getTglIndo($jh['sTgl'])."<br>
						  <b>Jam : </b>$jh[sJam]<br>
						  <b>Tempat : </b>$jh[sT4]<br>
						  <b>Penguji 1 : </b>".getValue("nama_lengkap","dosen","id_dosen='$jh[sPenguji1]'")."<br>
						  <b>Penguji 2 : </b>".getValue("nama_lengkap","dosen","id_dosen='$jh[sPenguji2]'")."<br>
						  <b>Penguji 3 : </b>".getValue("nama_lengkap","dosen","id_dosen='$jh[sPenguji3]'")."<br>";
			}else{
				$mjh = "<div class='alert alert-error'>Belum Ditentukan</div>";
			}

			if (isset($jm['sId'])){
				$mjm = "<b>Tanggal : </b>".getTglIndo($jm['sTgl'])."<br>
						  <b>Jam : </b>$jm[sJam]<br>
						  <b>Tempat : </b>$jm[sT4]<br>
						  <b>Penguji 1 : </b>".getValue("nama_lengkap","dosen","id_dosen='$jm[sPenguji1]'")."<br>
						  <b>Penguji 2 : </b>".getValue("nama_lengkap","dosen","id_dosen='$jm[sPenguji2]'")."<br>
						  <b>Penguji 3 : </b>".getValue("nama_lengkap","dosen","id_dosen='$jm[sPenguji3]'")."<br>";
			}else{
				$mjm = "<div class='alert alert-error'>Belum Ditentukan</div>";
			}
			?>
			<div class="row-fluid">
				<div class="span4">
					<div class="widget-box light-border">
						<div class="widget-header header-color-dark"><h5 class="smaller">Jadwal Seminar Proposal</h5></div>
						<div class="widget-body">
							<div class="widget-main padding-6">
								<?php echo $mjp;?>
							</div>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="widget-box light-border">
						<div class="widget-header header-color-dark"><h5 class="smaller">Jadwal Ujian Hasil</h5></div>
						<div class="widget-body">
							<div class="widget-main padding-6">
								<?php echo $mjh;?>
							</div>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="widget-box light-border">
						<div class="widget-header header-color-dark"><h5 class="smaller">Jadwal Ujian Meja</h5></div>
						<div class="widget-body">
							<div class="widget-main padding-6">
								<?php echo $mjm;?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="space-8"></div>
			<?php
		}
		include 'mod/mahasiswa/judul.php';
	}elseif ($_SESSION['uLevel']=='2'){
		if ($_GET['mode']=='baca'){
			mysql_query("UPDATE konsultasi SET kBaca='1'");
			echo "<script>
					setTimeout('window.location.href=\"media.php?page=bimbingan\"',100)
					</script>";
		}
		
		$jdkomen = getNumRows("SELECT a.kkId,b.kId FROM komentar a 
									  LEFT JOIN konsultasi b ON a.kId=b.kId
									  WHERE a.kkOleh!='$_SESSION[uId]' AND a.kkBaca='0' AND b.dosId='$_SESSION[uId]'");
		if ($jdkomen>0){
			$jdkon = "<div class='alert alert-block alert-success'>
							<p>
								<strong>
								<i class='icon-comments'></i>
								Anda memiliki $jdkomen pesan baru
								</strong>
							</p>
							<p>
								<a href='media.php?page=bimbingan' class='btn btn-small btn-success'>Lihat Pesan</a>
							</p>
						</div>";
			//$jkon = "<span data-rel='tooltip' data-placement='right' data-original-title='$jnkonsul Konsultasi Belum Diperiksa' class='badge badge-info'>
							//$jnkonsul
						//</span>";
		}else{
			$jdkon = "";
		}
		echo $jdkon;
  		?>
		<div class="table-header">
		   DAFTAR KONSULTASI MAHASISWA YANG BELUM DIPERIKSA
		</div>
		<div class="row-fluid">
		<table id="myTable" class="table table-striped table-bordered table-hover">
		<thead>
		    <tr>
		    <th class="center" width="30px">No</th>
		    <th class="center" width="80px">NIM</th>
		    <th class="center" width="150px">Nama</th>
		    <th class="center" width="110px">Tanggal</th>
		    <th class="center">Judul</th>
		    <th class="center" width="50px">File</th>
		    <th class="center" width="50px">Cek</th>
		    <th class="center" width="80px">Komentar</th>
		    </tr>
		</thead>
		<tbody>
		 <?php
		 	$qry = mysql_query("SELECT a.*,b.sJudul,b.mNim FROM konsultasi a
		 							  LEFT JOIN skripsi b ON a.sId=b.sId
		 							  WHERE a.dosId='$_SESSION[uId]' AND a.kBaca='0' ORDER BY a.kId DESC");
			while ($d = mysql_fetch_array($qry)){
		      $no++;
		      $arSt = array(
		      	"0" => "<span class='badge badge-warning'>Belum Diperiksa</span>",
		      	"1" => "<span class='badge badge-success'>Sudah Diperiksa</span>",
		      );
		      $mnama = getValue("mNama","mahasiswa","mNim='$d[mNim]'");
		      $kid=$d['kId'];
		      $st = $d['kBaca'];
		      $status = $arSt[$st];
		      $ktgl = getTglIndo(substr($d['kWaktu'], 0,10));
		      if ($d['kBaca']=='0'){
		      	$baca = "<a href='?page=home&mode=baca&kid=$kid' class='btn btn-mini btn-danger' data-rel='tooltip' data-placement='top' data-title='Klik Untuk Menandai Bahwa Berkas Sudah Diperiksa'>
			                  <i class='icon-check-empty bigger-120'></i>
			               </a>";
		      }else{
		      	$baca = "<a href='#' class='btn btn-mini btn-success' data-rel='tooltip' data-placement='top' data-title='Berkas Sudah Diperiksa'>
			                  <i class='icon-check bigger-120'></i>
			               </a>";
		      }
		      echo "
		      <tr>
		      <td class='center'>$no</td>
		      <td class='center'>$d[mNim]</td>
		      <td>$mnama</td>
		      <td class='center'>$ktgl</td>
		      <td>$d[sJudul]</td>
		      <td class='center'>
		      	<a href='file/$d[kFile]' target='_blank' class='btn btn-mini btn-inverse' data-rel='tooltip' data-placement='top' data-title='Klik Untuk Melihat Berkas'>
			         <i class='icon-cloud-download bigger-120'></i>
			      </a>
		      </td>
		      <td class='center'>
		      	$baca
		      </td>
		      <td class='center'>
		      	<a href='?page=$npage&act=komentar&kid=$kid' class='btn btn-mini btn-primary'>
                  <i class='icon-comments bigger-120'></i>
               </a>
		      </td>
		      </tr>";
		   }
		   ?>
		</tbody>
		</table>
		</div>
		<?php
	}
?>