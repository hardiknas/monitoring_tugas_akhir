<?php
	$page = $_GET['page'];
	$thn = $_SESSION['sesPeriode'];
?>
<div class="row-fluid">
<div class="span12">
	<div class="table-header">
	   JADWAL SEMINAR PROPOSAL
	</div>
	<div class="row-fluid">
	<table id="myTable" class="table table-striped table-bordered table-hover">
	<thead>
	    <tr>
	    <th class="center" width="40px">No</th>
	    <th class="center" width="80px">NIM</th>
	    <th class="center" width="150px">Nama</th>
	    <th class="center">Judul</th>
	    <th class="center" width="350px">Jadwal Ujian</th>
	    <th class="center" width="100px">Cetak</th>
	    </tr>
	</thead>
	<tbody>
	 <?php
	 	$qry = mysql_query("SELECT a.*,b.sJudul FROM ujian_proposal a
	 							  LEFT JOIN skripsi b ON a.sId=b.sId
	 							  ORDER BY a.sId ASC");
		while ($d = mysql_fetch_array($qry)){
	      ?>
	      <tr>
	      <?php
	      $no++;
	      $mhs = getValue("mNama","mahasiswa","mNim='$d[mNim]'");
	      $tgl = getTglIndo($d[sTgl]);
	      $p1 = getValue("nama_lengkap","dosen","id_dosen='$d[sPenguji1]'");
	      $p2 = getValue("nama_lengkap","dosen","id_dosen='$d[sPenguji2]'");
	      $p3 = getValue("nama_lengkap","dosen","id_dosen='$d[sPenguji3]'");
	      echo "
	      <td class='center'>$no</td>
	      <td class='center'>$d[mNim]</td>
	      <td>$mhs</td>
	      <td>$d[sJudul]</td>
	      <td>
	      	Tanggal Ujian : $tgl<br>
	      	Jam : $d[sJam]<br>
	      	Tempat : $d[sT4]<br><br>

	      	No. SK : $d[sNoSK]<br>
	      	Penguji 1 : $p1<br>
	      	Penguji 2 : $p2<br>
	      	Penguji 3 : $p3<br>
	      </td>
	      <td class='center'>";
	      	$sid = $d['sId']
	      	?>
	      	<button class='btn btn-primary btn-mini' onclick="NewWindow('../cetak/sksp.php?sid=<?php echo $sid;?>','ZoomIn','850','550','yes');return false">
					<i class='icon-print bigger-100'></i> SK
				</button>
				<?php
				echo "
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