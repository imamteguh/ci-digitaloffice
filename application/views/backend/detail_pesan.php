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
            <h5>Detail Pesan</h5>
            <div class="toolbar">
                <button class="btn btn-danger btn-sm btn-line" data-toggle="collapse" data-target="#div2"><i class="icon-chevron-up"></i></button>
            </div>
        </header>
        <div class="body collapse in" id="div2">
                <a href="<?php echo site_url('pesan')?>"><button class="btn btn-default">Kembali</button></a>
                <a data-toggle="modal" data-target="#compose-modal"><button class="btn btn-default">Balas Pesan</button></a>
                <hr/>

            <div class="row">
                <div class="col-md-1">
                <img src="<?php echo base_url('uploads/images/'.$row['member_foto']) ?>" width="60">
                </div>
                <div class="col-md-11">
                <strong><?php echo $row['member_nama']?></strong> | <?php echo $row['member_email'] ?><br>
                <p style="padding:10px; background:#f4f4f4; border-radius:5px;"><?php echo $row['pesan_detail']?></p>
                </div>
            </div>
                <hr/>
                <?php
                if($row['pesan_lampiran']!=null) {
                    echo "Download : <a href='".base_url('uploads/lampiran/'.$row['pesan_lampiran'])."' class='btn btn-primary'>".$row['pesan_lampiran']."</a>";
                }
                ?>
        </div>
    </div>
</div>

<!-- COMPOSE MESSAGE MODAL -->
        <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="icon-envelope-alt icon-white"></i> Balas Pesan</h4>
                    </div>
                    <form action="<?php echo site_url('pesan')?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">TO:</span>
                                    <input name="email_to" type="email" class="form-control" placeholder="Masukan Email" value="<?= $row['member_email'] ?>" readonly>
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