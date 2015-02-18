<?php
if ($_GET['act']=='dtl'){
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
	$kpage = "konsul&act=dtl&kid=$kid";
	$jnkomen = getNumRows("SELECT kkId FROM komentar WHERE kkOleh!='$_SESSION[uId]' AND kkBaca='0' AND kId='$kid'");
	if ($jnkomen>0){
		mysql_query("UPDATE komentar SET kkBaca='1' WHERE kkOleh!='$_SESSION[uId]' AND kId='$kid'");
		echo "<script>setTimeout('window.location.href=\"media.php?page=$kpage\"',100)</script>";	
	}
?>
	<div class="row-fluid">
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
			<a href="media.php?page=konsul" class="btn btn-small btn-block">
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
	</div>

<?php
}else{
	$uid = $_SESSION['uId'];
	$dsk = mysql_fetch_array(mysql_query("SELECT * FROM skripsi WHERE mNim='$uid' AND sStatus='2'"));
	$pem1 = getValue("nama_lengkap","dosen","id_dosen='$dsk[sPem1]'");
	$pem2 = getValue("nama_lengkap","dosen","id_dosen='$dsk[sPem2]'");
	$sid = $dsk['sId'];
	$spem1 = $dsk['sPem1'];
	$spem2 = $dsk['sPem2'];
	$npage = $_GET['page'];
?>
<div class="page-header">
	<div class="alert alert-block alert-success">
		<p>
			<strong><?php echo $dsk['sJudul']?></strong><br><br>
			Pembimbing I : <?php echo $pem1;?><br>
			Pembimbing II : <?php echo $pem2;?>
		</p>
	</div>
</div>
<div class="row-fluid">
<div class="span12">
	<div class="span4">
		<div class="widget-box">
			<div class="widget-header">
				<h4>Konsultasi</h4>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<form method="POST" enctype="multipart/form-data">
						<input type="hidden" name="sid" value="<?php echo $sid;?>">
						<fieldset>
							<label>Berkas File</label>
							<input type="file" id="myFile" name="fupload" required/>
							<label>Pembimbing</label>
							<select class="chosen-select" name="pem" id="pem">
								<?php
									echo "<option value='$spem1'>$pem1</option>";
									echo "<option value='$spem2'>$pem2</option>";
								?>
							</select>
						</fieldset>
						<fieldset>
							<label>Keterangan</label>
							<textarea name="ket" class="autosize-transition span12"></textarea>
						</fieldset>
						<div class="form-actions center">
							<button type="submit" name="kirim" class="btn btn-small btn-primary">
								Kirim	<i class="icon-arrow-right icon-on-right bigger-110"></i>
							</button>
						</div>
					</form>
					<?php
						$tgls = date('Y-m-d');
						if (isset($_POST['kirim'])){
							$lokasi_file    = $_FILES['fupload']['tmp_name'];
					  		$tipe_file      = $_FILES['fupload']['type'];
					  		$nama_file      = $_FILES['fupload']['name'];
					  		$acak           = rand(1,99);
					  		$file = $acak.$nama_file;
							UploadFile($file);

							$q = mysql_query("INSERT INTO konsultasi (sId,dosId,
																					kFile,kKet)
												  				VALUES ('$_POST[sid]','$_POST[pem]',
												  						  '$file','$_POST[ket]')");

							if ($q){
								echo "<script>
								 		notifsukses('Success','Data Tersimpan..!!');
								  		setTimeout('window.location.href=\"media.php?page=$npage\"', 2000)
								      </script>";
							}else{
								echo "<script>
								      notiferror('Failed','Data Gagal Tersimpan..!!');
								  		setTimeout('window.location.href=\"media.php?page=$npage\"', 2000)
								      </script>";
							}
						}
						?>
				</div>
			</div>
		</div>
	</div>
	<div class="span8">
		<div class="table-header">
		   RIWAYAT KONSULTASI
		</div>
		<div class="row-fluid">
		<table id="myTable" class="table table-striped table-bordered table-hover">
		<thead>
		    <tr>
		    <th class="center" width="40px">No</th>
		    <th class="center" width="150px">Tanggal</th>
		    <th class="center" width="150px">Status</th>
		    <th class="center">File</th>
		    <th class="center">Detail</th>
		    </tr>
		</thead>
		<tbody>
		 <?php
		 	$qry = mysql_query("SELECT a.* FROM konsultasi a
		 							  WHERE a.sId='$sid' ORDER BY a.kId DESC");
			while ($d = mysql_fetch_array($qry)){
		      ?>
		      <tr>
		      <?php
		      $no++;
		      $arSt = array(
		      	"0" => "<span class='badge badge-warning'>Belum Diperiksa</span>",
		      	"1" => "<span class='badge badge-success'>Sudah Diperiksa</span>",
		      );
		      $kid=$d['kId'];
		      $st = $d['kBaca'];
		      $status = $arSt[$st];
		      $ktgl = getTglIndo(substr($d['kWaktu'], 0,10));

		      $jnkomen = getNumRows("SELECT kkId FROM komentar WHERE kkOleh!='$_SESSION[uId]' AND kkBaca='0' AND kId='$kid'");
				if ($jnkomen>0){
					$jkom = "<a href='?page=$npage&act=dtl&kid=$kid' data-rel='tooltip' data-placement='top' data-original-title='$jnkomen Komentar Baru' class='btn btn-mini btn-primary'>
									$jnkomen <i class='icon-comments bigger-120'></i>
								</a>";
				}else{
					$jkom = "<a href='?page=$npage&act=dtl&kid=$kid' class='btn btn-mini btn-primary'>
			                  <i class='icon-comments bigger-120'></i>
			               </a>";
				}

		      echo "
		      <td class='center'>$no</td>
		      <td class='center'>$ktgl</td>
		      <td class='center'>$status</td>
		      <td class='center'>
		      	<a href='file/$d[kFile]' target='_blank' class='btn btn-mini btn-inverse' data-rel='tooltip' data-placement='top' data-title='Klik Untuk Melihat Berkas'>
			         <i class='icon-cloud-download bigger-120'></i>
			      </a>
		      </td>
		      <td class='center'>
		      	$jkom
		      </td>";
		      ?>
		     </tr>
		   <?php
		   }
		   ?>
		</tbody>
		</table>
		</div>
	</div>
</div><!--span12-->
</div>
<?php
}
?>