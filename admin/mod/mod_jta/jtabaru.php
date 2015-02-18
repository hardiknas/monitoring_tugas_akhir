<?php
	$page = $_GET['page'];
?>
<div class="row-fluid">
<div class="span12">
<?php
if($_GET[act]=="terima"){
$e = mysql_fetch_array(mysql_query("SELECT a.*,b.mNama,b.jId,b.kId FROM skripsi a
														LEFT JOIN mahasiswa b ON a.mNim=b.mNim
														WHERE a.sId='$_GET[id]'"));
$jurusan = getValue("jNama","jurusan","jId='$e[jId]'");
$kampus = getValue("kNama","kampus","kId='$e[kId]'");

?>
<div class="widget-box">
<div class="widget-header widget-header-flat"><h2 class="smaller">Penugasan Pembimbing</h2></div>
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
			<label class="control-label" for="jurusan">Jurusan</label>
			<div class="controls">
				<input class="input-medium" type="text" id="jurusan" name="jurusan" value="<?php echo $jurusan;?>" readonly required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="kampus">Kampus</label>
			<div class="controls">
				<input class="input-medium" type="text" id="kampus" name="kampus" value="<?php echo $kampus;?>" readonly required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="judul">Judul</label>
			<div class="controls">
				<textarea style="width: 70%; height: 50px;"><?php echo $e['sJudul'];?></textarea>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="nosk">No. SK</label>
			<div class="controls">
				<input class="input-large" type="text" id="nosk" name="nosk" value="" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="pem1">Pembimbing 1</label>
			<div class="controls">
				<select class="span4 chosen-select" name="pem1" id="pem1">
					<option></option>
					<?php
						$qsp = mysql_query("SELECT id_dosen,nama_lengkap FROM dosen");
						while ($s=mysql_fetch_array($qsp)) {
							echo "<option value='$s[id_dosen]'>$s[nama_lengkap]</option>";	
						}
					?>
				</select>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="pem2">Pembimbing 2</label>
			<div class="controls">
				<select class="span4 chosen-select" name="pem2" id="pem2">
					<option></option>
					<?php
						$qsp = mysql_query("SELECT id_dosen,nama_lengkap FROM dosen");
						while ($s=mysql_fetch_array($qsp)) {
							echo "<option value='$s[id_dosen]'>$s[nama_lengkap]</option>";	
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
		$q= mysql_query("UPDATE skripsi SET sStatus='2',
														sNoSKPembimbing='$_POST[nosk]',
														sPem1='$_POST[pem1]',
														sPem2='$_POST[pem2]'
												WHERE sId='$_POST[id]'");
		

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
}elseif ($_GET[act]=="tolak"){
	$e = mysql_fetch_array(mysql_query("SELECT a.*,b.mNama,b.jId,b.kId FROM skripsi a
														LEFT JOIN mahasiswa b ON a.mNim=b.mNim
														WHERE a.sId='$_GET[id]'"));
	$jurusan = getValue("jNama","jurusan","jId='$e[jId]'");
	$kampus = getValue("kNama","kampus","kId='$e[kId]'");
?>
<div class="widget-box">
<div class="widget-header widget-header-flat"><h2 class="smaller">Penugasan Pembimbing</h2></div>
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
			<label class="control-label" for="jurusan">Jurusan</label>
			<div class="controls">
				<input class="input-medium" type="text" id="jurusan" name="jurusan" value="<?php echo $jurusan;?>" readonly required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="kampus">Kampus</label>
			<div class="controls">
				<input class="input-medium" type="text" id="kampus" name="kampus" value="<?php echo $kampus;?>" readonly required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="judul">Judul</label>
			<div class="controls">
				<textarea style="width: 70%; height: 50px;"><?php echo $e['sJudul'];?></textarea>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="komen">Komentar Judul Ditolak</label>
			<div class="controls">
				<textarea name="komen" style="width: 70%; height: 50px;"></textarea>
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
		$q= mysql_query("UPDATE skripsi SET sStatus='1',
														sKomentar='$_POST[komen]'														
												WHERE sId='$_POST[id]'");
		

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
	<?php
		if ($_GET[mode]=="tolak"){
			$xx = getData("sId","skripsi","sId='$_GET[id]'");
			if (!$xx[0]==""){
				mysql_query("UPDATE skripsi SET sStatus='1' WHERE sId='$_GET[id]'");
				echo "<script>
				 		notifsukses('Success','Judul Ditolak..!!');
				  		setTimeout('window.location.href=\"media.php?page=$page\"', 2000)
				      </script>";
			}else{
				echo "<script>window.location=('media.php?page=$page')</script>";
			}
		}
	?>
	<button onclick="NewWindow('../cetak/lapjdaftar.php','ZoomIn','850','550','yes');return false" class="btn btn-primary">
		<i class="icon-print bigger-100"></i>Cetak
	</button><br><br>
	<div class="table-header">
	   JUDUL TA YANG BARU DAFTAR
	</div>
	<div class="row-fluid">
	<table id="myTable" class="table table-striped table-bordered table-hover">
	<thead>
	    <tr>
	    <th class="center" width="40px">No</th>
	    <th class="center" width="80px">NIM</th>
	    <th class="center" width="150px">Nama</th>
	    <th class="hidden-480 center" width="100px">Tanggal</th>
	    <th class="hidden-480 center" width="80px">Jurusan</th>
	    <th class="hidden-480 center" width="80px">Kampus</th>
	    <th class="center">Judul</th>
		 <th class="center" width="40px">Aksi</th>
	    </tr>
	</thead>
	<tbody>
	 <?php
	 	$qry = mysql_query("SELECT a.*,b.mNama,b.jId,b.kId FROM skripsi a 
	 							  LEFT JOIN mahasiswa b ON a.mNim=b.mNim
	 							  WHERE a.sStatus='0'
	 							  ORDER BY a.sTgl DESC");
		while ($d = mysql_fetch_array($qry)){
	      ?>
	      <tr>
	      <?php
	      $no++;	      
	      $jurusan = getValue("jNama","jurusan","jId='$d[jId]'");
	      $kampus = getValue("kNama","kampus","kId='$d[kId]'");
	      $tgl = getTglIndo($d['sTgl']);
	      echo "
	      <td class='center'>$no</td>
	      <td class='center'>$d[mNim]</td>
	      <td>$d[mNama]</td>
	      <td class='hidden-480 center'>$tgl</td>
	      <td class='hidden-480 center'>$kampus</td>
	      <td class='hidden-480 center'>$jurusan</td>
	      <td>$d[sJudul]</td>
	      <td class='center'>
            <div class='inline position-relative'>
              <button class='btn btn-minier btn-primary dropdown-toggle' data-toggle='dropdown'><i class='icon-cog icon-only bigger-110'></i></button>
              <ul class='dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close'>
                  <li><a href='?page=$page&act=terima&id=$d[sId]' class='tooltip-success' data-rel='tooltip' data-original-title='Terima'>
                      <span class='green'><i class='icon-check bigger-120'></i></span>
                      </a>
                  </li>
                  <li><a href='?page=$page&act=tolak&id=$d[sId]' class='tooltip-error' data-rel='tooltip' data-original-title='Tolak'>
                      <span class='red'><i class='icon-remove bigger-120'></i></span>
                      </a>
                  </li>
	              </ul>
	            </div>
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