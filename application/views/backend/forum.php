<div class="col-md-11">
    <ul class="breadcrumb">
        <li><a href="<?php echo site_url()?>"><i class="icon-home"></i> Home</a></li>
        <li><a href="<?php echo site_url('forum')?>">Forum Kategori</a></li>
        <?php 
        if($kategori['ktforum_parent']!=0) {
        ?>
        <li><a href="<?php echo site_url('forum/kategori/'.$kategori['ktforum_parent'])?>">Sub Forum Kategori</a></li>
        <?php
        }
        ?>
        <li><?php echo $kategori['ktforum_judul'] ?></li>
    </ul>
</div>
<div class="col-md-11">
    
    <div class="kategoriforum">
        <a href="#" class="btn btn-info pull-right" data-toggle="modal" data-target="#creat-post"><strong><i class="icon-edit"></i> Kirim Opini </strong></a>
        <h3 style="padding-top:10px; margin:0;"><strong><?php echo $kategori['ktforum_judul']?></strong></h3>
        <hr/>
        <p><?php echo $kategori['ktforum_keterangan']?></p>
    </div>

    <?php
    if($listview->num_rows()>0) {
        foreach ($listview->result() as $rows) {
    ?>
    <div class="panel panel-primary box-forum">
        <div class="panel-heading box-forum-heading">
            <i class="icon-check"></i> <?php echo $rows->tanggal; ?>
        </div>
        <div class="panel-body" style="padding:0px;">
            <div class="box-forum-kiri">
                <img src="<?php echo base_url()?>uploads/images/<?php echo $rows->member_foto ?>" class="img-thumbnail img-responsive" width="100">
                <div>
                    <a href="#"><strong><?php echo $rows->member_nama?></strong></a>
                    <p><?php echo $rows->dinas_nama ?></p>
                </div>
            </div>
            <div class="box-forum-kanan">
                <?php
                if($rows->gambar!="") {
                    echo "<center><img src='".base_url('uploads/forum/'.$rows->gambar)."' width='230' class='img-responsive img-thumbnail' ></center>";
                }
                ?>
                <p><?php echo $rows->posting ?></p>

                <?php
                $komen = get_komen($rows->diskusi_id);
                if($komen->num_rows()>0) {
                    foreach ($komen->result() as $km) {
                ?>
                <p class="kop-komen">
                    <span class="pull-right">
                        <?php
                        if($member_id==$rows->member_id || $km->member_id==$member_id) {
                            ?>
                            <a onclick="return confirm('Anda yakin hapos komentar ini???')" href="<?php echo site_url('forum/deletekomen/'.$km->komen_id."/".md5($rows->member_id)."/".$kategori['ktforum_id'])?>"><i class="icon-remove"></i> Hapus</a>
                            <?php
                        }
                        ?>
                    </span>
                    Komentar : <?php echo $km->member_nama.', on '.$km->tanggal ?>
                </p>
                <div class="komentar">
                    <p><?php echo $km->komentar ?></p>
                </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="panel-footer clearfix">
            ...
            <div class="pull-right">
                <a href="#" data-toggle="modal" data-target="#komen-post<?php echo $rows->diskusi_id?>"><i class="icon-comments"></i> Respon </a>|
                <?php
                if($member_id==$rows->member_id) {
                    ?>
                    <a onclick="return confirm('Anda yakin hapos posting ini???')" href="<?php echo site_url('forum/delete/'.$rows->diskusi_id."/".md5($rows->member_id))?>"><i class="icon-trash"></i> Hapus</a>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php
        }
    }
    echo $this->pagination->create_links();
    ?>



</div>
<!-- COMPOSE MESSAGE MODAL -->
        <div class="modal fade" id="creat-post" tabindex="-1" role="dialog" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Kirim Opini</h4>
                    </div>
                    <form action="<?php echo site_url('forum/post')?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="member_id" value="<?php echo $member_id ?>">
                    <input type="hidden" name="ktforum_id" value="<?php echo $kategori['ktforum_id'] ?>">
                        <div class="modal-body">
                            <div class="form-group"> 
                                <textarea name="posting" class="form-control" placeholder="Message" style="height: 200px;" required></textarea>
                            </div>
                            <div class="form-group">
                                <input type="file" name="gambar" class="btn-sm btn-success" />
                                <p class="help-block">Max. 2MB</p>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
<?php
    if($listview->num_rows()>0) {
        foreach ($listview->result() as $rows) {
    ?>
<!-- COMPOSE MESSAGE MODAL -->
        <div class="modal fade" id="komen-post<?php echo $rows->diskusi_id?>" tabindex="-1" role="dialog" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Respon Opini Ini</h4>
                    </div>
                    <form action="<?php echo site_url('forum/comment/'.$kategori['ktforum_id'])?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="member_id" value="<?php echo $member_id ?>">
                    <input type="hidden" name="diskusi_id" value="<?php echo $rows->diskusi_id ?>">
                        <div class="modal-body">
                            <div class="form-group"> 
                                <textarea name="komentar" class="form-control" placeholder="" style="height: 200px;" required></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
<?php
    }
}
?>

