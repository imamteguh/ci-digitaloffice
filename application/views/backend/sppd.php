<div class="col-md-12">
	<div class="box warning">
		<header>
			<div class="icons"><i class="icon-search"></i></div>
	        <h5>Filter Kalender</h5>
		</header>
		<div class="body collapse in" id="div2">
			<a href="#" class="pull-right btn btn-danger btn-rect btn-sm" data-toggle="modal" data-target="#add-modal">+ Tambah Jadwal</a>
			<form method="get" action="<?php echo site_url('sppd/index');?>">
				<input type="text" name="tahun" class="inp" placeholder="Tahun">
				<select name="bulan" class="inp">
					<?php
					for ($i=1; $i <= 12  ; $i++) { 
                        if(strlen($i)==1) {
                            $i = "0".$i;
                        }
						echo "<option value='".$i."'>".bulan($i)."</option>";
					}
					?>
				</select>
				<button type="submit" class="btn btn-rect btn-info btn-sm">Go</button>
			</form>
		</div>
	</div>
</div>
<div class="col-md-12" style="width:1300px;">
<?php
if($this->session->flashdata('sukses')) {
    echo '<div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            '.$this->session->flashdata('sukses').'
                        </div>';
}
if($this->session->flashdata('error')) {
    echo '<div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            '.$this->session->flashdata('error').'
                        </div>';
}
?>
<div class="box primary" style="background:#fff;">
    <header>
        <div class="icons"><i class="icon-calendar"></i></div>
        <h5></h5>
        <div class="toolbar">
            <button class="btn btn-success btn-sm btn-rect" data-toggle="collapse" data-target="#div3"><i class="icon-chevron-up"></i></button>
        </div>
    </header>
    <div class="body collapse in" id="div3">
        <div>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="20" rowspan="2">No.</th>
                        <th rowspan="2" width="20%">Nama Pegawai</th>
                        <th colspan="31"><center>Tanggal</center></th>
                    </tr>
                    <tr>
                        <?php
                        $timp = array();
                        $day = array();
                        $ttl_days = getTotalDays($bln,$thn);
                        for ($i=1; $i <= $ttl_days; $i++) { 
                        	$timp[$i] = strtotime($thn.'-'.$bln.'-'.$i);
                        	$day[$i] = date('D', $timp[$i]);
                        	$clr = "";
                        	if($day[$i]=="Sun" || $day[$i]=="Sat") {
                        		$clr = "style='color:red; font-weight:bold' ";
                        	}
                        	echo "<th ".$clr." width='30'><strong>".$i."</strong></th>";
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
                        <td><?php echo $no; ?></td>
                        <td><?php echo $rows->member_nama; ?></td>
                        <?php
                        for ($i=1; $i <= $ttl_days ; $i++) {
                            $timp[$i] = strtotime($thn.'-'.$bln.'-'.$i);
                            $day[$i] = date('D', $timp[$i]);
                            $clrs = "";
                            if($day[$i]=="Sun" || $day[$i]=="Sat") {
                                $clrs = "style='background:maroon' ";
                            }
                       		echo "<td align='center' ".$clrs."><div class='tooltip-demo'>".getAbsen($thn,$bln,$i,$rows->member_id)."</div></td>";
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
        </div>

        <a href="<?php echo site_url('sppd/views/export?tahun='.$thn.'&bulan='.$bln) ?>" class="btn btn-success"><i class="fa fa-download"></i> Export Excel</a>           
    </div>
</div>
</div>
<!-- COMPOSE MESSAGE MODAL -->
        <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="icon-plus icon-white"></i> Tambah Jadwal</h4>
                    </div>
                    <form action="<?php echo site_url('sppd/simpan')?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="penginput" value="<?php echo $member_id ?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <select name="member" class="form-control chzn-select" id="combodinamis" style="width:100%" required>
                                <option value="">- Ketikan nama disini -</option>
                                <?php
                                    foreach($user as $kat):
                                        echo '<option value="'.$kat->member_id.'">'.$kat->member_nama.'</option>';
                                    endforeach; 
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea name="kegiatan" id="kegiatan" class="form-control" placeholder="Kegiatan atau keterangan" style="height: 120px;" required></textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" name="tanggal" class="form-control" placeholder="Tanggal" id="dp3" data-date-format="yyyy-mm-dd" required/>
                            </div>

                        </div>
                        <div class="modal-footer clearfix">

                            <button type="reset" class="btn btn-danger"><i class="icon-refresh"></i> Reset</button>

                            <button type="submit" class="btn btn-primary"><i class="icon-save"></i> Simpan</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
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