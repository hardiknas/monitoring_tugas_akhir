<?php
$page = $_GET[page];
$e = mysql_fetch_array(mysql_query("SELECT * FROM mhs WHERE mNim='$_SESSION[medId]'"));
?>
<div class="row-fluid">
<div class="span12">
	
	<div class="widget-box">
	<div class="widget-header widget-header-flat"><h2 class="smaller">Profil</h2></div>
	<div class="widget-body">
	<div class="widget-main">

		<!-- FORM -->
		<form method="POST" enctype="multipart/form-data" class="form-horizontal">
			<div class="control-group">
			<label class="control-label" for="foto">Foto</label>
			<div class="controls">
				<?php
					$ptol = "Anda belum menginput foto, ukuran file gambar tidak boleh lebih 1MB";
					if (!empty($e[mFoto])){
						echo "<div class='span2'>
								<img class='pull-left' src='foto_mhs/$e[mFoto]' data-rel='tooltip' data-placement='left' data-original-title='Foto Sekarang'>
								</div>";
						$ptol = "Abaikan jika foto tidak diganti, ukuran file gambar tidak boleh lebih 1MB";
					}						
				?>
				<div id="foto">
					<div class="span2" data-rel="tooltip" data-placement="right" data-original-title="<?php echo $ptol;?>">
						<input type="file" name="fupload"> 
					</div>
				</div>
			</div>
		</div>
			<div class="control-group">
				<label class="control-label" for="nim">NIM</label>
				<div class="controls">
					<input class="input-small" type="text" id="nim" name="nim" value="<?php echo $e[mNim];?>" readonly required>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="angkatan">Angkatan</label>
				<div class="controls">
					<select class="chosen-select span1" id="angkatan" name="angkatan" data-placeholder="Pilih Angkatan" disabled>
					<?php
					$ang = getTahun();
					foreach ($ang as $x => $y) {
						if ($y==$e[mAngkatan]){
							echo "<option value='$y' selected>$y</option>";	
						}else{
							echo "<option value='$y'>$y</option>";
						}
					}
					?>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="nama">Nama</label>
				<div class="controls">
					<input class="input-xlarge" type="text" id="nama" name="nama" value="<?php echo $e[mNama];?>" required>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="alamat">Alamat</label>
				<div class="controls">
					<input class="input-xlarge" type="text" id="alamat" name="alamat" value="<?php echo $e[mAlamat];?>" required>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="t4lahir">Tempat Lahir</label>
				<div class="controls">
					<input class="input-xlarge" type="text" id="t4lahir" name="t4lahir" value="<?php echo $e[mT4lahir];?>" required>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="tgllahir">Tanggal Lahir</label>
				<div class="controls">
					<div class="row-fluid input-append">
						<input class="span2 date-picker" id="tgllahir" name="tgllahir" type="text" data-date-format="yyyy-mm-dd" value="<?php echo $e[mTgllahir];?>" required />
						<span class="add-on"><i class="icon-calendar"></i></span>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="email">Email</label>
				<div class="controls">
					<div class="row-fluid input-append">
						<input class="input-xxlarge" type="email" id="email" name="email" value="<?php echo $e[mEmail];?>" required>
						<span class="add-on"><i class="icon-envelope"></i></span>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="no_hp">No.HP</label>
				<div class="controls">
					<div class="row-fluid input-append">
						<input class="input-medium" type="text" id="no_hp" name="no_hp" value="<?php echo $e[mHp];?>" required>
						<span class="add-on"><i class="icon-phone"></i></span>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="tw">Twitter</label>
				<div class="controls">
					<div class="row-fluid input-append">
						<input class="input-xlarge" type="text" id="tw" name="tw" value="<?php echo $e[mTwitter];?>" required>
						<span class="add-on"><i class="icon-twitter-sign"></i></span>
					</div>
				</div>
			</div>
			
			<div class="form-actions">
				<button class="btn btn-info" type="submit" name="simpan">
					<i class="icon-save bigger-110"></i>Simpan
				</button>
				<a class="btn" href="media.php?page=<?php echo $page;?>">
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
		  		$foto = $_SESSION[medId]."-".$acak.$nama_file;

				if (!empty($lokasi_file)){
					UploadFotoMhs($foto);
					$fmhs = getValue("mFoto","mhs","mNim='$_SESSION[medId]'");
					if (!$fmhs==""){
						unlink("foto_mhs/$fmhs");
					}

				  	$q= mysql_query("UPDATE mhs SET mNama    ='$_POST[nama]',
		                                        mAlamat  ='$_POST[alamat]',
		                                        mT4lahir ='$_POST[t4lahir]',
		                                        mTgllahir='$_POST[tgllahir]',
		                                        mHp   ='$_POST[no_hp]',
		                                        mEmail   ='$_POST[email]',
		                                        mTwitter ='$_POST[tw]',
		                                        mFoto = '$foto',
		                                        mLengkap = '1'
		                                        WHERE mNim='$_SESSION[medId]'");
				  	if ($q){
				  		$_SESSION[medFoto] = $foto;
				  	}
				}else{
					$q= mysql_query("UPDATE mhs SET mNama    ='$_POST[nama]',
		                                        mAlamat  ='$_POST[alamat]',
		                                        mT4lahir ='$_POST[t4lahir]',
		                                        mTgllahir='$_POST[tgllahir]',
		                                        mHp   ='$_POST[no_hp]',
		                                        mEmail   ='$_POST[email]',
		                                        mTwitter      ='$_POST[tw]',
		                                        mLengkap = '1'
		                                        WHERE mNim='$_SESSION[medId]'");
				}

			
				if ($q){
				echo "<script>
				 		notifsukses('Sukses','Data Telah Tersimpan..!!');
				  		setTimeout('window.location.href=\"media.php?page=$page\"', 2000)
				      </script>";
				}else{
				echo "<script>
				      notiferror('Gagal','Data Gagal Tersimpan, pastikan data yang diinput telah benar ..!!');
				  		setTimeout(function() { history.go(-1); }, 2000);
				      </script>";
				}
			}
		?>
	</div>
	</div>
	</div>	

</div>
</div>