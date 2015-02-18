<?php
	$page = $_GET['page'];
	$thn = $_SESSION['sesPeriode'];
	$qsp = $_SESSION['sesQSP'];
	$quh = $_SESSION['sesQUH'];
	$qum = $_SESSION['sesQUM'];
?>
<div class="row-fluid">
<div class="span12">
<?php
if($_GET[act]=="sp"){
	$e = mysql_fetch_array(mysql_query("SELECT a.*,b.sTahun,b.sTgl,b.sJam,b.sT4,b.sNoSK,b.sPenguji1,b.sPenguji2,b.sPenguji3,
														c.mNama FROM skripsi a
														LEFT JOIN ujian_proposal b ON a.sId=b.sId AND a.mNim=b.mNim
														LEFT JOIN mahasiswa c ON a.mNim=c.mNim
														WHERE a.sId='$_GET[id]'"));
	$csp = getJumlah("ujian_proposal","WHERE sTahun='$thn'");
	if (($csp<$qsp)||(isset($e['sTgl']))){
		?>
		<div class="widget-box">
		<div class="widget-header widget-header-flat"><h2 class="smaller">Jadwal Seminar Proposal</h2></div>
		<div class="widget-body">
		<div class="widget-main">
			<!-- FORM -->
			<form method="POST" enctype="multipart/form-data" class="form-horizontal">
				<input type="hidden" name="id" value="<?php echo $e['sId'];?>">
				<div class="control-group">
					<label class="control-label" for="nim">NIM</label>
					<div class="controls">
						<input class="input-large" type="text" id="nim" name="nim" value="<?php echo $e[mNim];?>" readonly required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="nama">Nama</label>
					<div class="controls">
						<input class="input-xlarge" type="text" id="nama" name="nama" value="<?php echo $e[mNama];?>" readonly required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="judul">Judul</label>
					<div class="controls">
						<textarea style="width: 70%; height: 50px;" readonly><?php echo $e['sJudul'];?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="tgl">Tanggal</label>
					<div class="controls">
						<div class="input-append">
							<input class="input-medium date-picker" id="tgl" name="tgl" type="text" data-date-format="yyyy-mm-dd" value="<?php echo $e[sTgl];?>" placeholder="Tanggal" required />
							<span class="add-on"><i class="icon-calendar"></i></span>
						</div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="jam">Jam</label>
					<div class="controls">
						<div class="input-append">
							<input class="input-mini" id="jam" name="jam" type="text" value="<?php echo $e[sJam];?>" placeholder="00:00" required />
							<span class="add-on"><i class="icon-time"></i></span>
						</div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="t4">Tempat</label>
					<div class="controls">
						<input class="input-xlarge" type="text" id="t4" name="t4" value="<?php echo $e[sT4];?>" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="nosk">No. SK</label>
					<div class="controls">
						<input class="input-large" type="text" id="nosk" name="nosk" value="<?php echo $e[sNoSK];?>" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="p1">Penguji 1</label>
					<div class="controls">
						<select class="span4 chosen-select" name="p1" id="p1">
							<option></option>
							<?php
								$qsp = mysql_query("SELECT id_dosen,nama_lengkap FROM dosen");
								while ($s=mysql_fetch_array($qsp)) {
									if ($e['sPenguji1']==$s['id_dosen']){
										echo "<option value='$s[id_dosen]' selected>$s[nama_lengkap]</option>";	
									}else{
										echo "<option value='$s[id_dosen]'>$s[nama_lengkap]</option>";	
									}
								}
							?>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="p2">Penguji 2</label>
					<div class="controls">
						<select class="span4 chosen-select" name="p2" id="p2">
							<option></option>
							<?php
								$qsp = mysql_query("SELECT id_dosen,nama_lengkap FROM dosen");
								while ($s=mysql_fetch_array($qsp)) {
									if ($e['sPenguji2']==$s['id_dosen']){
										echo "<option value='$s[id_dosen]' selected>$s[nama_lengkap]</option>";	
									}else{
										echo "<option value='$s[id_dosen]'>$s[nama_lengkap]</option>";	
									}
								}
							?>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="p3">Penguji 3</label>
					<div class="controls">
						<select class="span4 chosen-select" name="p3" id="p3">
							<option></option>
							<?php
								$qsp = mysql_query("SELECT id_dosen,nama_lengkap FROM dosen");
								while ($s=mysql_fetch_array($qsp)) {
									if ($e['sPenguji3']==$s['id_dosen']){
										echo "<option value='$s[id_dosen]' selected>$s[nama_lengkap]</option>";	
									}else{
										echo "<option value='$s[id_dosen]'>$s[nama_lengkap]</option>";	
									}
								}
							?>
						</select>
					</div>
				</div>
				<div class="form-actions">
					<button class="btn btn-info" type="submit" name="simpan">
						<i class="icon-save bigger-110"></i>Simpan
					</button>
					<a class="btn" href="media.php?page=<?php echo $_GET[page];?>">
						<i class="icon-undo bigger-110"></i>Batal
					</a>
				</div>
			</form>
			<!-- FORM -->
			<?php
			if (isset($_POST[simpan])){
				$thn = $_SESSION['sesPeriode'];
				$q= mysql_query("INSERT INTO ujian_proposal (sId,mNim,sTahun,
																			sTgl,sJam,sT4,sNoSK,
																			sPenguji1,sPenguji2,sPenguji3) 
																VALUES ('$_POST[id]','$_POST[nim]','$thn',
																		  '$_POST[tgl]','$_POST[jam]','$_POST[t4]','$_POST[nosk]',
																		  '$_POST[p1]','$_POST[p2]','$_POST[p3]')
										ON DUPLICATE KEY UPDATE mNim='$_POST[nim]',sTahun='$thn',
																		sTgl='$_POST[tgl]',sJam='$_POST[jam]',sT4='$_POST[t4]',sNoSK='$_POST[nosk]',
																		sPenguji1='$_POST[p1]',sPenguji2='$_POST[p2]',sPenguji3='$_POST[p3]'");
				

				if ($q){
					echo "<script>
					 		notifsukses('Success','Data Tersimpan..!!');
					  		setTimeout('window.location.href=\"media.php?page=$page\"', 2000)
					      </script>";
				}else{
					echo "<script>
					      notiferror('Failed','Data Gagal Tersimpan..!!');
					  		setTimeout(function() { history.go(-1); }, 2000);
					      </script>";
				}
			}
			?>
		</div>
		</div>
		</div>
		<?php
	}else{
		?>
		<div class="error-container">
			<div class="well">
				<h1 class="grey lighter smaller">
					<center>
					<span class="blue bigger-125">
						Kuota Seminar Proposal Untuk Periode <?php echo $thn;?> Hanya Sebatas <?php echo $csp;?> Orang
					</span>
					<hr>
					<?php echo $_CONFIG['appname'];?>
					</center>
				</h1>
				<hr />
				<div class="row-fluid">
					<div class="center">
						<a href="javascript:self.history.back();" class="btn btn-grey">
							<i class="icon-arrow-left"></i>
							Kembali
						</a>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}elseif ($_GET[act]=="uh"){
	$e = mysql_fetch_array(mysql_query("SELECT a.*,b.sTahun,b.sTgl,b.sJam,b.sT4,b.sNoSK,b.sPenguji1,b.sPenguji2,b.sPenguji3,
														c.mNama FROM skripsi a
														LEFT JOIN ujian_hasil b ON a.sId=b.sId AND a.mNim=b.mNim
														LEFT JOIN mahasiswa c ON a.mNim=c.mNim
														WHERE a.sId='$_GET[id]'"));
	$cuh = getJumlah("ujian_hasil","WHERE sTahun='$thn'");
	if (($cuh<$quh)||(isset($e['sTgl']))){
		?>
		<div class="widget-box">
		<div class="widget-header widget-header-flat"><h2 class="smaller">Jadwal Ujian Hasil</h2></div>
		<div class="widget-body">
		<div class="widget-main">
			<!-- FORM -->
			<form method="POST" enctype="multipart/form-data" class="form-horizontal">
				<input type="hidden" name="id" value="<?php echo $e['sId'];?>">
				<div class="control-group">
					<label class="control-label" for="nim">NIM</label>
					<div class="controls">
						<input class="input-large" type="text" id="nim" name="nim" value="<?php echo $e[mNim];?>" readonly required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="nama">Nama</label>
					<div class="controls">
						<input class="input-xlarge" type="text" id="nama" name="nama" value="<?php echo $e[mNama];?>" readonly required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="judul">Judul</label>
					<div class="controls">
						<textarea style="width: 70%; height: 50px;" readonly><?php echo $e['sJudul'];?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="tgl">Tanggal</label>
					<div class="controls">
						<div class="input-append">
							<input class="input-medium date-picker" id="tgl" name="tgl" type="text" data-date-format="yyyy-mm-dd" value="<?php echo $e[sTgl];?>" placeholder="Tanggal" required />
							<span class="add-on"><i class="icon-calendar"></i></span>
						</div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="jam">Jam</label>
					<div class="controls">
						<div class="input-append">
							<input class="input-mini" id="jam" name="jam" type="text" value="<?php echo $e[sJam];?>" placeholder="00:00" required />
							<span class="add-on"><i class="icon-time"></i></span>
						</div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="t4">Tempat</label>
					<div class="controls">
						<input class="input-xlarge" type="text" id="t4" name="t4" value="<?php echo $e[sT4];?>" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="nosk">No. SK</label>
					<div class="controls">
						<input class="input-large" type="text" id="nosk" name="nosk" value="<?php echo $e[sNoSK];?>" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="p1">Penguji 1</label>
					<div class="controls">
						<select class="span4 chosen-select" name="p1" id="p1">
							<option></option>
							<?php
								$qsp = mysql_query("SELECT id_dosen,nama_lengkap FROM dosen");
								while ($s=mysql_fetch_array($qsp)) {
									if ($e['sPenguji1']==$s['id_dosen']){
										echo "<option value='$s[id_dosen]' selected>$s[nama_lengkap]</option>";	
									}else{
										echo "<option value='$s[id_dosen]'>$s[nama_lengkap]</option>";	
									}
								}
							?>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="p2">Penguji 2</label>
					<div class="controls">
						<select class="span4 chosen-select" name="p2" id="p2">
							<option></option>
							<?php
								$qsp = mysql_query("SELECT id_dosen,nama_lengkap FROM dosen");
								while ($s=mysql_fetch_array($qsp)) {
									if ($e['sPenguji2']==$s['id_dosen']){
										echo "<option value='$s[id_dosen]' selected>$s[nama_lengkap]</option>";	
									}else{
										echo "<option value='$s[id_dosen]'>$s[nama_lengkap]</option>";	
									}
								}
							?>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="p3">Penguji 3</label>
					<div class="controls">
						<select class="span4 chosen-select" name="p3" id="p3">
							<option></option>
							<?php
								$qsp = mysql_query("SELECT id_dosen,nama_lengkap FROM dosen");
								while ($s=mysql_fetch_array($qsp)) {
									if ($e['sPenguji3']==$s['id_dosen']){
										echo "<option value='$s[id_dosen]' selected>$s[nama_lengkap]</option>";	
									}else{
										echo "<option value='$s[id_dosen]'>$s[nama_lengkap]</option>";	
									}
								}
							?>
						</select>
					</div>
				</div>
				<div class="form-actions">
					<button class="btn btn-info" type="submit" name="simpan">
						<i class="icon-save bigger-110"></i>Simpan
					</button>
					<a class="btn" href="media.php?page=<?php echo $_GET[page];?>">
						<i class="icon-undo bigger-110"></i>Batal
					</a>
				</div>
			</form>
			<!-- FORM -->
			<?php
			if (isset($_POST[simpan])){
				$thn = $_SESSION['sesPeriode'];
				$q= mysql_query("INSERT INTO ujian_hasil (sId,mNim,sTahun,
																			sTgl,sJam,sT4,sNoSK,
																			sPenguji1,sPenguji2,sPenguji3) 
																VALUES ('$_POST[id]','$_POST[nim]','$thn',
																		  '$_POST[tgl]','$_POST[jam]','$_POST[t4]','$_POST[nosk]',
																		  '$_POST[p1]','$_POST[p2]','$_POST[p3]')
										ON DUPLICATE KEY UPDATE mNim='$_POST[nim]',sTahun='$thn',
																		sTgl='$_POST[tgl]',sJam='$_POST[jam]',sT4='$_POST[t4]',sNoSK='$_POST[nosk]',
																		sPenguji1='$_POST[p1]',sPenguji2='$_POST[p2]',sPenguji3='$_POST[p3]'");
				

				if ($q){
					echo "<script>
					 		notifsukses('Success','Data Tersimpan..!!');
					  		setTimeout('window.location.href=\"media.php?page=$page\"', 2000)
					      </script>";
				}else{
					echo "<script>
					      notiferror('Failed','Data Gagal Tersimpan..!!');
					  		setTimeout(function() { history.go(-1); }, 2000);
					      </script>";
				}
			}
			?>
		</div>
		</div>
		</div>
		<?php
	}else{
		?>
		<div class="error-container">
			<div class="well">
				<h1 class="grey lighter smaller">
					<center>
					<span class="blue bigger-125">
						Kuota Ujian Hasil Untuk Periode <?php echo $thn;?> Hanya Sebatas <?php echo $cuh;?> Orang
					</span>
					<hr>
					<?php echo $_CONFIG['appname'];?>
					</center>
				</h1>
				<hr />
				<div class="row-fluid">
					<div class="center">
						<a href="javascript:self.history.back();" class="btn btn-grey">
							<i class="icon-arrow-left"></i>
							Kembali
						</a>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}elseif ($_GET[act]=="um"){
	$e = mysql_fetch_array(mysql_query("SELECT a.*,b.sTahun,b.sTgl,b.sJam,b.sT4,b.sNoSK,b.sPenguji1,b.sPenguji2,b.sPenguji3,
														c.mNama FROM skripsi a
														LEFT JOIN ujian_meja b ON a.sId=b.sId AND a.mNim=b.mNim
														LEFT JOIN mahasiswa c ON a.mNim=c.mNim
														WHERE a.sId='$_GET[id]'"));
	$cum = getJumlah("ujian_meja","WHERE sTahun='$thn'");
	if (($cum<$qum)||(isset($e['sTgl']))){
		?>
		<div class="widget-box">
		<div class="widget-header widget-header-flat"><h2 class="smaller">Jadwal Ujian Meja</h2></div>
		<div class="widget-body">
		<div class="widget-main">
			<!-- FORM -->
			<form method="POST" enctype="multipart/form-data" class="form-horizontal">
				<input type="hidden" name="id" value="<?php echo $e['sId'];?>">
				<div class="control-group">
					<label class="control-label" for="nim">NIM</label>
					<div class="controls">
						<input class="input-large" type="text" id="nim" name="nim" value="<?php echo $e[mNim];?>" readonly required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="nama">Nama</label>
					<div class="controls">
						<input class="input-xlarge" type="text" id="nama" name="nama" value="<?php echo $e[mNama];?>" readonly required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="judul">Judul</label>
					<div class="controls">
						<textarea style="width: 70%; height: 50px;" readonly><?php echo $e['sJudul'];?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="tgl">Tanggal</label>
					<div class="controls">
						<div class="input-append">
							<input class="input-medium date-picker" id="tgl" name="tgl" type="text" data-date-format="yyyy-mm-dd" value="<?php echo $e[sTgl];?>" placeholder="Tanggal" required />
							<span class="add-on"><i class="icon-calendar"></i></span>
						</div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="jam">Jam</label>
					<div class="controls">
						<div class="input-append">
							<input class="input-mini" id="jam" name="jam" type="text" value="<?php echo $e[sJam];?>" placeholder="00:00" required />
							<span class="add-on"><i class="icon-time"></i></span>
						</div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="t4">Tempat</label>
					<div class="controls">
						<input class="input-xlarge" type="text" id="t4" name="t4" value="<?php echo $e[sT4];?>" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="nosk">No. SK</label>
					<div class="controls">
						<input class="input-large" type="text" id="nosk" name="nosk" value="<?php echo $e[sNoSK];?>" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="p1">Penguji 1</label>
					<div class="controls">
						<select class="span4 chosen-select" name="p1" id="p1">
							<option></option>
							<?php
								$qsp = mysql_query("SELECT id_dosen,nama_lengkap FROM dosen");
								while ($s=mysql_fetch_array($qsp)) {
									if ($e['sPenguji1']==$s['id_dosen']){
										echo "<option value='$s[id_dosen]' selected>$s[nama_lengkap]</option>";	
									}else{
										echo "<option value='$s[id_dosen]'>$s[nama_lengkap]</option>";	
									}
								}
							?>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="p2">Penguji 2</label>
					<div class="controls">
						<select class="span4 chosen-select" name="p2" id="p2">
							<option></option>
							<?php
								$qsp = mysql_query("SELECT id_dosen,nama_lengkap FROM dosen");
								while ($s=mysql_fetch_array($qsp)) {
									if ($e['sPenguji2']==$s['id_dosen']){
										echo "<option value='$s[id_dosen]' selected>$s[nama_lengkap]</option>";	
									}else{
										echo "<option value='$s[id_dosen]'>$s[nama_lengkap]</option>";	
									}
								}
							?>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="p3">Penguji 3</label>
					<div class="controls">
						<select class="span4 chosen-select" name="p3" id="p3">
							<option></option>
							<?php
								$qsp = mysql_query("SELECT id_dosen,nama_lengkap FROM dosen");
								while ($s=mysql_fetch_array($qsp)) {
									if ($e['sPenguji3']==$s['id_dosen']){
										echo "<option value='$s[id_dosen]' selected>$s[nama_lengkap]</option>";	
									}else{
										echo "<option value='$s[id_dosen]'>$s[nama_lengkap]</option>";	
									}
								}
							?>
						</select>
					</div>
				</div>
				<div class="form-actions">
					<button class="btn btn-info" type="submit" name="simpan">
						<i class="icon-save bigger-110"></i>Simpan
					</button>
					<a class="btn" href="media.php?page=<?php echo $_GET[page];?>">
						<i class="icon-undo bigger-110"></i>Batal
					</a>
				</div>
			</form>
			<!-- FORM -->
			<?php
			if (isset($_POST[simpan])){
				$thn = $_SESSION['sesPeriode'];
				$q= mysql_query("INSERT INTO ujian_meja (sId,mNim,sTahun,
																			sTgl,sJam,sT4,sNoSK,
																			sPenguji1,sPenguji2,sPenguji3) 
																VALUES ('$_POST[id]','$_POST[nim]','$thn',
																		  '$_POST[tgl]','$_POST[jam]','$_POST[t4]','$_POST[nosk]',
																		  '$_POST[p1]','$_POST[p2]','$_POST[p3]')
										ON DUPLICATE KEY UPDATE mNim='$_POST[nim]',sTahun='$thn',
																		sTgl='$_POST[tgl]',sJam='$_POST[jam]',sT4='$_POST[t4]',sNoSK='$_POST[nosk]',
																		sPenguji1='$_POST[p1]',sPenguji2='$_POST[p2]',sPenguji3='$_POST[p3]'");

				if ($q){
					echo "<script>
					 		notifsukses('Success','Data Tersimpan..!!');
					  		setTimeout('window.location.href=\"media.php?page=$page\"', 2000)
					      </script>";
				}else{
					echo "<script>
					      notiferror('Failed','Data Gagal Tersimpan..!!');
					  		setTimeout(function() { history.go(-1); }, 2000);
					      </script>";
				}
			}
			?>
		</div>
		</div>
		</div>
		<?php
	}else{
		?>
		<div class="error-container">
			<div class="well">
				<h1 class="grey lighter smaller">
					<center>
					<span class="blue bigger-125">
						Kuota Ujian Meja Untuk Periode <?php echo $thn;?> Hanya Sebatas <?php echo $cum;?> Orang
					</span>
					<hr>
					<?php echo $_CONFIG['appname'];?>
					</center>
				</h1>
				<hr />
				<div class="row-fluid">
					<div class="center">
						<a href="javascript:self.history.back();" class="btn btn-grey">
							<i class="icon-arrow-left"></i>
							Kembali
						</a>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}else{
?>
	<div class="table-header">
	   JUDUL TUGAS AKHIR YANG DITERIMA
	</div>
	<div class="row-fluid">
	<table id="myTable" class="table table-striped table-bordered table-hover">
	<thead>
	    <tr>
	    <th class="center" width="40px">No</th>
	    <th class="center" width="80px">NIM</th>
	    <th class="center" width="150px">Nama</th>
	    <th class="center">Judul</th>
	    <th class="center" width="250px">Pembimbing</th>
	    <th class="center" width="90px">Jadwal Ujian</th>
	    <th class="center" width="60px">Cetak</th>
	    <th class="center" width="200px">Status</th>
	    </tr>
	</thead>
	<tbody>
	 <?php
	 	$qry = mysql_query("SELECT a.*,b.* FROM skripsi a
	 							  LEFT JOIN mahasiswa b ON a.mNim=b.mNim
	 							  WHERE a.sStatus='2' ORDER BY a.sId ASC");
		while ($d = mysql_fetch_array($qry)){
	      $no++;
	      $tgl = getTglIndo($d['sTgl']);
	      $thn = $d['sTahun'];
	      $pem1 = getValue("nama_lengkap","dosen","id_dosen='$d[sPem1]'");
	      $pem2 = getValue("nama_lengkap","dosen","id_dosen='$d[sPem2]'");
	      
	      $tgls = date("Y-m-d");
	      $cSP = getNumRows("SELECT * FROM ujian_proposal WHERE sId='$d[sId]' AND sTgl<='$tgls'");
	      $cUH = getNumRows("SELECT * FROM ujian_hasil WHERE sId='$d[sId]' AND sTgl<='$tgls'");
	      $cUM = getNumRows("SELECT * FROM ujian_meja WHERE sId='$d[sId]' AND sTgl<='$tgls'");

	      $arAlert = array(
	      	"0"=>"<span class='badge badge-warning'>Belum Ujian</span>",
	      	"1"=>"<span class='badge badge-success'>Sudah Ujian</span>"
	      );
	      $aSP = ($cSP>0 ? $arAlert["1"] : $arAlert["0"]);
	      $aUH = ($cUH>0 ? $arAlert["1"] : $arAlert["0"]);
	      $aUM = ($cUM>0 ? $arAlert["1"] : $arAlert["0"]);
	      echo "
	      <tr>
	      <td class='center'>$no</td>
	      <td class='center'>$d[mNim]</td>
	      <td>$d[mNama]</td>
	      <td>$d[sJudul]</td>
	      <td>
	      	No. SK : $d[sNoSKPembimbing]<br>
	      	Pembimbing I : $pem1<br>
	      	Pembimbing II : $pem2
	      </td>
	      <td class='center'>
	      	<div class='inline position-relative'>
              	<button class='btn btn-minier btn-primary dropdown-toggle' data-toggle='dropdown'><i class='icon-legal icon-only bigger-110'></i></button>
              	<ul class='dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close'>
                  <li><a href='?page=$page&act=sp&id=$d[sId]' class='tooltip-info' data-rel='tooltip' data-original-title='Seminar Proposal'>
                      <span class='red'><i class='icon-folder-close  bigger-120'></i></span>
                      </a>
                  </li>
                  <li><a href='?page=$page&act=uh&id=$d[sId]' class='tooltip-info' data-rel='tooltip' data-original-title='Ujian Hasil'>
                      <span class='blue'><i class='icon-bookmark bigger-120'></i></span>
                      </a>
                  </li>
                  <li><a href='?page=$page&act=um&id=$d[sId]' class='tooltip-info' data-rel='tooltip' data-original-title='Ujian Meja'>
                      <span class='green'><i class='icon-book bigger-120'></i></span>
                      </a>
                  </li>
	            </ul>
	         </div>
	      </td>
	      <td class='center'>";
	      	$sid = $d['sId']
	      	?>
	      	<button class='btn btn-primary btn-mini' onclick="NewWindow('../cetak/skpem.php?sid=<?php echo $sid;?>','ZoomIn','850','550','yes');return false">
					<i class='icon-print bigger-100'></i> SK
				</button>
				<?php
				echo "
			</td>
			<td>
				Seminar Proposal : $aSP</br>
				Seminar Hasil : $aUH</br>
				Ujian Meja : $aUM</br>
			</td>";
	      ?>
	     </tr>
	   <?php
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