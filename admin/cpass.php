<?php
$e = mysql_fetch_array(mysql_query("SELECT uUname FROM ms_user WHERE uUname='$_SESSION[sesId]'"));
$ujenis = "Username";
$uid = $e[uUname];
?>
<div class="row-fluid">
<div class="span12">
<div class="widget-box">
<div class="widget-header widget-header-flat"><h2 class="smaller">Ubah Password</h2></div>
<div class="widget-body">
<div class="widget-main">

	<!-- FORM -->
	<form method="POST" enctype="multipart/form-data" class="form-horizontal">
		<div class="control-group">
			<label class="control-label" for="kode"><?php echo $ujenis;?></label>
			<div class="controls">
				<input class="input-medium" type="text" id="kode" name="kode" value="<?php echo $uid;?>" readonly required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="password">Password</label>
			<div class="controls">
				<input type="password" class="input-medium" id="password" name="password" required>
			</div>
		</div>
		<div class="form-actions">
			<button class="btn btn-info" type="submit" name="simpan">
				<i class="icon-save bigger-110"></i>Simpan
			</button>
			<a class="btn" href="media.php?page=home">
				<i class="icon-undo bigger-110"></i>Batal
			</a>
		</div>
	</form>
	<!-- FORM -->

	<?php
	if (isset($_POST[simpan])){
			$pwd=md5($_POST[password]);

			$q= mysql_query("UPDATE ms_user SET uPass='$pwd', ou=now() WHERE uUname='$_POST[kode]'");
			
			if ($q){
			echo "<script>
			 		notifsukses('Success','Password Anda Telah Diperbaharui..!!');
			  		setTimeout('window.location.href=\"media.php?page=home\"', 2000)
			      </script>";
			}else{
			echo "<script>
			      notiferror('Failed','Password Anda Gagal Diperbaharui..!!');
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
</div>