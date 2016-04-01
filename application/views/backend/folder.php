<link href="<?php echo base_url() ?>assets/css/skin-xp/ui.easytree.css" rel="stylesheet" />
<script src="<?php echo base_url() ?>assets/js/jquery.easytree.min.js"></script>
<!--<script type="text/javascript">
    /*var auto_refresh = setInterval(
    function ()
    {
    $('#direktori').load('<?php echo site_url("filemanager/direktori") ?>').fadeIn("slow");
    }, 1000); // refresh every 10000 milliseconds
*/
</script> -->
<div class="col-lg-3">
    <div class="box">
        <header><h5>Navigasi</h5></header>
        <div class="body">
            <div id="dTree">
                <?php
                if ($direktori) {
                    foreach ($direktori->result() as $row) {
                        $dt[$row->folder_parent][] = $row;
                    }
                    $menu = get_menu($dt);
                    echo $menu;
                }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-9">
    <div class="box">
        <header><h5><i class="icon-home"></i></h5>
            <div class="toolbar">
                <form style="padding:7px;" method="post" action="<?php echo site_url('filemanager/createfolder') ?>">
                    <input type="hidden" name="parent" value="<?php echo $this->input->get('parent'); ?>">
                    <input type="hidden" name="dinas" value="<?php echo $member_dinas_id; ?>">
                    <input type="hidden" name="nama" value="<?php echo $member_nama; ?>">
                    <input type="text" name="folder">
                    <input type="submit" value="Buat Folder">
                </form>

            </div>
        </header>
        <div class="body">
            <fieldset>
                <legend>Form Upload</legend>
                <form method="post" enctype="multipart/form-data" action="<?php echo site_url('filemanager/uploadfile') ?>">
                    <input type="hidden" name="parent" value="<?php echo $this->input->get('parent'); ?>">
                    <input type="hidden" name="dinas" value="<?php echo $member_dinas_id; ?>">
                    <input type="hidden" name="nama" value="<?php echo $member_nip; ?>">
                    <table>
                        <tr>
                            <td><input type="file" name="lampir[]" multiple></td>
                            <td><input type="submit" value="Upload"></td>
                        </tr>
                    </table>
                </form>
            </fieldset>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Author</th>
                            <th>Tools</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($folder) {
                            foreach ($folder->result() as $row) {
                        ?>
                            <tr>
                                <td><a href="<?php echo site_url() ?>/filemanager/index?parent=<?php echo $row->folder_id; ?>"><i class="icon-folder-close"></i> <?php echo $row->folder_nama; ?></a></td>
                                <td></td>
                                <td></td>
                                <td>
                        <?php
                        if($this->session->userdata('username')==$member_nip) {
                        ?>
                                    <a href="#" class="btn btn-xs btn-rect btn-success" data-toggle="modal" data-target="#edit<?php echo $row->folder_id; ?>"><i class="icon-edit"></i></a>
                                    <a href="<?php echo site_url('filemanager/hapusfolder/'.$row->folder_id) ?>" onClick="return confirm('Menghapus folder akan menghapus folder dan file yang didalamnya, yakin??')" class="btn btn-xs btn-rect btn-danger"><i class="icon-trash"></i></a>
                        <?php } else { echo "-"; } ?>       
                                </td>
                            </tr>
                    <!-- COMPOSE MESSAGE MODAL -->
                            <div class="modal fade" id="edit<?php echo $row->folder_id?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="width:300px; height:100px; margin:200px auto; padding:10px;">
                                    <form method="post" action="<?php echo site_url('filemanager/createfolder/edit')?>">
                                        <center>
                                        <h5 style="font-weight:bold">Edit Nama Folder</h5>
                                        <input type="hidden" value="<?php echo $row->folder_id ?>" name="id">
                                        <input type="text" class="form-control" name="folder" value="<?php echo $row->folder_nama; ?>">
                                        </center>
                                    </form>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        <?php
                            }
                        }
                        if($berkas) {
                            foreach ($berkas->result() as $rows) {
                        ?>
                            <tr>
                                <td><a href="<?php echo base_url('uploads/dokumen/'.$rows->file_nama)?>"><i class="icon-file"></i> <?php echo $rows->file_nama; ?></a></td>
                                <td><?php echo $rows->file_date; ?></td>
                                <td><?php echo nama_user($rows->file_uploaded); ?></td>
                                <td>
                        <?php
                        if($this->session->userdata('username')==$rows->file_uploaded) {
                        ?>
                                    <a href="<?php echo base_url('uploads/dokumen/'.$rows->file_nama)?>" class="btn btn-xs btn-rect btn-success"><i class="icon-download"></i></a>
                                    <a href="<?php echo site_url('filemanager/hapusfile/'.$rows->file_id) ?>" onClick="return confirm('Anda yakin menghapus file ini???')" class="btn btn-xs btn-rect btn-danger"><i class="icon-trash"></i></a>
                        <?php } else { echo "-"; } ?>
                                </td>
                            </tr>
                        <?php
                            }
                        }
                        elseif(!$folder && !$berkas) {
                            echo "<tr><td colspan='4'>Tidak Ada Data</td></tr>";
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $('#dTree').easytree();
</script>