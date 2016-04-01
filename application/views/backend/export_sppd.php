<?php
$fn = $thn.$bln;
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=laporan_kegiatan_sppd".$fn.".xls");
$timp = array();
            $day = array();
            $ttl_days = getTotalDays($bln,$thn);
?>
<table border="1">
    <thead>
        <tr><th colspan="<?php echo ($ttl_days+2) ?>" align="center">DIGITALOFFICE KOTA BOGOR</th></tr>
        <tr><th colspan="<?php echo ($ttl_days+2) ?>" align="center">NAMA OPD : <?php echo strtoupper($dinas_nama) ?></th></tr>
        <tr><th colspan="<?php echo ($ttl_days+2) ?>" align="center"><?php echo strtoupper($title) ?></th></tr>
        <tr>
            <th width="30" rowspan="2" align="center" valign="top">No.</th>
            <th rowspan="2" width="20%" align="center" valign="top">Nama Pegawai</th>
            <th colspan="<?php echo $ttl_days ?>"><center>Tanggal</center></th>
        </tr>
        <tr>
            <?php
            for ($i=1; $i <= $ttl_days; $i++) { 
            	$timp[$i] = strtotime($thn.'-'.$bln.'-'.$i);
            	$day[$i] = date('D', $timp[$i]);
            	$clr = "";
            	if($day[$i]=="Sun" || $day[$i]=="Sat") {
            		$clr = "style='color:red; font-weight:bold' ";
            	}
            	echo "<th ".$clr." width='30' align='center'><strong>".$i."</strong></th>";
            }
            ?>
        </tr>
    </thead>
    <tbody>
    <?php
    if(!empty($user)):
    $no = 1;

    foreach ($user as $rows) {
    ?>
        <tr>
            <td align="center" valign="top"><?php echo $no; ?></td>
            <td width="240" align="left" valign="top"><?php echo $rows->member_nama; ?></td>
            <?php
            for ($i=1; $i <= $ttl_days ; $i++) { 
                $timp[$i] = strtotime($thn.'-'.$bln.'-'.$i);
                $day[$i] = date('D', $timp[$i]);
                $clrs = "";
                if($day[$i]=="Sun" || $day[$i]=="Sat") {
                    $clrs = "style='background:maroon' ";
                }
           		echo "<td align='center' valign='top' ".$clrs.">".getAbsenDataExport($thn,$bln,$i,$rows->member_id)."</td>";
            }
            ?>
        </tr>
    <?php
    $no++;
    }
    endif;
    ?>
    </tbody>
</table>

<style>
table {
    font-size: 10px;
}
.inp {
    padding: 5px;
    border:1px solid #ccc;
    color: #666;
}
.chosen-container { width: 100% !important; }
</style>