<div class="col-md-7">
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
        <h5>Data Instansi</h5>
        <div class="toolbar">
            <button class="btn btn-success btn-sm btn-rect" data-toggle="collapse" data-target="#div3"><i class="icon-chevron-up"></i></button>
        </div>
    </header>
    <div class="body collapse in" id="div3">
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th width="40">No.</th>
                        <th>Nama Instansi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($jabatan)):
                $no = 1;
                foreach ($jabatan as $rows) {
                ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $rows->dinas_nama; ?></td>
                        <td>
                        <a href="<?php echo site_url('instansi/index/edit/'.$rows->dinas_id)?>" class="btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="icon-pencil icon-white"></i></a>
                        <a href="<?php echo site_url('instansi/hapus/'.$rows->dinas_id)?>" class="btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="icon-remove icon-white"></i></a>
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
</div>
<div class="col-md-4">
<div class="box primary">
    <header>
        <div class="icons"><i class="icon-building"></i></div>
        <h5>Tambah/Edit Instansi</h5>
        <div class="toolbar">
            <button class="btn btn-success btn-sm btn-rect" data-toggle="collapse" data-target="#div3"><i class="icon-chevron-up"></i></button>
        </div>
    </header>
    <div class="body collapse in" id="div3">
        <form method="post" action="<?php echo site_url('instansi')?>" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Instansi<sup class="text-danger">*</sup></label>
                <input class="form-control" name="jabatan_nama" placeholder="Masukan Nama Jabatan" value="<?php echo $getData[0]['dinas_nama'] ?>">
                <input type="hidden" name="jabatan_id" value="<?php echo $getData[0]['dinas_id'] ?>">
                <label class="small text-danger"><strong><?php echo form_error('jabatan_nama')?></strong></label>
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