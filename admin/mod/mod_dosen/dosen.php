<?php
	$page = $_GET['page'];
?>
<div class="row-fluid">
<div class="span12">
<?php
if($_GET[act]=="tambah"){
?>
<div class="widget-box">
<div class="widget-header widget-header-flat"><h2 class="smaller">Tambah</h2></div>
<div class="widget-body">
<div class="widget-main">

	<!-- FORM -->
	<form method="POST" enctype="multipart/form-data" class="form-horizontal">
		<div class="control-group">
			<label class="control-label" for="foto">Foto</label>
			<div class="controls">
				<div id="foto">
					<div class="span2" data-rel="tooltip" data-placement="right" data-original-title="Ukuran File Gambar Tidak Boleh Lebih 1MB">
						<input type="file" name="fupload" required> 
					</div>
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="nip">NIP</label>
			<div class="controls">
				<input class="input-large" type="text" id="nip" name="nip" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="nama">Nama</label>
			<div class="controls">
				<input class="input-xlarge" type="text" id="nama" name="nama" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="t4l">Tempat Lahir</label>
			<div class="controls">
				<input class="input-xlarge" type="text" id="t4l" name="t4l" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="tgl">Tanggal Lahir</label>
			<div class="controls">
				<div class="input-append">
					<input class="input-medium date-picker" id="tgl" name="tgl" type="text" data-date-format="yyyy-mm-dd" required />
					<span class="add-on"><i class="icon-calendar"></i></span>
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="alamat">Alamat</label>
			<div class="controls">
				<input class="input-xxlarge" type="text" id="alamat" name="alamat" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="telp">Telp/HP</label>
			<div class="controls">
				<div class="input-append">
				<input class="input-medium" type="text" id="telp" name="telp" required>
				<span class="add-on"><i class="icon-phone"></i></span>
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="email">Email</label>
			<div class="controls">
				<div class="input-append">
				<input class="input-xlarge" type="email" id="email" name="email" required>
				<span class="add-on"><i class="icon-envelope"></i></span>
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="username">Username</label>
			<div class="controls">
				<input class="input-medium" type="text" id="username" name="username" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="password">Password</label>
			<div class="controls">
				<input class="input-medium" type="password" id="password" name="password" required>
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
		$lokasi_file    = $_FILES['fupload']['tmp_name'];
  		$tipe_file      = $_FILES['fupload']['type'];
  		$nama_file      = $_FILES['fupload']['name'];
  		$acak           = rand(1,99);
  		$foto = $acak.$nama_file;
		$pass = md5($_POST[password]);
		UploadDosen($foto);
		$q = mysql_query("INSERT INTO dosen (nip,nama_lengkap,username_login,
														 password_login,alamat,tempat_lahir,tgl_lahir,
														 no_telp,email,foto)
							  				VALUES ('$_POST[nip]','$_POST[nama]','$_POST[username]',
							  						  '$pass','$_POST[alamat]','$_POST[t4l]','$_POST[tgl]',
							  						  '$_POST[telp]','$_POST[email]','$foto')");

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
}elseif($_GET[act]=="edit"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM dosen WHERE id_dosen='$_GET[id]'"));
?>
<div class="widget-box">
<div class="widget-header widget-header-flat"><h2 class="smaller">Edit</h2></div>
<div class="widget-body">
<div class="widget-main">

	<!-- FORM -->
	<form method="POST" enctype="multipart/form-data" class="form-horizontal">
		<input type="hidden" name="id" value="<?php echo $e[id_dosen];?>">
		<div class="control-group">
			<label class="control-label" for="foto">Foto</label>
			<div class="controls">
				<?php
					$ptol = "Anda belum menginput gambar, ukuran file gambar tidak boleh lebih 1MB";
					if (!empty($e[foto])){
						$gbrx ="<div class='span2'>
								<img class='pull-left' src='../foto_dosen/$e[foto]' width='80%' margin='5px' data-rel='tooltip' data-placement='right' data-original-title='Foto Sekarang'>
								</div>";
						$ptol = "Abaikan jika gambar tidak diganti, ukuran file gambar tidak boleh lebih 1MB";
					}						
				?>
				<div id="foto">
					<div class="span2" data-rel="tooltip" data-placement="right" data-original-title="<?php echo $ptol;?>">
						<input type="file" name="fupload"> 
					</div>
				</div>
				<?php echo $gbrx;?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="nip">NIP</label>
			<div class="controls">
				<input class="input-large" type="text" id="nip" name="nip" value="<?php echo $e[nip];?>" readonly required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="nama">Nama</label>
			<div class="controls">
				<input class="input-xlarge" type="text" id="nama" name="nama" value="<?php echo $e[nama_lengkap];?>" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="t4l">Tempat Lahir</label>
			<div class="controls">
				<input class="input-xlarge" type="text" id="t4l" name="t4l" value="<?php echo $e[tempat_lahir];?>" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="tgl">Tanggal Lahir</label>
			<div class="controls">
				<div class="input-append">
					<input class="input-medium date-picker" id="tgl" name="tgl" type="text" data-date-format="yyyy-mm-dd" value="<?php echo $e[tgl_lahir];?>" required />
					<span class="add-on"><i class="icon-calendar"></i></span>
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="alamat">Alamat</label>
			<div class="controls">
				<input class="input-xxlarge" type="text" id="alamat" name="alamat" value="<?php echo $e[alamat];?>" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="telp">Telp/HP</label>
			<div class="controls">
				<div class="input-append">
				<input class="input-medium" type="text" id="telp" name="telp" value="<?php echo $e[no_telp];?>" required>
				<span class="add-on"><i class="icon-phone"></i></span>
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="email">Email</label>
			<div class="controls">
				<div class="input-append">
				<input class="input-xlarge" type="email" id="email" name="email" value="<?php echo $e[email];?>" required>
				<span class="add-on"><i class="icon-envelope"></i></span>
				</div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="username">Username</label>
			<div class="controls">
				<input class="input-medium" type="text" id="username" name="username" value="<?php echo $e[username_login];?>" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="password">Password</label>
			<div class="controls">
				<input type="password" class="input-medium" id="password" name="password">
				<span class="help-inline"> * Biarkan kosong jika password tak diubah</span>
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
		$lokasi_file    = $_FILES['fupload']['tmp_name'];
  		$tipe_file      = $_FILES['fupload']['type'];
  		$nama_file      = $_FILES['fupload']['name'];
  		$acak           = rand(1,99);
  		$foto = $acak.$nama_file;

  		if (!empty($_POST[password])){
  			$xp = md5($_POST[password]);
  			$pass = ",password_login='$xp'";
  		}else{
  			$pass = "";
  		}

		if (!empty($lokasi_file)){
			UploadDosen($foto);
			$ft = getValue("foto","dosen","id_dosen='$_POST[id]'");
			if (!$ft==""){
				unlink("../foto_dosen/$ft");
			}

			$q= mysql_query("UPDATE dosen SET nama_lengkap='$_POST[nama]',username_login='$_POST[username]',
														 alamat='$_POST[alamat]',tempat_lahir='$_POST[t4l]',tgl_lahir='$_POST[tgl]',
														 no_telp='$_POST[telp]',email='$_POST[email]',foto='$foto' $pass
												WHERE id_dosen='$_POST[id]'");
		}else{
			$q= mysql_query("UPDATE dosen SET nama_lengkap='$_POST[nama]',username_login='$_POST[username]',
														 alamat='$_POST[alamat]',tempat_lahir='$_POST[t4l]',tgl_lahir='$_POST[tgl]',
														 no_telp='$_POST[telp]',email='$_POST[email]' $pass
												WHERE id_dosen='$_POST[id]'");
		}

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
}elseif ($_GET[act]=="jadwal"){
	include 'djadwal.php';
}else{
?>
	<?php
		if ($_GET[mode]=="hapus"){
			$xx = getData("id_dosen,nama_lengkap,foto","dosen","id_dosen='$_GET[id]'");
			if (!$xx[0]==""){
				if (!empty($xx[2])){
					unlink("../foto_dosen/$xx[2]");
				}
				mysql_query("DELETE FROM dosen WHERE id_dosen='$_GET[id]'");
				echo "<script>
				 		notifsukses('Success','Data Terhapus..!!');
				  		setTimeout('window.location.href=\"media.php?page=$page\"', 2000)
				      </script>";
			}else{
				echo "<script>window.location=('media.php?page=$page')</script>";
			}
		}
	?>
	<div class="table-header">
	    DATA DOSEN
	</div>
	<div class="row-fluid">
	<table id="myTable" class="table table-striped table-bordered table-hover">
	<thead>
	    <tr>
	    <th class="center" width="40px">No</th>
	    <th class="center" width="150px">NIP</th>
	    <th class="center">Nama</th>
	    <th class="center" width="100px">Telp</th>
	    <th class="hidden-480 center" width="100px">Email</th>
	    <th class="hidden-480 center" width="100px">Username</th>
		 <th class="center" width="40px">Aksi</th>
	    </tr>
	</thead>
	<tbody>
	 <?php
	 	$qry = mysql_query("SELECT a.* FROM dosen a ORDER BY a.nip ASC");
		while ($d = mysql_fetch_array($qry)){
	      ?>
	      <tr>
	      <?php
	      $no++;
	      echo "
	      <td class='center'>$no</td>
	      <td class='center'><a href='media.php?page=dosen&act=jadwal&did=$d[id_dosen]'>$d[nip]</a></td>
	      <td>$d[nama_lengkap]</td>
	      <td class='center'>$d[no_telp]</td>
	      <td class='hidden-480'>$d[email]</td>
	      <td class='center hidden-480'>$d[username_login]</a></td>
	      <td class='center'>
            <div class='inline position-relative'>
              <button class='btn btn-minier btn-primary dropdown-toggle' data-toggle='dropdown'><i class='icon-cog icon-only bigger-110'></i></button>
              <ul class='dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close'>
                  <li><a href='?page=$page&act=edit&id=$d[id_dosen]' class='tooltip-success' data-rel='tooltip' data-original-title='Edit'>
                      <span class='green'><i class='icon-edit bigger-120'></i></span>
                      </a>
                  </li>
                  <li><a href='?page=$page&mode=hapus&id=$d[id_dosen]' onclick='return qh();' class='tooltip-error' data-rel='tooltip' data-original-title='Delete'>
                      <span class='red'><i class='icon-trash bigger-120'></i></span>
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