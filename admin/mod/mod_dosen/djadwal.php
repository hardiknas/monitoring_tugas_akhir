<div class="page-header">
	<h1>Jadwal Dosen</h1>
</div>
<div class="row-fluid ">
<div class="span12">
	<div class="span4">
		<?php
			$e = mysql_fetch_array(mysql_query("SELECT * FROM dosen WHERE id_dosen='$_GET[did]'"));
			$did = $e[id_dosen];
			$act = $_GET[act];
			$npage = "dosen&act=$act&did=$did";
		?>
		<div id="user-profile-1" class="user-profile row-fluid">
			<div class="span12 center">
				<div>
					<span class="profile-picture">
						<?php
							if ($e[foto]=="")	{
								echo "<img alt='$e[nama_lengkap]' src='../images/photo.jpg'>";
							}else{
								echo "<img alt='$e[nama_lengkap]' src='../foto_dosen/$e[foto]'>";
							}
						?>
					</span>
					<div class="space-4"></div>
					<div class="width-80 label label-info label-large arrowed-in arrowed-in-right">
						<div class="inline position-relative">
							<a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
								<span class="white middle bigger-120"><?php echo $e[nip]." - ".$e[nama_lengkap];?></span>
							</a>
						</div>
					</div>
				</div>
				<div class="space-6"></div>
				<div class="profile-contact-info">
					<div class="profile-contact-links align-left">
						<a class="btn btn-link" href="#"><i class="icon-home bigger-120 green"></i><?php echo $e[alamat];?></a><br>
						<a class="btn btn-link" href="#"><i class="icon-envelope bigger-120 orange"></i><?php echo $e[email];?></a><br>
						<a class="btn btn-link" href="#"><i class="icon-phone bigger-120 blue"></i><?php echo $e[no_telp];?></a><br>
					</div>
				</div>
				<div class="space-6"></div>
					<div class="widget-box align-left">
					<div class="widget-header widget-header-flat"><h2 class="smaller">Input Jadwal</h2></div>
					<div class="widget-body">
					<div class="widget-main">
						<!-- FORM -->
						<form method="POST" enctype="multipart/form-data" class="form-horizontal">
							<div class="control-group">
								<label class="control-label" for="kampus">Kampus</label>
								<div class="controls">
									<select class="span2 chosen-select" name="kampus" id="kampus">
										<?php
											$qsp = mysql_query("SELECT * FROM kampus");
											while ($s=mysql_fetch_array($qsp)) {
												echo "<option value='$s[kId]'>$s[kNama]</option>";
											}
										?>
									</select>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="tgl">Tanggal</label>
								<div class="controls">
									<div class="input-append">
										<input class="input-medium date-picker" id="tgl" name="tgl" type="text" data-date-format="yyyy-mm-dd" required />
										<span class="add-on"><i class="icon-calendar"></i></span>
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="jam">Jam</label>
								<div class="controls">
									<input class="input-medium" type="text" id="jam" name="jam" placeholder="00.00-00.00" required>
								</div>
							</div>						
							<div class="form-actions">
								<button class="btn btn-info" type="submit" name="simpan">
									<i class="icon-save bigger-110"></i>Simpan
								</button>
							</div>
						</form>
						<!-- FORM -->
						<?php
						if (isset($_POST[simpan])){
							$q = mysql_query("INSERT INTO jadwal (id_dosen,kId,jTgl,jJam)
												  				VALUES ('$did','$_POST[kampus]','$_POST[tgl]','$_POST[jam]')");

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
		</div>
	</div>
	<div class="span8">
		<div class="span12">
			<?php
				if ($_GET[jmode]=="del"){
					mysql_query("DELETE FROM jadwal WHERE jId='$_GET[jid]'");
					echo "<script>
					 		notifsukses('Success','Data Terhapus..!!');
					  		setTimeout('window.location.href=\"media.php?page=$npage\"', 2000)
					      </script>";
				}
			?>
			<div class="table-header">
			    JADWAL
			</div>
			<div class="row-fluid">
			<table id="myTable" class="table table-striped table-bordered table-hover">
			<thead>
			    <tr>
			    <th class="center" width="40px">No</th>
			    <th class="center">Kampus</th>
			    <th class="center">Tanggal</th>
			    <th class="center">Jam</th>
			    <th class="center" width="40px">Aksi</th>
			    </tr>
			</thead>
			<tbody>
			 <?php
			 	$qry = mysql_query("SELECT a.*,b.kNama FROM jadwal a
			 							  LEFT JOIN kampus b ON a.kId=b.kId 
			 							  WHERE a.id_dosen='$did' ORDER BY a.jTgl ASC");
				while ($d = mysql_fetch_array($qry)){
			      ?>
			      <tr>
			      <?php
			      $no++;
			      $jtgl = getTglIndo($d[jTgl]);
			      echo "
			      <td class='center'>$no</td>
			      <td class='center'>$d[kNama]</td>
			      <td class='center'>$jtgl</td>
			      <td class='center'>$d[jJam]</td>
			      <td class='center'>
		            <a href='?page=$npage&jmode=del&jid=$d[jId]' onclick='return qh();' class='tooltip-error' data-rel='tooltip' data-original-title='Delete'>
                   <span class='red'><i class='icon-trash bigger-120'></i></span>
                   </a>
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
	</div>
</div><!--span12-->
</div><!--row-fluid-->