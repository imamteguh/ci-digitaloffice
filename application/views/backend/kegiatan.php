<div class="col-md-6">
<div class="box warning">
    <header><h5>Filter Kegiatan</h5></header>
    <div class="body">
        <div class="row">
            <form method="post" action="<?php echo site_url('kegiatan/short') ?>">
            <div class="col-md-4">
              <input type="text" placeholder="Tanggal mulai" name="tgl1" class="form-control" id="dp2" data-date-format="yyyy-mm-dd">
            </div>
              <label class="col-md-1">s/d</label>
            <div class="col-md-4">
              <input type="text" placeholder="Tanggal akhir" name="tgl2" class="form-control" id="dp3" data-date-format="yyyy-mm-dd">
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-flat btn-primary">Filter</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
<br><br><br><br><br><br>
<div class="col-md-12">
<div class="box primary">
	<header><h5>Daftar Kegiatan 
        <?php
        if($tgl1) {
            echo "Tanggal ".$tgl1." sampai ".$tgl2;
        }
        ?>
    </h5>
    <div class="toolbar">
        <a href="<?php echo site_url('laporan/exporttoexcel?tglmulai='.$tgl1.'&tglakhir='.$tgl2)?>" class="btn btn-success btn-sm"><i class="icon-download"> Download excel</i></a>
    </div>
    </header>
    <div class="body">
        <div class="table-responsive">
        	<?php echo $this->session->flashdata('v')?>
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th width="150px">Waktu</th>
                        <th>Kategori Pekerjaan</th>
                        <th>Detail Pekerjaan</th>
                        <th>Keterangan</th>
                        <th>Pengaturan</th>
                    </tr>
                </thead>
                <tbody>
                	<?php $no=1;foreach($query as $que):?>
                    <tr class="odd gradeX">
                        <td><?php echo $no?></td>
                        <td>
							<?php 
								$bul = explode("-", $que['kegiatan_tanggal']);
								echo $que['kegiatan_hari'].', '.substr($que['kegiatan_tanggal'],8,2).' '.konbul($bul[1]).' '.substr($que['kegiatan_tanggal'],0,4).' '.substr($que['kegiatan_tanggal'],11,12);
							?>
                        </td>
                        <td><?php echo $que['kategori_nama']?></td>
                        <td><?php echo $que['kegiatan_rincian']?></td>
                        <td><?php echo $que['kegiatan_keterangan']?></td>
                        <td align="center">
                        	<div class="tooltip-demo">
                            <a href="<?php echo site_url('kegiatan/index/'.$que['kegiatan_id'].'/edit')?>" class="btn btn-xs btn-warning"data-toggle="tooltip" data-placement="left" title="Edit"><i class="icon-edit"></i></a>
                            <a onclick="return confirm('Apakah yakin menghapus <?php echo $que['kegiatan_rincian']?> ?')" href="<?php echo site_url('kegiatan/delete/'.$que['kegiatan_id'].'/hapus')?>" data-toggle="tooltip" data-placement="left" title="Hapus" class="btn btn-xs btn-danger"><i class="icon-remove"></i></a>
                        	</div>
                        </td>
                    </tr>
                    <?php $no++;endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<hr />
<div class="box success">
	<header><h5>Form Isian Kegiatan</h5></header>
    <div class="body">
    	<form method="post" action="<?php echo site_url('kegiatan/index')?>">
        	<input type="hidden" name="idid" value="<?php echo $row['kegiatan_id']?>" />
        	<div class="form-group">
            	
            	<label>Hari</label>
				
                <select name="hari" class="form-control">
                	<option value="">- Pilih -</option>
                    <?php
						$harii = array('Senin','Selasa','Rabu','Kamis','Jum`at','Sabtu','Minggu');
						
						foreach($harii as $hr) {
							if($row['kegiatan_hari'] == $hr || $this->input->post('hari') == $hr){
								echo '<option selected="selected">'.$hr.'</option>';
							}else{
								echo '<option>'.$hr.'</option>';
							}
						}
					?>
                </select>
            </div>
            
            <?php echo form_error('hari',' ');?>
            
            <div class="form-group">
            	<label>Tanggal</label>
                <div class="row">
                	<div class="col-md-6">
                    	<div class="input-group input-append date" id="dp4" data-date="<?php echo substr($row['kegiatan_tanggal'],0,10)?>" data-date-format="yyyy-mm-dd">
                            <input class="form-control add-on" name="tanggal" type="text" value="<?php echo substr($row['kegiatan_tanggal'],0,10)?>">
                            <span class="input-group-addon"><i class="icon-calendar"></i></span>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                    	<div class="input-group bootstrap-timepicker">
                            <input class="timepicker-24 form-control" name="jam" type="text" value="<?php echo substr($row['kegiatan_tanggal'],10,8)?>" />
                            <span class="input-group-addon"><i class="icon-time"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php echo form_error('tanggal')?>
            
            <div class="form-group">
            	<label>Kategori Kegiatan</label>
                <select name="kategori" class="form-control chzn-select" id="combodinamis">
                	<option value="">- Pilih -</option>
                    <?php
						foreach($ktg as $kat):
							if($kat['kategori_id'] == $row['kegiatan_kategori_id'] || $kat['kategori_id'] == $this->input->post('kategori')):
								echo '<option selected="selected" value="'.$kat['kategori_id'].'">'.$kat['kategori_nama'].'</option>';
							else:
								echo '<option value="'.$kat['kategori_id'].'">'.$kat['kategori_nama'].'</option>';
							endif;							
						endforeach; 
					?>
				</select>
                <input type="hidden" id="sembunyi" value="<?php if($row['kegiatan_kategori_id']==""){echo $this->input->post('kategori');}else{echo $row['kegiatan_kategori_id'];};?>" />
            </div>
            
            <?php echo form_error('kategori',' ');?>
                        
            <div class="form-group" id="hasil">
            </div>
            <?php 
				$kegi['rincian'] = $row['kegiatan_rincian'];
				$this->session->set_userdata($kegi);
			?>
            <div class="form-group">
            	<label>Keterangan Kegiatan</label>
                <textarea id="autosize" name="keterangan" class="form-control"><?php if($row['kegiatan_keterangan']==""){echo $this->input->post('keterangan');}else{echo $row['kegiatan_keterangan'];};?></textarea>
                
            </div>
            <?php echo form_error('keterangan', '<div class="alert alert-danger">Keterangan Kegiatan belum di isi.</div>');?>
            
            <div class="form-group">
            	<button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-primary">Reset</button>
            </div>
        </form>
    </div>
</div>
</div>
<style type="text/css">
	.wakwaw option{
}
</style>
<!-- PAGE LEVEL SCRIPTS -->
<script type="text/javascript">


	var smb = document.getElementById("sembunyi").value;
	if(smb == ""){
		$('#hasil').load("<?php echo site_url('kegiatan/blank')?>");
	}else {
		$('#hasil').load("<?php echo site_url('kegiatan/getkategori?kode=')?>" + smb);
	}
	
	$('#combodinamis').change(function(){
		
		var selected = $('#combodinamis').val();
		$('#hasil').load("<?php echo site_url('kegiatan/getkategori?kode=')?>" + selected);
	});
</script>