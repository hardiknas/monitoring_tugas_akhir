<?php
	$page = $_GET['page'];
?>
<div class="row-fluid">
<div class="span12">	
<?php
if ($_GET[act]=="jadwal"){
?>
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
									echo "<img alt='$e[nama_lengkap]' src='images/photo.jpg'>";
								}else{
									echo "<img alt='$e[nama_lengkap]' src='foto_dosen/$e[foto]'>";
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
				      <td class='center'>$d[jJam]</td>";
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
<?php
}else{
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
		 <th class="center" width="70px">Jadwal</th>
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
	      <td class='center'>$d[nip]</td>
	      <td>$d[nama_lengkap]</td>
	      <td class='center'>$d[no_telp]</td>
	      <td class='hidden-480'>$d[email]</td>
	      <td class='center'>
            <a href='?page=$page&act=jadwal&did=$d[id_dosen]' class='tooltip-error' data-placement='left' data-rel='tooltip' data-original-title='Lihat Jadwal Dosen'>
            	<span class='blue'><i class='icon-calendar bigger-120'></i></span>
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
<?php
}
?>
</div>
</div>