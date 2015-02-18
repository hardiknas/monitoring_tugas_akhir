<div class="row-fluid">
<div class="span12">
	<div class="table-header">
	   JUDUL TUGAS AKHIR YANG DITERIMA
	</div>
	<div class="row-fluid">
	<table id="myTable" class="table table-striped table-bordered table-hover">
	<thead>
	    <tr>
	    <th class="center" width="40px">No</th>
	    <th class="center" width="80px">NIM</th>
	    <th class="center" width="150px">Nama</th>
	    <th class="center">Judul</th>
	    <th class="center" width="250px">Pembimbing</th>
	    </tr>
	</thead>
	<tbody>
	 <?php
	 	$qry = mysql_query("SELECT a.*,b.* FROM skripsi a
	 							  LEFT JOIN mahasiswa b ON a.mNim=b.mNim
	 							  WHERE a.sStatus='2' ORDER BY a.sId ASC");
		while ($d = mysql_fetch_array($qry)){
	      ?>
	      <tr>
	      <?php
	      $no++;
	      $tgl = getTglIndo($d[sTgl]);
	      $thn = substr($d[sTahun]);
	      $pem1 = getValue("nama_lengkap","dosen","id_dosen='$d[sPem1]'");
	      $pem2 = getValue("nama_lengkap","dosen","id_dosen='$d[sPem2]'");
	      echo "
	      <td class='center'>$no</td>
	      <td class='center'>$d[mNim]</td>
	      <td>$d[mNama]</td>
	      <td>$d[sJudul]</td>
	      <td>
	      	Pembimbing I : $pem1<br>
	      	Pembimbing II : $pem2
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