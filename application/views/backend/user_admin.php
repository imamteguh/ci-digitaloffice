<div class="col-md-4">
    <div class="box primary">
        <header>
            <div class="icons"><i class="icon-building"></i></div>
            <h5>Tambah/Edit Data Member</h5>
            <div class="toolbar">
                <button class="btn btn-success btn-sm btn-rect" data-toggle="collapse" data-target="#div1"><i class="icon-chevron-up"></i></button>
            </div>
        </header>
        <div class="body collapse in" id="div1">
        <form method="post" action="<?php echo site_url('user_admin')?>" enctype="multipart/form-data">
            <div class="form-group">
                <label>NIP<sup class="text-danger">*</sup></label>
                <input class="form-control" name="username" placeholder="Masukan NIP" value="<?php echo $getData[0]['member_nip'] ?>" <?php if($getData[0]['member_nip']){ echo 'readonly';} ?>>
                <input type="hidden" name="user_id" value="<?php echo $getData[0]['user_id'] ?>">
                <label class="small text-danger"><strong><?php echo form_error('username')?></strong></label>
            </div>
            <div class="form-group">
                <label>Nama Lengkap<sup class="text-danger">*</sup></label>
                <input class="form-control" name="member_nama" placeholder="Masukan Nama Lengkap" value="<?php echo $getData[0]['member_nama'] ?>">
                <input type="hidden" name="nama" value="<?php echo $getData[0]['member_nama']?>">
                <label class="small text-danger"><strong><?php echo form_error('member_nama')?></strong></label>
            </div>
            <div class="form-group">
                <label>Alamat Email<sup class="text-danger">*</sup></label>
                <input class="form-control" name="member_email" placeholder="Masukan Alamat Email" value="<?php echo $getData[0]['member_email'] ?>">
                <label class="small text-danger"><strong><?php echo form_error('member_email')?></strong></label>
            </div>
            <div class="form-group">
                <label>Nomer Telepon</label>
                <input class="form-control" name="member_tlp" placeholder="Masukan Telepon" value="<?php echo $getData[0]['member_tlp'] ?>">
            </div>
            <div class="form-group">
                <label>Instansi<sup class="text-danger">*</sup></label>
                <input class="form-control" name="member_dinas_id"  value="<?php echo $dinas_nama ?>"<?php {echo 'readonly';}?>>
                <label class="small text-danger"><strong><?php echo form_error('member_dinas_id')?></strong></label>
            </div>
            <div class="form-group">
                <label>Password<sup class="text-danger">*</sup>
                <?php if($getData[0]['password']){?>
                <span class="small text-info"><strong>Isikan Password jika ingin dirubah</strong></span>
                <?php } ?>
                </label>
                <input class="form-control" name="password" type="password" placeholder="Masukan Password Anda">
            </div>
            <div class="form-group">
                <label>Level Login</label>
                <select class="form-control" name="status">
                    <option>- Pilih Level -</option>
                <?php if($getData[0]['status']=='admin'):?>
                    <option value="admin" selected>Admin</option>
                    <option value="member">Member</option>
                <?php else:?>
                    <option value="admin">Admin</option>
                    <option value="member" selected>Member</option>
                <?php endif;?>
                </select>
            </div>
            <div class="form-group">
                <label>Aktifkan Akun ini</label><br>
                <label><input type="checkbox" value="1" <?php if($getData[0]['isactive']==1){echo "checked";} ?> name="isactive"> Ya</label>
            </div>
            <hr/>
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
            <h5>Data Member</h5>
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
                            <th>NIP</th>
                            <th>Nama Lengkap</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($user)):
                    $no = 1;
                    foreach ($user->result() as $rows) {
                    ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $rows->member_nip; ?></td>
                            <td><?php echo $rows->member_nama; ?></td>
                            <td><?php echo $rows->status; ?></td>
                            <td>
                            <a href="<?php echo site_url('user_admin/index/edit/'.$rows->member_nip)?>" class="btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="icon-pencil icon-white"></i></a>
                            <a href="<?php echo site_url('user_admin/hapus/'.$rows->member_nip)?>" class="btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="icon-remove icon-white"></i></a>
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