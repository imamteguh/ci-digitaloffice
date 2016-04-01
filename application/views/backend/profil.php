<?php 
//Programmer : Hikmahtiar dan Imam Teguh
//Copyright  : 2014

if($rows['member_id']=="")redirect('admain')?>

<div class="col-md-12">
	<div class="row">
		<div class="col-md-3">
			<div class="box primary">
				<header><h5>Foto Profil</h5></header>
				<div class="body">
					<center><img src="<?php echo base_url('uploads/images/'.$rows['member_foto'])?>" class="img img-thumbnail" width="200px"></center>
				</div>
			</div>
		</div>

		<div class="col-md-9">
			<div class="box primary">
				<header><h5>Form Detail</h5></header>
				<div class="body">
					<table class="table table-bordered table-striped">
						<tr>
							<th>NIP</th>
							<th>Nama</th>
							<th>Jabatan</th>
							<th>Email</th>
							<th>Telepon</th>
							<th>#</th>
						</tr>
						<tr>
							<td><?php echo $rows['member_nip']?></td>
							<td><?php echo $rows['member_nama']?></td>
							<td><?php echo $rows['jabatan_nama']?></td>
							<td><?php echo $rows['member_email']?></td>
							<td><?php echo $rows['member_tlp']?></td>
							<td><a data-toggle="modal" data-target="#compose-modal" href="#">Kirim Pesan</a></td>
						</tr>
					</table>
				</div>
			</div>
		</div>

		

	</div>
</div>

<div class="col-md-12">
	<div class="panel panel-primary">
		<div class="panel-heading">
            <button class="btn btn-warning btn-sm btn-rect" data-toggle="collapse" data-target="#div3"><i class="icon-chevron-up"></i></button>
            Daftar Kegiatan <b><?php echo $rows['member_nama']?></b>
		</div>
		<div class="panel-body" id="div3">
			<div class="table-responsive">
		        <table class="table table-striped table-hover table-bordered" id="dataTables-example" aria-describedby="dataTables-example_info">
		            <thead>
		                <tr>
		                	<th>No</th>
		                    <th style="width:190px;">Waktu</th>
		                    <th>Kategori Kegiatan</th>
		                    <th>Detail Kegiatan</th>
		                    <th>Keterangan</th>
		                </tr>
		            </thead>
		            <tbody>
		            	<?php $no=1;foreach($kegiatan as $que) {?>
		            	<tr>
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
		                </tr>
		                <?php $no++;}?>
		           </tbody>
		        </table>
		    </div>
		</div>
    </div>
</div>




<!-- COMPOSE MESSAGE MODAL -->
        <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="icon-envelope-alt icon-white"></i> Compose New Message</h4>
                    </div>
                    <form action="<?php echo site_url('pesan')?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">TO:</span>
                                    <input name="email_to" type="email" class="form-control" value="<?php echo $rows['member_email']?>" placeholder="Masukan Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="pesan_detail" id="email_message" class="form-control" placeholder="Message" style="height: 120px;"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="file" name="lampiran" class="btn-sm btn-success" />
                                <p class="help-block">Max. 32MB</p>
                            </div>

                        </div>
                        <div class="modal-footer clearfix">

                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-times"></i> Discard</button>

                            <button type="submit" class="btn btn-primary pull-left"><i class="icon-envelope"></i> Send Message</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->