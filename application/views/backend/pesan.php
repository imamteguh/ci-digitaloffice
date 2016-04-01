<style type="text/css">
    .chosen-container { width: 100% !important; }
</style>

<div class="col-md-12">
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
    <div class="box">
        <header>
            <div class="icons"><i class="icon-inbox"></i></div>
            <h5>Pesan Masuk</h5>
            <div class="toolbar">
                <button class="btn btn-danger btn-sm btn-line" data-toggle="collapse" data-target="#div2"><i class="icon-chevron-up"></i></button>
            </div>
        </header>
        <div class="body collapse in" id="div2">
            <div class="row">
            <div class="col-md-3 col-sm-4">
                <!-- compose message btn -->
                <a class="btn btn-block btn-success" data-toggle="modal" data-target="#compose-modal"><i class="icon-pencil"></i> Buat Pesan</a>
                <br>
                <div style="margin-top: 15px;">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="#home-pills" data-toggle="tab"><i class="icon-inbox"></i> Pesan Masuk (<?php echo jmlpesan() ?>)</a></li>
                        <li><a href="#profile-pills" data-toggle="tab"><i class="icon-mail-forward"></i> Terkirim</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9 col-sm-8">

                <div class="tab-content" style="border:none;padding:0;">
                    <div class="tab-pane fade in active" id="home-pills">
                        <label><strong><i class="icon-inbox"></i> Pesan Masuk</strong></label>
                        <div class="table-responsive table-bordered">
                            <table class="table">
                                <thead>
                                    <tr align="center">
                                        <th width="140">Nama</th>
                                        <th>Detail Pesan</th>
                                        <th width="160">Tanggal Masuk</th>
                                        <th width="20">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if($inbox) {
                                    foreach ($inbox as $row) {
                                    $bg='';
                                    if($row->pesan_status == 0) { $bg='style="background-color:rgba(250,50,50,0.5);"';}
                                    ?>
                                    <tr <?php echo $bg;?> >
                                        <td><?= $row->member_nama ?></td>
                                        <td><a href="<?= site_url('pesan/detail/inbox/'.$row->pesan_id) ?>"><?= substr($row->pesan_detail, 0,150); ?></a></td>
                                        <td><?= $row->pesan_tanggal ?></td>
                                        <td><a href="<?php echo site_url('pesan/hapus/'.$row->pesan_id.'/pesan')?>" class="btn-xs btn-danger"><i class="icon-remove"></i></a></td>
                                    </tr>
                                <?php } } else { echo "<tr><td colspan='6'>Tida ada data...</td></tr>"; }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile-pills">
                        <label><strong><i class="icon-mail-forward"></i> Pesan Terkirim</strong></label>
                        <div class="table-responsive table-bordered">
                            <table class="table table-hover">
                                <thead>
                                    <tr align="center">
                                        <th width="140">Ke</th>
                                        <th>Detail Pesan</th>
                                        <th width="160">Tanggal Masuk</th>
                                        <th width="20">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if($terkirim) {
                                    foreach ($terkirim as $row) {
                                    ?>
                                    <tr>
                                        <td><?= $row->pesan_to ?></td>
                                        <td><a href="<?= site_url('pesan/detail/outbox/'.$row->pesan_id) ?>"><?= substr($row->pesan_detail, 0,150); ?></a></td>
                                        <td><?= $row->pesan_tanggal ?></td>
                                        <td><a href="<?php echo site_url('pesan/hapus/'.$row->pesan_id.'/pesan_out')?>" class="btn-xs btn-danger"><i class="icon-remove"></i></a></td>
                                    </tr>
                                <?php } } else { echo "<tr><td colspan='6'>Tida ada data...</td></tr>"; }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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
                                <select name="email_to" class="form-control chzn-select" id="combodinamis" style="width:100%">
                                <option value="">- Pilih -</option>
                                <?php
                                    foreach($member as $kat):
                                        echo '<option value="'.$kat['member_email'].'">'.$kat['member_nama'].'</option>';
                                    endforeach; 
                                ?>
                                </select>
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