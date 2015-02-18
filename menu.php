<ul class="nav nav-list">
	<li class="active"><a href="index.php"><i class="icon-external-link"></i><span class="menu-text">Halaman Utama</span></a></li>
	<li><a href="?page=home"><i class="icon-home"></i><span class="menu-text">Beranda</span></a></li>
	<div class="sidebar-collapse" id=""></div>
	<?php
	if ($_SESSION['uLevel']==2){
		$jnkonsul = getNumRows("SELECT kId FROM konsultasi WHERE dosId='$_SESSION[uId]' AND kBaca='0'");
		if ($jnkonsul>0){
			$jkon = "<span data-rel='tooltip' data-placement='right' data-original-title='$jnkonsul Konsultasi Belum Diperiksa' class='badge badge-info'>
							$jnkonsul
						</span>";
		}else{
			$jkon = "";
		}
	?>
		<li><a href="?page=bimbingan" class="dropdown-toggle"><i class="icon-cloud-download"></i><span class="menu-text">Bimbingan <?php echo $jkon;?></span></a></li>
		<li><a href="?page=jadwal" class="dropdown-toggle"><i class="icon-calendar"></i><span class="menu-text">Jadwal Bimbingan</span></a></li>
	<?php
	}else{
		$cjudul = mysql_num_rows(mysql_query("SELECT * FROM skripsi WHERE sStatus='2' AND mNim='$_SESSION[uId]'"));
  		if($cjudul>0){
  			$jnkomen = getNumRows("SELECT a.kkId,b.sId,c.sId FROM komentar a
  										  LEFT JOIN konsultasi b ON a.kId=b.kId
  										  LEFT JOIN skripsi c ON b.sId=c.sId
  										  WHERE a.kkOleh!='$_SESSION[uId]' AND a.kkBaca='0' AND c.mNim='$_SESSION[uId]'");
			if ($jnkomen>0){
				$jkom = "<span  data-rel='tooltip' data-placement='right' data-original-title='$jnkonsul Komentar Baru' class='badge badge-info'>
								$jnkomen
							</span>";
			}else{
				$jkom = "";
			}
  			echo "<li><a href='?page=konsul' class='dropdown-toggle'><i class='icon-cloud-upload'></i><span class='menu-text'>Konsultasi $jkom</span></a></li>";
  		}
  		?>
		<li><a href="?page=dosen" class="dropdown-toggle"><i class="icon-group"></i><span class="menu-text">Info Dosen</span></a></li>
		<li><a href="?page=ljudul" class="dropdown-toggle"><i class="icon-check"></i><span class="menu-text">Judul Yang Diterima</span></a></li>
	<?php
	}
	?>
	<div class="sidebar-collapse" id=""></div>
</ul><!--/.nav-list-->