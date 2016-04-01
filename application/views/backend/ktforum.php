<div class="col-md-4">
    <div class="box primary">
        <header>
            <div class="icons"><i class="icon-building"></i></div>
            <h5>Tambah/Edit Kategori Forum</h5>
            <div class="toolbar">
                <button class="btn btn-success btn-sm btn-rect" data-toggle="collapse" data-target="#div1"><i class="icon-chevron-up"></i></button>
            </div>
        </header>
        <div class="body collapse in" id="div1">
        <form method="post" action="<?php echo site_url('ktforum')?>" enctype="multipart/form-data">
            <div class="form-group">
                <label>Status Kategori<sup class="text-danger">*</sup></label>
                <select class="form-control" name="ktforum_parent">
                    <option>-</option>
                    <?php
                    foreach ($induk->result() as $rows) {
                        echo '<option value="'.$rows->ktforum_id.'" '; if($ambil['ktforum_parent']==$rows->ktforum_id){ echo "selected"; } echo '>'.$rows->ktforum_judul.'</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Nama Kategori<sup class="text-danger">*</sup></label>
                <input class="form-control" name="ktforum_judul" value="<?php echo $ambil['ktforum_judul'] ?>">
                <input type="hidden" name="ktforum_id" value="<?php echo $ambil['ktforum_id'] ?>">
                <label class="small text-danger"><strong><?php echo form_error('ktforum_judul')?></strong></label>
            </div>
            <div class="form-group">
                <label>Keterangan<sup class="text-danger">*</sup></label>
                <textarea class="form-control" name="ktforum_keterangan" rows="3"><?php echo $ambil['ktforum_keterangan'] ?></textarea>
                <label class="small text-danger"><strong><?php echo form_error('ktforum_keterangan')?></strong></label>
            </div>
            <div class="form-group">
                <label>Background</label>
                <select class="form-control" name="ktforum_bg">
                    <?php
                    foreach ($bg as $bgs => $wrn) {
                        $sel = "";
                        if($ambil['ktforum_bg']==$wrn) {
                            $sel = "selected";
                        }
                       echo "<option value='".$wrn."' ".$sel.">".$bgs."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Icon</label>
                <input type="file" name="ktforum_icon">
                <?php echo "<p class='text-primary'>".$ambil['ktforum_icon']."</p>";?>
            </div>
            <div class="form-group" align="right">
                <button class="btn btn-primary" type="submit">Simpan</button>
                <button class="btn btn-default" type="reset">Bersihkan</button>
            </div>
        </form>
        </div>
    </div>
</div>
<div class="col-md-8">
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
    <div class="box primary">
        <header>
            <div class="icons"><i class="icon-building"></i></div>
            <h5>Kategori Forum</h5>
            <div class="toolbar">
                <button class="btn btn-success btn-sm btn-rect" data-toggle="collapse" data-target="#div3"><i class="icon-chevron-up"></i></button>
            </div>
        </header>
        <div class="body collapse in" id="div3">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th width="10%">No.</th>
                            <th>Nama Kategori</th>
                            <th>Parent</th>
                            <th>Type</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($kategori)):
                    $no = 1;
                    foreach ($kategori->result() as $rows) {
                    ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $rows->ktforum_judul; ?></td>
                            <td><?php echo induk($rows->ktforum_parent); ?></td>
                            <td><?php echo $type[$rows->ktforum_type] ?></td>
                            <td>
                            <a href="<?php echo site_url('ktforum/index/edit/'.$rows->ktforum_id)?>" class="btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="icon-pencil icon-white"></i></a>
                            <a href="<?php echo site_url('ktforum/hapus/'.$rows->ktforum_id)?>" class="btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="icon-remove icon-white"></i></a>
                            </td>
                        </tr>
                    <?php
                    $no++;
                    }
                    else:
                        echo "Tidak Ada Data Tersedia...";
                    endif;
                    ?>
                    </tbody>
                </table>
            </div>           
        </div>
    </div>
</div>