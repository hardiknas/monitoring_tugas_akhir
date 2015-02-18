<ul class="nav nav-list">
	<li class="active"><a href="?page=home"><i class="icon-desktop"></i><span class="menu-text">Dashboard</span></a></li>
	<li><a href="?page=admin" class="dropdown-toggle"><i class="icon-user"></i><span class="menu-text">Setting Admin</span></a></li>
	<li><a href="?page=periode" class="dropdown-toggle"><i class="icon-cog"></i><span class="menu-text">Periode</span></a></li>
	<div class="sidebar-collapse" id=""></div>
	<li><a href="#" class="dropdown-toggle"><i class="icon-briefcase"></i><span class="menu-text">Dosen</span><b class="arrow icon-angle-down"></b></a>
		<ul class="submenu" style="display: none;">
			<li><a href="?page=dosen&act=tambah"><i class="icon-double-angle-right"></i>Tambah Dosen</a></li>
			<li><a href="?page=dosen"><i class="icon-double-angle-right"></i>Lihat Dosen</a></li>
		</ul>
	</li>
	<li><a href="#" class="dropdown-toggle"><i class="icon-group"></i><span class="menu-text">Mahasiswa</span><b class="arrow icon-angle-down"></b></a>
		<ul class="submenu" style="display: none;">
			<li><a href="?page=mahasiswa&act=tambah"><i class="icon-double-angle-right"></i>Tambah Mahasiswa</a></li>
			<li><a href="?page=mahasiswa"><i class="icon-double-angle-right"></i>Lihat Mahasiswa</a></li>
		</ul>
	</li>
	<li><a href="#" class="dropdown-toggle"><i class="icon-legal"></i><span class="menu-text">Judul Tugas Akhir</span><b class="arrow icon-angle-down"></b></a>
		<ul class="submenu" style="display: none;">
			<?php
				$jbaru = getNumRows("SELECT sId FROM skripsi WHERE sStatus='0'");
				if ($jbaru>0){
					$jb = "<span data-rel='tooltip' data-placement='right' data-original-title='$jnkonsul Judul Baru' class='badge badge-info'>
								$jbaru
							</span>";
				}else{
					$jb = "";
				}
			?>
			<li><a href="?page=jtabaru"><i class="icon-double-angle-right"></i>Baru Daftar <?php echo $jb;?></a></li>
			<li><a href="?page=jtaterdaftar"><i class="icon-double-angle-right"></i>Sudah Terdaftar</a></li>
		</ul>
	</li>
	<li><a href="#" class="dropdown-toggle"><i class="icon-calendar"></i><span class="menu-text">Jadwal Ujian</span><b class="arrow icon-angle-down"></b></a>
		<ul class="submenu" style="display: none;">
			<li><a href="?page=jsp"><i class="icon-double-angle-right"></i>Seminar Proposal</a></li>
			<li><a href="?page=juh"><i class="icon-double-angle-right"></i>Ujian Hasil</a></li>
			<li><a href="?page=jum"><i class="icon-double-angle-right"></i>Ujian Meja</a></li>
		</ul>
	</li>
	<li><a href="#" class="dropdown-toggle"><i class="icon-bullhorn"></i><span class="menu-text">Pengumuman</span><b class="arrow icon-angle-down"></b></a>
		<ul class="submenu" style="display: none;">
			<li><a href="?page=info&act=tambah"><i class="icon-double-angle-right"></i>Tambah Pengumuman</a></li>
			<li><a href="?page=info"><i class="icon-double-angle-right"></i>Lihat Pengumuman</a></li>
		</ul>
	</li>
	<li><a href="?page=lap" class="dropdown-toggle"><i class="icon-book"></i><span class="menu-text">Laporan</span></a></li>
</ul><!--/.nav-list-->