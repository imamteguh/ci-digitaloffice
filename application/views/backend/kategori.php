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
<div class="box primary">
    <header>
        <div class="icons"><i class="icon-building"></i></div>
        <h5>Data Kategori</h5>
        <div class="toolbar">
            <button class="btn btn-success btn-sm btn-rect" data-toggle="collapse" data-target="#div3"><i class="icon-chevron-up"></i></button>
        </div>
    </header>
    <div class="body collapse in" id="div3">
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kegiatan</th>
                        <th>Kategori</th>
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
                        <td><?php echo $rows->kategori_nama; ?></td>
                        <td><?php echo $this->fungsional->getKategoriParent($rows->kategori_parent); ?></td>
                        <td>
                        <a href="<?php echo site_url('kategori/index/edit/'.$rows->kategori_id)?>" class="btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="icon-pencil icon-white"></i></a>
                        <a href="<?php echo site_url('kategori/hapus/'.$rows->kategori_id)?>" class="btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="icon-remove icon-white"></i></a>
                        </td>
                    </tr>
                <?php
                $no++;
                }
                endif;
                ?>
                </tbody>
            </table>
        </div>           
    </div>
</div>

<div class="box primary">
    <header>
        <div class="icons"><i class="icon-building"></i></div>
        <h5>Tambah/Edit Kategori</h5>
        <div class="toolbar">
            <button class="btn btn-success btn-sm btn-rect" data-toggle="collapse" data-target="#div3"><i class="icon-chevron-up"></i></button>
        </div>
    </header>
    <div class="body collapse in" id="div3">
        <form method="post" action="<?php echo site_url('kategori')?>" enctype="multipart/form-data">
            <div class="form-group">
                <label>Kegiatan<sup class="text-danger">*</sup></label>
                <input class="form-control" name="kegiatan" placeholder="Masukan Kegiatan" value="<?php echo $getData[0]['kategori_nama'] ?>">
                <input type="hidden" name="user_id" value="<?php echo $getData[0]['kategori_id'] ?>">
                <label class="small text-danger"><strong><?php echo form_error('kagiatan')?></strong></label>
            </div>
            
            <div class="form-group">
                <label>Kategori<sup class="text-danger">*</sup>
                <span class="small text-info"><strong>Kosongkan jika ingin membuat kategori baru</strong></span>
                </label>
                <select class="form-control" name="kategori">
                    <option> </option>
                    <?php
                    if($datKate):
                    foreach ($datKate->result() as $rows) {
                        echo '<option value="'.$rows->kategori_id.'" '; if($getData[0]['kategori_parent']==$rows->kategori_id){ echo "selected"; } echo '>'.$rows->kategori_nama.'</option>';
                    }
                    endif;
                    ?>
                </select>
            </div>
            <hr/>
            <div class="form-group" align="left">
                <button class="btn btn-primary" type="submit">Simpan</button>
                <button class="btn btn-default" type="reset">Bersihkan</button>
            </div>
        </form>   
    </div>
</div>
</div>