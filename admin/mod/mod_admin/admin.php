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
			<label class="control-label" for="username">Username</label>
			<div class="controls">
				<input type="text" class="input-medium" id="username" name="username" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="password">Password</label>
			<div class="controls">
				<input type="password" class="input-medium" id="password" name="password" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="nama">Nama</label>
			<div class="controls">
				<input class="input-xlarge" type="text" id="nama" name="nama" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="email">Email</label>
			<div class="controls">
				<input class="input-xxlarge" type="email" id="email" name="email" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="telp">Telp/HP</label>
			<div class="controls">
				<input class="input-medium" type="text" id="telp" name="telp" required>
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
		  	$pass = md5($_POST[password]);
		  	$q = mysql_query("INSERT INTO admin (username,password,nama_lengkap,
		  													 no_telp,email,id_session
		                                       )VALUES(
		                                       '$_POST[username]','$pass','$_POST[nama]',
		                                       '$_POST[telp]','$_POST[email]','$pass')
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
$e = mysql_fetch_array(mysql_query("SELECT * FROM admin WHERE id_admin='$_GET[id]'"));
?>
<div class="widget-box">
<div class="widget-header widget-header-flat"><h2 class="smaller">Edit</h2></div>
<div class="widget-body">
<div class="widget-main">
	<!-- FORM -->
	<form method="POST" enctype="multipart/form-data" class="form-horizontal">
		<input type="hidden" name="id" value="<?php echo $e['id_admin'];?>">
		<div class="control-group">
			<label class="control-label" for="username">Username</label>
			<div class="controls">
				<input type="text" class="input-medium" id="username" name="username" value="<?php echo $e[username];?>" readonly required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="password">Password</label>
			<div class="controls">
				<input type="password" class="input-medium" id="password" name="password">
				<span class="help-inline"> * Biarkan kosong jika password tak diubah</span>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="nama">Nama</label>
			<div class="controls">
				<input class="input-xlarge" type="text" id="nama" name="nama" value="<?php echo $e[nama_lengkap];?>" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="email">Email</label>
			<div class="controls">
				<input class="input-xxlarge" type="email" id="email" name="email" value="<?php echo $e[email];?>" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="telp">Telp</label>
			<div class="controls">
				<input class="input-medium" type="text" id="telp" name="telp" value="<?php echo $e[no_telp];?>" required>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="blokir">Blokir</label>
			<div class="controls">
					<?php
					$arBlok = array(
						'Y'=>'Y',
						'N'=>'N'
					);
					foreach ($arBlok as $x => $y) {
						if ($x==$e[blokir]){
							echo "<label>
										<input name='blokir' class='ace' type='radio' value='$x' checked>
										<span class='lbl'>$y</span>
									</label>";
						}else{
							echo "<label>
										<input name='blokir' class='ace' type='radio' value='$x'>
										<span class='lbl'>$y</span>
									</label>";
						}
					}
					?>
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
			if (!empty($_POST[password])){
				$pass = md5($_POST[password]);
				$q = mysql_query("UPDATE admin SET nama_lengkap ='$_POST[nama]',
				                          no_telp='$_POST[telp]',
				                          email='$_POST[email]',
				                          blokir='$_POST[blokir]',
				                          password='$pass'
				                      WHERE id_admin = '$_POST[id]'");
			}else{
				$q = mysql_query("UPDATE admin SET nama_lengkap ='$_POST[nama]',
				                          no_telp='$_POST[telp]',
				                          email='$_POST[email]',
				                          blokir='$_POST[blokir]'
				                      WHERE id_admin = '$_POST[id]'");
			}  
		  	
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
	<a href="?page=<?php echo $page;?>&act=tambah" class="btn btn-primary">
		<i class="icon-download-alt bigger-100"></i>Tambah
	</a><br><br>
	<?php
		if ($_GET[mode]=="hapus"){
			$xx = getData("username,nama_lengkap","admin","id_admin='$_GET[id]'");
			if (!$xx[0]==""){
				mysql_query("DELETE FROM admin WHERE id_admin='$_GET[id]'");
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
	    DATA USER
	</div>
	<div class="row-fluid">
	<table id="myTable" class="table table-striped table-bordered table-hover">
	<thead>
	    <tr>
	    <th class="center">No</th>
	    <th class="center">Nama</th>
	    <th class="center hidden-480">Telp</th>
	    <th class="center hidden-480">Email</th>
	    <th class="center hidden-480">Username</th>
	    <th class="center hidden-480">Blokir</th>
	    <th width="40px" class="center">Aksi</th>
	    </tr>
	</thead>
	<tbody>
	 <?php
	    $qry = mysql_query("SELECT * FROM admin ORDER BY nama_lengkap DESC");
		while ($d = mysql_fetch_array($qry)){
	      ?>
	      <tr>
	      <?php
	      $no++;
	      echo "
	      <td class='center'>$no</td>
	      <td>$d[nama_lengkap]</td>
	      <td class='center hidden-480'>$d[no_telp]</td>
	      <td class='hidden-480'>$d[email]</td>
	      <td class='center hidden-480'>$d[username]</td>
	      <td class='center hidden-480'>$d[blokir]</td>
	      <td class='center'>
            <div class='inline position-relative'>
              <button class='btn btn-minier btn-primary dropdown-toggle' data-toggle='dropdown'><i class='icon-cog icon-only bigger-110'></i></button>
              <ul class='dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close'>
                  <li>
                  	<a href='?page=$page&act=edit&id=$d[id_admin]' class='tooltip-success' data-rel='tooltip' data-original-title='Edit'>
                     	<span class='green'><i class='icon-edit bigger-120'></i></span>
                     	</a>
                  </li>
                  <li>
                  	<a href='?page=$page&mode=hapus&id=$d[id_admin]' onclick='return qh();' class='tooltip-error' data-rel='tooltip' data-original-title='Delete'>
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