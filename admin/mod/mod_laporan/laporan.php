<div class="row-fluid">
<div class="span12">	
	<div class="table-header">
	   LAPORAN
	</div>
	<div class="row-fluid">
	<table id="myTable" class="table table-striped table-bordered table-hover">
	<thead>
	   <tr>
	   <th class="center" width="40px">No</th>
	   <th class="center" width="400px">Nama Laporan</th>
		<th class="center">Tahun</th>
		<th class="center">Jurusan</th>
	   <th class="center" width="200px">Aksi</th>
	   </tr>
	</thead>
	<tbody>
	 	<tr>
		   <td class="center">1</td>
		   <td class="center">Laporan TA Yang Diterima</td>
		   <form action="../cetak/lapjterima.php" method="GET" target="_blank">
		   <td class="center">
		   	<select class="chosen-select span2" id="thn" name="thn" data-placeholder="Semua">
		   		<option value=""></option>
		   		<option value="">Semua</option>
					<?php
					$qd = mysql_query("SELECT DISTINCT a.pTahun FROM periode a ORDER BY a.pTahun ASC");
					while($md=mysql_fetch_array($qd)){
						echo "<option value='$md[pTahun]'>$md[pTahun]</option>";
					}
					?>
				</select>
		   </td>
		   <td class="center">
		   	<select class="chosen-select span2" id="jur" name="jur" data-placeholder="Semua">
		   		<option value=""></option>
		   		<option value="">Semua</option>
					<?php
					$qd = mysql_query("SELECT *  FROM jurusan a");
					while($md=mysql_fetch_array($qd)){
						echo "<option value='$md[jId]'>$md[jNama]</option>";
					}
					?>
				</select>
		   </td>
		   <td class="center">
		   	<button class='btn btn-primary btn-small' type="submit">
					<i class='icon-print bigger-100'></i> Cetak
				</button>
			</td>
			</form>
	   </tr>
	   <tr>
		   <td class="center">2</td>
		   <td class="center">Laporan Seminar Proposal</td>
		   <form action="../cetak/lapsp.php" method="GET" target="_blank">
		   <td class="center">
		   	<select class="chosen-select span2" id="thn" name="thn" data-placeholder="Semua">
		   		<option value=""></option>
		   		<option value="">Semua</option>
					<?php
					$qd = mysql_query("SELECT DISTINCT a.pTahun FROM periode a ORDER BY a.pTahun ASC");
					while($md=mysql_fetch_array($qd)){
						echo "<option value='$md[pTahun]'>$md[pTahun]</option>";
					}
					?>
				</select>
		   </td>
		   <td class="center">
		   	<select class="chosen-select span2" id="jur" name="jur" data-placeholder="Semua">
		   		<option value=""></option>
		   		<option value="">Semua</option>
					<?php
					$qd = mysql_query("SELECT *  FROM jurusan a");
					while($md=mysql_fetch_array($qd)){
						echo "<option value='$md[jId]'>$md[jNama]</option>";
					}
					?>
				</select>
		   </td>
		   <td class="center">
		   	<button class='btn btn-primary btn-small' type="submit">
					<i class='icon-print bigger-100'></i> Cetak
				</button>
			</td>
			</form>
	   </tr>
	   <tr>
		   <td class="center">3</td>
		   <td class="center">Laporan Ujian Hasil</td>
		   <form action="../cetak/lapuh.php" method="GET" target="_blank">
		   <td class="center">
		   	<select class="chosen-select span2" id="thn" name="thn" data-placeholder="Semua">
		   		<option value=""></option>
		   		<option value="">Semua</option>
					<?php
					$qd = mysql_query("SELECT DISTINCT a.pTahun FROM periode a ORDER BY a.pTahun ASC");
					while($md=mysql_fetch_array($qd)){
						echo "<option value='$md[pTahun]'>$md[pTahun]</option>";
					}
					?>
				</select>
		   </td>
		   <td class="center">
		   	<select class="chosen-select span2" id="jur" name="jur" data-placeholder="Semua">
		   		<option value=""></option>
		   		<option value="">Semua</option>
					<?php
					$qd = mysql_query("SELECT *  FROM jurusan a");
					while($md=mysql_fetch_array($qd)){
						echo "<option value='$md[jId]'>$md[jNama]</option>";
					}
					?>
				</select>
		   </td>
		   <td class="center">
		   	<button class='btn btn-primary btn-small' type="submit">
					<i class='icon-print bigger-100'></i> Cetak
				</button>
			</td>
			</form>
	   </tr>
	   <tr>
		   <td class="center">4</td>
		   <td class="center">Laporan Ujian Meja</td>
		   <form action="../cetak/lapum.php" method="GET" target="_blank">
		   <td class="center">
		   	<select class="chosen-select span2" id="thn" name="thn" data-placeholder="Semua">
		   		<option value=""></option>
		   		<option value="">Semua</option>
					<?php
					$qd = mysql_query("SELECT DISTINCT a.pTahun FROM periode a ORDER BY a.pTahun ASC");
					while($md=mysql_fetch_array($qd)){
						echo "<option value='$md[pTahun]'>$md[pTahun]</option>";
					}
					?>
				</select>
		   </td>
		   <td class="center">
		   	<select class="chosen-select span2" id="jur" name="jur" data-placeholder="Semua">
		   		<option value=""></option>
		   		<option value="">Semua</option>
					<?php
					$qd = mysql_query("SELECT *  FROM jurusan a");
					while($md=mysql_fetch_array($qd)){
						echo "<option value='$md[jId]'>$md[jNama]</option>";
					}
					?>
				</select>
		   </td>
		   <td class="center">
		   	<button class='btn btn-primary btn-small' type="submit">
					<i class='icon-print bigger-100'></i> Cetak
				</button>
			</td>
			</form>
	   </tr>
	</tbody>
	</table>
	</div>
</div>
</div>