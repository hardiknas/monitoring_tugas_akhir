<?php
	$page = $_GET['page'];
	$siId = $_SESSION['sesId'];
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
		  	$q = mysql_query("INSERT INTO info (iJudul,iIsi,pengirim,tgl)
		  									 VALUES('$_POST[judul]','$_POST[isi]','$siId',now())
		                    ");
		  	
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
$e = mysql_fetch_array(mysql_query("SELECT * FROM info WHERE iId='$_GET[id]'"));
?>
<div class="widget-box">
<div class="widget-header widget-header-flat"><h2 class="smaller">Edit</h2></div>
<div class="widget-body">
<div class="widget-main">
	<!-- FORM -->
	<form method="POST" enctype="multipart/form-data" class="form-horizontal">
		<input type="hidden" name="id" value="<?php echo $e[iId];?>">
		<div class="control-group">
			<label class="control-label" for="judul">Judul</label>
			<div class="controls">
				<input class="input-xxlarge" type="text" id="judul" name="judul" value="<?php echo $e[iJudul];?>" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="isi">Isi</label>
			<div class="controls">
				<textarea name="isi" class="ckeditor" rows="8"><?php echo $e[iIsi];?></textarea>
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
			$q = mysql_query("UPDATE info SET iJudul ='$_POST[judul]',
				                          		 iIsi='$_POST[isi]'
				                      WHERE iId = '$_POST[id]'");
		  	
			if ($q){
			echo "<script>
			 		notifsukses('Success','Data Tersimpan..!!');
			  		setTimeout('window.location.href=\"media.php?page=$page\"', 2000)
			      </script>";
			}else{
			echo "<script>
			      notiferror('Failed','Data Gagal Tersimpan ..!!');
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
		if ($_GET[mode]=="hapus"){
			$xx = getData("spId,spNama","ms_user","spId='$_GET[id]'");
			if (!$xx[0]==""){
				mysql_query("DELETE FROM ms_spesialis WHERE spId='$_GET[id]'");
				echo "<script>
					 		notifsukses('Success,'Data Telah Dihapus..!!');
					  		setTimeout('window.location.href=\"media.php?page=$page\"', 2000)
					   </script>";
			}else{
				echo "<script>window.location=('media.php?page=$page')</script>";
			}
		}
	?>
	<div class="table-header">
	   INFO
	</div>
	<div class="row-fluid">
	<table id="myTable" class="table table-striped table-bordered table-hover">
	<thead>
	    <tr>
	    <th class="center" width="50px">No</th>
	    <th class="center" width="150px">Tanggal</th>
	    <th class="center">Judul</th>
	    <th class="center">Pengirim</th>
	    <th width="40px" class="center">Aksi</th>
	    </tr>
	</thead>
	<tbody>
	 <?php
	    $qry = mysql_query("SELECT a.*,b.nama_lengkap FROM info a
	    							LEFT JOIN admin b ON a.pengirim=b.id_admin ORDER BY a.tgl ASC");
		while ($d = mysql_fetch_array($qry)){
	      ?>
	      <tr>
	      <?php
	      $no++;
	      $tgl = getTglIndo($d[tgl]);
	      echo "
	      <td class='center'>$no</td>
	      <td class='center'>$tgl</td>
	      <td>$d[iJudul]</td>
	      <td class='center'>$d[nama_lengkap]</td>
	      <td class='center'>
            <div class='inline position-relative'>
              <button class='btn btn-minier btn-primary dropdown-toggle' data-toggle='dropdown'><i class='icon-cog icon-only bigger-110'></i></button>
              <ul class='dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close'>
                  <li>
                  	<a href='?page=$page&act=edit&id=$d[iId]' class='tooltip-success' data-rel='tooltip' data-original-title='Edit'>
                     	<span class='green'><i class='icon-edit bigger-120'></i></span>
                     	</a>
                  </li>
                  <li>
                  	<a href='?page=$page&mode=hapus&id=$d[iId]' onclick='return qh();' class='tooltip-error' data-rel='tooltip' data-original-title='Delete'>
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