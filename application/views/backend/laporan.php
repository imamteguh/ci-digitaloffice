<?php
//Programmer : Hikmahtiar dan Imam Teguh
//Copyright  : 2014
?>
<style type="text/css">
.calendar {
	font-family: Arial, Verdana, Sans-serif;
	width: 100%;
	min-width: 960px;
	border-collapse: collapse;
}

.calendar tbody tr:first-child th {
	color: #505050;
	margin: 0 0 10px 0;
}

.day_header {
	font-weight: normal;
	text-align: center;
	color: #757575;
	font-size: 10px;
}

.calendar td {
	width: 14%; /* Force all cells to be about the same width regardless of content */
	border:1px solid #CCC;
	/* height: 65px; */
	vertical-align: top;
	font-size: 10px;
	padding: 0;
}
.calendar th {
	font-size: 14px;
}

.calendar td:hover {
	background: #F3F3F3;
}

.day_listing {
	display: block;
	text-align: right;
	font-size: 22px;
	color: #2C2C2C;
	padding: 10px 10px 25px 0;
	text-decoration:none;
}

div.today {
	background: #E9EFF7;
	height: 100%;
}
</style>
<div class="col-md-12">
	<div class="box primary">
        <header>
            <h5>Kalender</h5>
            <div class="toolbar">
                <button class="btn btn-success btn-sm btn-rect" data-toggle="collapse" data-target="#kld"><i class="icon-chevron-up"></i></button>
            </div>
        </header>
        
        <div class="body in" id="kld">
			<?php echo $calendar; ?>
		</div>
    </div>
</div>
<div class="col-md-12">
	<!--<div class="alert" style="background:pink">Fungsi</div>-->
    
    <div class="box primary">
        <header>
            
            <h5>Laporan Kegiatan</h5>
            <div class="toolbar">
                <button class="btn btn-success btn-sm btn-rect" data-toggle="collapse" data-target="#div3"><i class="icon-chevron-up"></i></button>
            </div>
        </header>
        
        <div class="body in" id="div3">

            <!--<div class="alert"><a href="<?php echo site_url('laporan/excel')?>"><i class="icon-file-text-alt"></i> Cetak to Excel</a></div>-->

            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered" id="dataTables-example" aria-describedby="dataTables-example_info">
                    <thead>
                        <tr>
                        	<th>No</th>
                            <th style="width:190px;">Waktu</th>
                            <th>Detail Kegiatan</th>
                            <th>Keterangan</th>
                            <th style="width:100px;">Author</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php $no=1;foreach($query as $que) {?>
                    	<tr>
                            <td><?php echo $no?></td>
                            <td>
								<?php 
								$bul = explode("-", $que['kegiatan_tanggal']);
								echo $que['kegiatan_hari'].', '.substr($que['kegiatan_tanggal'],8,2).' '.konbul($bul[1]).' '.substr($que['kegiatan_tanggal'],0,4).' '.substr($que['kegiatan_tanggal'],11,12);
							?>
                            </td>
                            <td><?php echo $que['kegiatan_rincian']?></td>
                            <td><?php echo $que['kegiatan_keterangan']?></td>
                            <td>
                                <div class="tooltip-demo">
                                <a href="<?php echo site_url('profil/index/'.$que['member_id'].'')?>" class="btn btn-xs btn-primary "data-toggle="tooltip" data-placement="left" title="Detail User"><?php echo $que['member_nama']?></a>
                                </div>
                            </td>
                        </tr>
                        <?php $no++;}?>
                   </tbody>
                </table>
                
            </div>           
        </div>
    </div>
    
    
</div>