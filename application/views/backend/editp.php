<div class="col-md-8">
	
    <div class="box primary">
    	<header><h5>Form Edit Data Profil</h5></header>
    	<div class="body">
        	<form method="post" action="<?php echo site_url('admain/editpp/'.$member_nip)?>" enctype="multipart/form-data">
            	<div class="form-group">
                    <?php echo $this->session->flashdata('validasi')?>
                </div>
                
            	<div class="form-group">
                	<label>NIP</label>
                    <input type="text" name="" class="form-control" value="<?php echo $member_nip?>" disabled>
                    <input type="hidden" name="nip" class="form-control" value="<?php echo $member_nip?>">
                </div>
                
            	<div class="form-group">
                	<label>Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?php echo $member_nama?>" required>
                </div>
                
                <div class="form-group">
                	<label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $member_email?>" required>
                </div>
                
                <div class="form-group">
                	<label>No. Telp</label>
                    <input type="text" name="tlp" class="form-control" value="<?php echo $member_tlp?>">
                </div>
                
                <div class="form-group">
                	<label>Foto</label><br>
                    <img width="200" src="<?php echo base_url('uploads/images/'.$member_foto)?>" class="img img-thumbnail">
                    <input type="file" name="foto" class="form-control">
                    <small><i>*Pilih jika ingin dirubah. | ukuran maksimal 1Mb.</i></small>
                </div>
                
                <div class="form-group">
                	<label>Password</label>
                    <input type="password" name="passx" class="form-control" value="">
                    <input type="hidden" name="pass" class="form-control" value="<?php echo $this->session->userdata('password')?>">
                    <small><i>*Isi Password jika ingin dirubah</i></small>
                </div>
                
                <div class="form-group">
                	<button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    
</div>

