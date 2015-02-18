<?php
 $npage = $_GET['page'];
?>
<div class="row-fluid">
<div class="span12">
<?php
	if ($_GET['act']=='komentar'){
		$kid = $_GET['kid'];
		$fk = mysql_fetch_array(mysql_query("SELECT * FROM konsultasi WHERE kId='$kid'"));
		$nimk = getValue("mNim","skripsi","sId='$fk[sId]'");
		$tglk = "Pada ".getTglIndo(substr($fk['kWaktu'], 0,10))." | Jam : ".substr($fk['kWaktu'], 11,8);
		$mhsk = getValue("mNama","mahasiswa","mNim='$nimk'");
		$ffoto = getValue("mFoto","mahasiswa","mNim='$nimk'");
		if (empty($ffoto)){
			$fotok = "images/photo.jpg";
		}else{
			$fotok = "foto_mhs/$ffoto";
		}
		$fberkas = $fk['kFile'];
		$berkas = "<a href='file/$fberkas'>Download Berkas Konsultasi</a>";
		$kpage = "bimbingan&act=komentar&kid=$kid";
		$jnkomen = getNumRows("SELECT kkId FROM komentar WHERE kkOleh!='$_SESSION[uId]' AND kkBaca='0' AND kId='$kid'");
		if ($jnkomen>0){
			mysql_query("UPDATE komentar SET kkBaca='1' WHERE kkOleh!='$_SESSION[uId]' AND kId='$kid'");
			echo "<script>setTimeout('window.location.href=\"media.php?page=$kpage\"',100)</script>";	
		}
	?>
		<div class="offset1 span10">
			<div class="timeline-container">
				<div class="timeline-label">
					<span class="label label-primary arrowed-in-right label-large">
						<b>Riwayat Konsultasi</b>
					</span>
				</div>
				
				<div class="timeline-items">
					<div class="timeline-item clearfix">
						<div class="timeline-info">
							<img alt="<?php echo $nimk;?>" src="<?php echo $fotok;?>" />
						</div>
						<div class="widget-box transparent">
							<div class="widget-header widget-header-small">
								<h5 class="smaller">
									<?php echo $mhsk;?>
								</h5>
								<span class="widget-toolbar no-border">
									<i class="icon-calendar bigger-110"></i>
									<?php echo $tglk;?>
								</span>
							</div>
							<div class="widget-body">
								<div class="widget-main">
									<?php echo $berkas;?><br>
									<?php echo $fk['kKet'];?>
									<div class="space-6"></div>									
								</div>
							</div>
						</div>
					</div>					
				</div><!--/.timeline-items-->
				<?php
				$qkomen = mysql_query("SELECT * FROM komentar WHERE kId='$kid' ORDER BY kkId ASC");
				while ($dk = mysql_fetch_array($qkomen)){
					if ($dk['kkLevel']==2){
						$konama = getValue("nama_lengkap","dosen","id_dosen='$dk[kkOleh]'");
						$kfoto = getValue("foto","dosen","id_dosen='$dk[kkOleh]'");
						if (empty($kfoto)){
							$kofoto = "images/photo.jpg";
						}else{
							$kofoto = "foto_dosen/$kfoto";
						}
					}elseif($dk['kkLevel']=='3'){
						$konama = getValue("mNama","mahasiswa","mNim='$dk[kkOleh]'");
						$kfoto = getValue("mFoto","mahasiswa","mNim='$dk[kkOleh]'");
						if (empty($kfoto)){
							$kofoto = "images/photo.jpg";
						}else{
							$kofoto = "foto_mhs/$kfoto";
						}
					}
					$kotgl = "Pada ".getTglIndo(substr($dk['kkWaktu'], 0,10))." | Jam : ".substr($dk['kkWaktu'], 11,8);					
					?>
					<div class="timeline-items">
						<div class="timeline-item clearfix">
							<div class="timeline-info">
								<img alt="<?php echo $konama;?>" src="<?php echo $kofoto;?>" />
							</div>
							<div class="widget-box transparent">
								<div class="widget-header widget-header-small">
									<h5 class="smaller">
										<?php echo $konama;?>
									</h5>
									<span class="widget-toolbar no-border">
										<i class="icon-calendar bigger-110"></i>
										<?php echo $kotgl;?>
									</span>
								</div>
								<div class="widget-body">
									<div class="widget-main">
										<?php echo $dk['kkPesan'];?>
										<div class="space-6"></div>									
									</div>
								</div>
							</div>
						</div>					
					</div><!--/.timeline-items-->
					<?php
				}
				?>
				
			</div><!--/.timeline-container-->
			<a href="media.php?page=bimbingan" class="btn btn-small btn-block">
				<i class="icon-reply bigger-110"></i> Kembali
			</a>
			<div class="widget-box">
			<div class="widget-header">
				<h4>Komentar</h4>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<form method="POST">
						<input type="hidden" name="kid" value="<?php echo $kid;?>">
						<fieldset>
							<textarea name="pesan" class="autosize-transition span12"></textarea>
						</fieldset>
						<div class="form-actions center">
							<button type="submit" name="komentar" class="btn btn-small btn-primary">
								Kirim	<i class="icon-arrow-right icon-on-right bigger-110"></i>
							</button>
						</div>
					</form>
					<?php
						if (isset($_POST[komentar])){
							$q = mysql_query("INSERT INTO komentar (kId,kkLevel,kkOleh,
																				 kkPesan)
												  				VALUES ('$_POST[kid]','$_SESSION[uLevel]','$_SESSION[uId]',
												  						  '$_POST[pesan]')");

							if ($q){
								echo "<script>
								 		notifsukses('Success','Komentar terkirim..!!');
								  		setTimeout('window.location.href=\"media.php?page=$kpage\"', 2000)
								      </script>";
							}else{
								echo "<script>
								      notiferror('Failed','Komentar Gagal Terkirim..!!');
								  		setTimeout('window.location.href=\"media.php?page=$kpage\"', 2000)
								      </script>";
							}
						}
						?>
				</div>
			</div>
			</div>
		</div>
	<?php
	}else{
		if ($_GET['mode']=='baca'){
			mysql_query("UPDATE konsultasi SET kBaca='1' WHERE kId='$_GET[kid]'");
			echo "<script>
					setTimeout('window.location.href=\"media.php?page=$npage\"',100)
					</script>";
		}
		?>
		<div class="table-header">
		   DAFTAR KONSULTASI MAHASISWA
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
		 							  WHERE a.dosId='$_SESSION[uId]' ORDER BY a.kId DESC");
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
		      	$baca = "<a href='?page=$npage&mode=baca&kid=$kid' class='btn btn-mini btn-danger' data-rel='tooltip' data-placement='top' data-title='Klik Untuk Menandai Bahwa Berkas Sudah Diperiksa'>
			                  <i class='icon-check-empty bigger-120'></i>
			               </a>";
		      }else{
		      	$baca = "<a href='#' class='btn btn-mini btn-success' data-rel='tooltip' data-placement='top' data-title='Berkas Sudah Diperiksa'>
			                  <i class='icon-check bigger-120'></i>
			               </a>";
		      }

		      $jnkomen = getNumRows("SELECT kkId FROM komentar WHERE kkOleh!='$_SESSION[uId]' AND kkBaca='0' AND kId='$kid'");
				if ($jnkomen>0){
					$jkom = "<a href='?page=$npage&act=komentar&kid=$kid' data-rel='tooltip' data-placement='top' data-original-title='$jnkomen Komentar Baru' class='btn btn-mini btn-primary'>
									$jnkomen <i class='icon-comments bigger-120'></i>
								</a>";
				}else{
					$jkom = "<a href='?page=$npage&act=komentar&kid=$kid' class='btn btn-mini btn-primary'>
			                  <i class='icon-comments bigger-120'></i>
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
		      	$jkom
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
</div>
</div>