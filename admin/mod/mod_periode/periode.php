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
			<label class="control-label" for="thn">Periode</label>
			<div class="controls">
				<input type="text" class="input-medium" id="thn" name="thn" placeholder="Ex : 2014" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="namadekan">Dekan</label>
			<div class="controls">
				<input type="text" class="input-large" id="namadekan" name="namadekan" data-rel="tooltip" data-original-title="Nama Dekan" required>
				<input type="text" class="input-large" id="nip" name="nip" data-rel="tooltip" data-original-title="NIP Dekan" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="qsp">Kuota</label>
			<div class="controls">
				<input type="text" class="input-small" id="qsp" name="qsp" data-rel="tooltip" data-original-title="Kuota Seminar Proposal" required>
				<input type="text" class="input-small" id="quh" name="quh" data-rel="tooltip" data-original-title="Kuota Ujian Hasil" required>
				<input type="text" class="input-small" id="qum" name="qum" data-rel="tooltip" data-original-title="Kuota Ujian Meja" required>
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
		  	$q = mysql_query("INSERT INTO periode (pTahun,pDekan,pDNip,
		  													 pQSP,pQUH,pQUM
		                                       )VALUES(
		                                       '$_POST[thn]','$_POST[namadekan]','$_POST[nip]',
		                                       '$_POST[qsp]','$_POST[quh]','$_POST[qum]')
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
$e = mysql_fetch_array(mysql_query("SELECT * FROM periode WHERE pTahun='$_GET[id]'"));
?>
<div class="widget-box">
<div class="widget-header widget-header-flat"><h2 class="smaller">Edit</h2></div>
<div class="widget-body">
<div class="widget-main">
	<!-- FORM -->
	<form method="POST" enctype="multipart/form-data" class="form-horizontal">
		<div class="control-group">
			<label class="control-label" for="thn">Periode</label>
			<div class="controls">
				<input type="text" class="input-medium" id="thn" name="thn" value="<?php echo $e['pTahun'];?>" placeholder="Ex : 2014" readonly required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="namadekan">Dekan</label>
			<div class="controls">
				<input type="text" class="input-large" id="namadekan" name="namadekan" value="<?php echo $e['pDekan'];?>" data-rel="tooltip" data-original-title="Nama Dekan" required>
				<input type="text" class="input-large" id="nip" name="nip" value="<?php echo $e['pDNip'];?>" data-rel="tooltip" data-original-title="NIP Dekan" required>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="qsp">Kuota</label>
			<div class="controls">
				<input type="text" class="input-small" id="qsp" name="qsp" value="<?php echo $e['pQSP'];?>" data-rel="tooltip" data-original-title="Kuota Seminar Proposal" required>
				<input type="text" class="input-small" id="quh" name="quh" value="<?php echo $e['pQUH'];?>" data-rel="tooltip" data-original-title="Kuota Ujian Hasil" required>
				<input type="text" class="input-small" id="qum" name="qum" value="<?php echo $e['pQUM'];?>" data-rel="tooltip" data-original-title="Kuota Ujian Meja" required>
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
			$q = mysql_query("UPDATE periode SET pDekan ='$_POST[namadekan]',
				                          			 pDNip='$_POST[nip]',
				                          			 pQSP='$_POST[qsp]',
				                          			 pQUH='$_POST[quh]',
				                          			 pQUM='$_POST[qum]'
				                      WHERE pTahun = '$_POST[thn]'");
			$pr = getValue("pAktif","periode","pTahun='$_POST[thn]'");
			if ($pr==1){
				getPAktif();
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
		if ($_GET['mode']=="hapus"){
			$xx = getValue("pAktif","periode","pTahun='$_GET[id]'");
			if ($xx!=1){
				mysql_query("DELETE FROM periode WHERE pTahun='$_GET[id]'");
				echo "<script>
					 		notifsukses('Success,'Data Telah Dihapus..!!');
					  		setTimeout('window.location.href=\"media.php?page=$page\"', 2000)
					   </script>";
			}else{
				echo "<script>
					 		notiferror('Error','Periode Aktif tidak dapat dihapus..!!');
					  		setTimeout('window.location.href=\"media.php?page=$page\"', 2000)
					   </script>";
			}
		}elseif($_GET['mode']=="aktif"){
			mysql_query("UPDATE periode SET pAktif='0'");
			mysql_query("UPDATE periode SET pAktif='1' WHERE pTahun='$_GET[id]'");
			getPAktif();
			echo "<script>
				 		notifsukses('Sukses','Periode Telah Diaktifkan..!!');
				  		setTimeout('window.location.href=\"media.php?page=$page\"', 2000)
				   </script>";
		}
	?>
	<div class="table-header">
	    PERIODE
	</div>
	<div class="row-fluid">
	<table id="myTable" class="table table-striped table-bordered table-hover">
	<thead>
	    <tr>
	    <th class="center" width="40px">No</th>
	    <th class="center" width="100px">Periode</th>
	    <th class="center">Dekan</th>
	    <th class="center hidden-480">Kuota</th>
	    <th class="center" width="100px">Status</th>
	    <th class="center" width="40px">Aksi</th>
	    </tr>
	</thead>
	<tbody>
	 <?php
	    $qry = mysql_query("SELECT * FROM periode ORDER BY pTahun DESC");
		while ($d = mysql_fetch_array($qry)){
	      $no++;
	      $arSt = array(
	      	'0' => "<a href='?page=$page&mode=aktif&id=$d[pTahun]' class='btn btn-minier btn-danger'><i class='icon-check-empty'></i></a>",
	      	'1' => "<a href='#' class='btn btn-minier btn-success'><i class='icon-check'></i></a>"
	      );
	      $ptA = $d['pAktif'];
	      $stAktif = $arSt[$ptA];
	      echo "
	      <tr>
	      <td class='center'>$no</td>
	      <td class='center'>$d[pTahun]</td>
	      <td>$d[pDekan]</td>
	      <td class='hidden-480'>
	      	Seminar Proposal : $d[pQSP]<br>
	      	Seminar Hasil : $d[pQUH]<br>
	      	Ujian Meja : $d[pQUM]<br>
	      </td>
	      <td class='center'>$stAktif</td>
	      <td class='center'>
            <div class='inline position-relative'>
              <button class='btn btn-minier btn-primary dropdown-toggle' data-toggle='dropdown'><i class='icon-cog icon-only bigger-110'></i></button>
              <ul class='dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close'>
                  <li>
                  	<a href='?page=$page&act=edit&id=$d[pTahun]' class='tooltip-success' data-rel='tooltip' data-original-title='Edit'>
                     	<span class='green'><i class='icon-edit bigger-120'></i></span>
                     	</a>
                  </li>
                  <li>
                  	<a href='?page=$page&mode=hapus&id=$d[pTahun]' onclick='return qh();' class='tooltip-error' data-rel='tooltip' data-original-title='Delete'>
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