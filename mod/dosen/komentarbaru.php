<?php
 $npage = $_GET['page'];
?>
<div class="row-fluid">
<div class="span12">
<?php
		if ($_GET['mode']=='baca'){
			mysql_query("UPDATE konsultasi SET kBaca='1'");
			echo "<script>
					setTimeout('window.location.href=\"media.php?page=$npage\"',100)
					</script>";
		}
		?>
		<div class="table-header">
		   DAFTAR KOMENTAR BARU PADA KONSULTASI
		</div>
		<div class="row-fluid">
		<table id="myTable" class="table table-striped table-bordered table-hover">
		<thead>
		    <tr>
		    <th class="center" width="30px">No</th>
		    <th class="center" width="80px">NIM</th>
		    <th class="center" width="150px">Nama</th>
		    <th class="center" width="110px">Tanggal</th>
		    <th class="center">Judul</th>
		    <th class="center" width="50px">File</th>
		    <th class="center" width="50px">Cek</th>
		    <th class="center" width="80px">Komentar</th>
		    </tr>
		</thead>
		<tbody>
		 <?php
		 	$qry = mysql_query("SELECT a.*,b.sJudul,b.mNim FROM konsultasi a
		 							  LEFT JOIN skripsi b ON a.sId=b.sId
		 							  WHERE a.dosId='$_SESSION[uId]' AND a.kId NOT IN 
		 							  	(SELECT c.kId FROM komentar c WHERE c.kkOleh!='$_SESSION[uId]' AND c.kkBaca='0')
		 							  ORDER BY a.kId DESC");
			while ($d = mysql_fetch_array($qry)){
		      $no++;
		      $arSt = array(
		      	"0" => "<span class='badge badge-warning'>Belum Diperiksa</span>",
		      	"1" => "<span class='badge badge-success'>Sudah Diperiksa</span>",
		      );
		      $mnama = getValue("mNama","mahasiswa","mNim='$d[mNim]'");
		      $kid=$d['kId'];
		      $st = $d['kBaca'];
		      $status = $arSt[$st];
		      $ktgl = getTglIndo(substr($d['kWaktu'], 0,10));
		      if ($d['kBaca']=='0'){
		      	$baca = "<a href='?page=$npage&mode=baca&kid=$kid' class='btn btn-mini btn-danger' data-rel='tooltip' data-placement='top' data-title='Klik Untuk Menandai Bahwa Berkas Sudah Diperiksa'>
			                  <i class='icon-check-empty bigger-120'></i>
			               </a>";
		      }else{
		      	$baca = "<a href='#' class='btn btn-mini btn-success' data-rel='tooltip' data-placement='top' data-title='Berkas Sudah Diperiksa'>
			                  <i class='icon-check bigger-120'></i>
			               </a>";
		      }


		      $jdkomen = getNumRows("SELECT a.kkId,b.kId FROM komentar a 
									  LEFT JOIN konsultasi b ON a.kId=b.kId
									  WHERE a.kkOleh!='$_SESSION[uId]' AND a.kkBaca='0' AND a.kId='$kid'");
				if ($jdkomen>0){
					$jdkon = "<a href='?page=bimbingan&act=komentar&kid=$kid' class='btn btn-mini btn-primary' data-rel='tooltip' data-placement='top' data-title='$jdkomen Komentar Baru'>
			                  $jdkomen <i class='icon-comments bigger-120'></i>
			               </a>";
				}else{
					$jdkon = "<a href='?page=bimbingan&act=komentar&kid=$kid' class='btn btn-mini btn-primary'>
			                  <i class='icon-comments bigger-120'></i>
			               </a>";
				}

		      echo "
		      <tr>
		      <td class='center'>$no</td>
		      <td class='center'>$d[mNim]</td>
		      <td>$mnama</td>
		      <td class='center'>$ktgl</td>
		      <td>$d[sJudul]</td>
		      <td class='center'>
		      	<a href='file/$d[kFile]' target='_blank' class='btn btn-mini btn-inverse' data-rel='tooltip' data-placement='top' data-title='Klik Untuk Melihat Berkas'>
			         <i class='icon-cloud-download bigger-120'></i>
			      </a>
		      </td>
		      <td class='center'>
		      	$baca
		      </td>
		      <td class='center'>
		      	$jdkon
		      </td>
		      </tr>";
		   }
		   ?>
		</tbody>
		</table>
		</div>
</div>
</div>