<div class="col-md-12">
    <ul class="breadcrumb">
        <li><a href="<?php echo site_url()?>"><i class="icon-home"></i> Home</a></li>
        <li>Forum</li>
    </ul>
</div>
<div class="col-md-12 clearfix">
    <?php
    if($kategori) {
        foreach ($kategori->result() as $rows) {
    ?>
    <a class="widget-forum <?php echo $rows->ktforum_bg ?> btn-flat btn-rect" href="<?php echo site_url('forum/kategori/'.$rows->ktforum_id)?>">
        <img src="<?php echo base_url()?>uploads/forum/icon/<?php echo $rows->ktforum_icon ?>" width="60" height="60">
        <h3><?php echo $rows->ktforum_judul ?></h3>
    </a>
    <?php
        }
    }
    ?>
    
</div>