<?php
	$page = $_GET['page'];
	$uid = $_SESSION['sesId'];
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
		<input type="hidden" id="usr" name="usr" value="<?php echo $uid;?>">
		<div class="control-group">
			<label class="control-label" for="judul">Judul</label>
			<div class="controls">
				<input class="input-xxlarge" type="text" id="judul" name="judul" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="isi">Isi</label>
			<div class="controls">
				<textarea name="isi" class="ckeditor" rows="8"></textarea>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="fupload">Gambar</label>
			<div class="controls">
				<div id="foto">
					<div class="span2" data-rel="tooltip" data-placement="right" data-original-title="Ukuran file gambar tidak boleh melebihi 1MB">
						<input type="file" name="fupload" required> 
					</div>
				</div>
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
			$tgls = date('Y-m-d');
			$lokasi_file    = $_FILES['fupload']['tmp_name'];
  			$tipe_file      = $_FILES['fupload']['type'];
  			$nama_file      = $_FILES['fupload']['name'];
  			$acak           = rand(1,99);
  			$gambar = $acak.$nama_file;

  			if (!empty($lokasi_file)){
  				UploadGambar($gambar);
  				$q= mysql_query("INSERT INTO ms_artikel (arTgl,arJudul,arIsi,
															  		  arGambar,arUser)
											VALUES ('$tgls','$_POST[judul]','$_POST[isi]',
													  '$gambar','$_POST[usr]')");
  			}else{
  				$q= mysql_query("INSERT INTO ms_artikel (arTgl,arJudul,arIsi,arUser)
											VALUES ('$tgls','$_POST[judul]','$_POST[isi]','$_POST[usr]')");
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
}elseif($_GET[act]=="edit"){
$e = mysql_fetch_array(mysql_query("SELECT * FROM ms_artikel WHERE arId='$_GET[id]'"));
?>
<div class="widget-box">
<div class="widget-header widget-header-flat"><h2 class="smaller">Edit</h2></div>
<div class="widget-body">
<div class="widget-main">
	
	<!-- FORM -->
	<form method="POST" enctype="multipart/form-data" class="form-horizontal">
		<input type="hidden" id="id" name="id" value="<?php echo $e[arId];?>">
		<?php
			$uid = ((empty($e[arUser])) ? $uid : $e[arUser]);
		?>
		<input type="hidden" id="usr" name="usr" value="<?php echo $uid;?>">
		<div class="control-group">
			<label class="control-label" for="judul">Judul</label>
			<div class="controls">
				<input class="input-xxlarge" type="text" id="judul" name="judul" value="<?php echo $e[arJudul];?>" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="isi">Isi</label>
			<div class="controls">
				<textarea name="isi" class="ckeditor" rows="8"><?php echo $e[arIsi];?></textarea>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="fupload">Gambar</label>
			<div class="controls">
				<?php
					$ptol = "Anda belum menginput gambar, ukuran file gambar tidak boleh lebih 1MB";
					if (!empty($e[arGambar])){
						$gbrx = "<div class='span3'>
									<img class='pull-left' width='80%' src='../img_artikel/$e[arGambar]' margin='5px' data-rel='tooltip' data-placement='right' data-original-title='Gambar Sekarang'>
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
		<div class="form-actions">
			<button class="btn btn-info" type="submit" name="simpan">
				<i class="icon-save bigger-110"></i>Simpan
			</button>
			<a class="btn" href="javascript:history.go(-1);">
				<i class="icon-undo bigger-110"></i>Batal
			</a>
		</div>
	</form>
	<!-- FORM -->
	<?php
	if (isset($_POST[simpan])){
			$tgls = date('Y-m-d');
			$lokasi_file    = $_FILES['fupload']['tmp_name'];
  			$tipe_file      = $_FILES['fupload']['type'];
  			$nama_file      = $_FILES['fupload']['name'];
  			$acak           = rand(1,99);
  			$gambar = $acak.$nama_file;

  			if (!empty($lokasi_file)){
  				UploadGambar($gambar);

  				$gbrx = getValue("arGambar","ms_artikel","arId='$_POST[id]'");
				if (!empty($gbrx)){
					unlink("../img_artikel/$gbrx");
				}

  				$q= mysql_query("UPDATE ms_artikel SET arJudul='$_POST[judul]',
  																arIsi='$_POST[isi]',
													  			arGambar='$gambar',
													  			arUser='$_POST[usr]',
													  			ou=now()
													  	WHERE arId='$_POST[id]'
									");
  			}else{
  				$q= mysql_query("UPDATE ms_artikel SET arJudul='$_POST[judul]',
  																arIsi='$_POST[isi]',
  																arUser='$_POST[usr]',
  																ou=now()
													  	WHERE arId='$_POST[id]'
									");
  			}
			
			if ($q){
			echo "<script>
			 		notifsukses('Success','Data Telah Tersimpan..!!');
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
	<a href="?page=<?php echo $page;?>&act=tambah" class="btn btn-primary">
		<i class="icon-download-alt bigger-100"></i>Tambah
	</a><br><br>
	<?php
		if ($_GET[mode]=="hapus"){
			$gbr = getValue("arGambar","artikel","arId='$_GET[id]'");
			if (!empty($gbr)){
				unlink("../foto_artikel/$gbr");
			}
			mysql_query("DELETE FROM artikel WHERE arId='$_GET[id]'");

			echo "<script>
				 		notifsukses('Success','Data Telah Dihapus..!!');
				  		setTimeout('window.location.href=\"media.php?page=$page\"', 2000)
				   </script>";
		}
	?>
	<div class="table-header">
	   ARTIKEL
	</div>
	<div class="row-fluid">
	<table id="myTable" class="table table-striped table-bordered table-hover">
	<thead>
	    <tr>
	    <th class="center" width="40px">No</th>
	    <th class="center" width="200px">Tanggal</th>
	    <th class="center">Judul</th>
	    <?php
	    if ($_SESSION['sesLevel']==1){
	    	echo "<th class='center' width='250px'>Oleh</th>";
	    }
	    ?>
	    <th class="center" width="80">Dibaca</th>
	    <th class="center" width="40px">Aksi</th>
	    </tr>
	</thead>
	<tbody>
	 <?php
	 	if ($_SESSION['sesLevel']==1){
	 		$qa = "SELECT * FROM ms_artikel";
	 	}else{
	 		$qa = "SELECT * FROM ms_artikel WHERE arUser='$uid'";
	 	}
	   $qry = mysql_query($qa);
		while ($d = mysql_fetch_array($qry)){
	      ?>
	      <tr>
	      <?php
	      $no++;
	      $tgl = getTglIndo($d[arTgl]);
	      $oleh = getValue("uNama","ms_user","uUname='$d[arUser]'");
	      echo "
	      <td class='center'>$no</td>
	      <td class='center'>$tgl</td>
	      <td>$d[arJudul]</td>";
	      if ($_SESSION['sesLevel']==1){
	    		echo "<td class='center'>$oleh</td>";
	    	}
	    	echo "
	      <td class='center'>$d[arLook]</td>
	      <td class='center'>
            <div class='inline position-relative'>
              <button class='btn btn-minier btn-primary dropdown-toggle' data-toggle='dropdown'><i class='icon-cog icon-only bigger-110'></i></button>
              <ul class='dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close'>
                  <li>
                  	<a href='?page=$page&act=edit&id=$d[arId]' class='tooltip-success' data-rel='tooltip' data-original-title='Edit'>
                     	<span class='green'><i class='icon-edit bigger-120'></i></span>
                     </a>
                  </li>
                  <li>
                  	<a href='?page=$page&mode=hapus&id=$d[arId]' onclick='return qh();' class='tooltip-error' data-rel='tooltip' data-original-title='Delete'>
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