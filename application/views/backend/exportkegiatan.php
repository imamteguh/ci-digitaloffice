<!DOCTYPE html>
<html>
  <head>
  	<meta charset="UTF-8">
  	<title><?php echo $title ?></title>
  	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  	<style type="text/css">
    body {
      font-size: 12px;
      font-family: calibri;
    }
    .ct td {
      padding: 5px;
    }
    .ct th {
      padding: 5px;
    }
  	</style>
  </head>
  <body>
    <table width="1200">
      <tr><td align="center">DIGITALOFFICE KOTA BOGOR</td></tr>
      <tr><td align="center">NAMA OPD : <?php echo strtoupper($dinas_nama) ?></td></tr>
      <tr><td align="center">Dari Tgl : <?php echo date('d-m-Y', strtotime($tgl1)).' Sampai Dengan Tgl '.date('d-m-Y', strtotime($tgl2)) ?></td></tr>
    </table>
    <br>
  	<table width="1200" border="1" class="ct">
  		<tr style='background:#cfcfcf'>
  			<th align="center">No</th>
        <th width="150px" align="center">Tanggal</th>
        <th width="100px" align="center">Waktu</th>
        <!-- <th>Kategori Pekerjaan</th> -->
        <th>Detail Pekerjaan</th>
        <th>Keterangan</th>
  		</tr>
  		<?php
          if($listview) {
            $no = 1;
            foreach ($listview->result_array() as $que) {
              $bg = "style='background:transparent'";
              if($no%2==0) {
                $bg = "style='background:#cfcfcf'";
              }
              echo "<tr $bg >";
              ?>
              <td align="center"><?php echo $no ?></td>
              <td align="center">
              <?php 
                $bul = explode("-", $que['kegiatan_tanggal']);
                echo $que['kegiatan_hari'].', '.substr($que['kegiatan_tanggal'],8,2).' '.konbul($bul[1]).' '.substr($que['kegiatan_tanggal'],0,4);
              ?>
              </td>
              <td align="center"><?php echo substr($que['kegiatan_tanggal'],11,12) ?></td>
              <!-- <td><?php //echo $que['kategori_nama']?></td> -->
              <td><?php echo $que['kegiatan_rincian']?></td>
              <td><?php echo $que['kegiatan_keterangan']?></td>
              <?php
              echo "</tr>";
              $no++;
            }
          }
          ?>
  	</table>
  </body>
</html>
<!-- copyright @ Imam Teguh -->